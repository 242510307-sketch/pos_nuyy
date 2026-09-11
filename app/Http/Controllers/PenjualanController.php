<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()
            ->with('user')

            ->when($user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })

            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {

                    $q->whereHas('user', function ($userQuery) use ($keyword) {
                        $userQuery->where(
                            'name',
                            'like',
                            '%' . $keyword . '%'
                        );
                    });

                });
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status' => 'OPEN'
            ],
            [
                'total_pembayaran' => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        $keyword = $request->input('search');

        $products = Produk::when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        })
            ->orderBy('nama')
            ->get();

        $mode = 'create';

        return view(
            'penjualan.pos',
            compact('sale', 'products', 'mode')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()
            ->route('penjualan.index')
            ->with('errors', 'Transaksi dibuat melalui halaman kasir.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $penjualan->load([
            'user',
            'itemPenjualan.produk'
        ]);

        return view(
            'penjualan.show',
            compact('penjualan')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        /*
         * Transaksi yang sudah selesai tidak boleh diedit.
         */
        if ($penjualan->status !== 'OPEN') {
            return redirect()
                ->route('penjualan.index')
                ->with(
                    'errors',
                    'Transaksi yang sudah selesai tidak dapat diedit.'
                );
        }

        /*
         * Kasir hanya boleh mengedit transaksi miliknya.
         */
        $user = Auth::user();

        if (
            $user->role->name === 'kasir' &&
            $penjualan->user_id !== $user->id
        ) {
            abort(403, 'Anda tidak memiliki akses ke transaksi ini.');
        }

        $sale = $penjualan;

        $sale->load([
            'itemPenjualan.produk'
        ]);

        $products = Produk::orderBy('nama')->get();

        $mode = 'edit';

        return view(
            'penjualan.pos',
            compact('sale', 'products', 'mode')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Penjualan $penjualan
    ) {
        $request->validate([
            'payment_method' => 'required|in:CASH,QRIS',
            'jumlah_bayar' => 'nullable|integer|min:0'
        ]);

        /*
         * Hanya transaksi OPEN yang boleh diselesaikan.
         */
        if ($penjualan->status !== 'OPEN') {
            return redirect()
                ->route('penjualan.index')
                ->with(
                    'errors',
                    'Transaksi sudah selesai dan tidak dapat diubah.'
                );
        }

        /*
         * Kasir hanya boleh mengubah transaksi miliknya.
         */
        $user = Auth::user();

        if (
            $user->role->name === 'kasir' &&
            $penjualan->user_id !== $user->id
        ) {
            abort(403, 'Anda tidak memiliki akses ke transaksi ini.');
        }

        /*
         * Pastikan keranjang tidak kosong.
         */
        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()
                ->with('errors', 'Keranjang masih kosong.');
        }

        $total = $penjualan->itemPenjualan()->sum('subtotal');
        $jumlahBayar = $request->payment_method === 'QRIS'
            ? $total
            : (int) $request->input('jumlah_bayar', 0);

        if ($jumlahBayar < $total) {
            return back()
                ->withInput()
                ->with('errors', 'Jumlah bayar tidak boleh kurang dari total pembayaran.');
        }

        DB::transaction(function () use ($penjualan, $request, $total, $jumlahBayar) {

            /*
             * Hitung ulang total dari database.
             * Ini mencegah manipulasi total dari form.
             */
            $penjualan->update([
                'metode_pembayaran' => $request->payment_method,
                'total_pembayaran' => $total,
                'jumlah_bayar' => $jumlahBayar,
                'kembalian' => $jumlahBayar - $total,
                'status' => 'COMPLETED'
            ]);
        });

        return redirect()
            ->route('penjualan.index')
            ->with(
                'success',
                'Transaksi berhasil diselesaikan.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        $user = Auth::user();

        /*
         * Kasir hanya boleh menghapus transaksi miliknya.
         */
        if (
            $user->role->name === 'kasir' &&
            $penjualan->user_id !== $user->id
        ) {
            abort(403, 'Anda tidak memiliki akses ke transaksi ini.');
        }

        /*
         * Transaksi COMPLETED tidak boleh dihapus.
         */
        if ($penjualan->status !== 'OPEN') {
            return redirect()
                ->route('penjualan.index')
                ->with(
                    'errors',
                    'Transaksi yang sudah selesai tidak dapat dihapus.'
                );
        }

        DB::transaction(function () use ($penjualan) {

            /*
             * Kembalikan stok produk.
             */
            foreach ($penjualan->itemPenjualan as $item) {

                if ($item->produk) {
                    $item->produk->increment(
                        'stok',
                        $item->kuantitas
                    );
                }
            }

            /*
             * Hapus detail transaksi.
             */
            $penjualan->itemPenjualan()->delete();

            /*
             * Hapus transaksi utama.
             */
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with(
                'success',
                'Transaksi berhasil dibatalkan.'
            );
    }
}
