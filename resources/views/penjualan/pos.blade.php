@extends('layouts.app')

@section('title', 'POS')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        ALERT ERROR
    ========================================================== --}}
    @if (session('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <i class="bi bi-exclamation-triangle-fill me-1"></i>

            {{ session('errors') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>
    @endif


    {{-- =========================================================
        ALERT SUCCESS
    ========================================================== --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <i class="bi bi-check-circle-fill me-1"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>
    @endif


    {{-- =========================================================
        JUDUL
    ========================================================== --}}
    <h4 class="mb-3">

        @if ($mode === 'edit')
            Edit Penjualan
        @else
            Tambah Penjualan
        @endif

    </h4>


    <div class="row">

        {{-- =====================================================
            PRODUK
        ====================================================== --}}
        <div class="col-md-6">

            <div class="card">

                <div
                    class="card-body"
                    style="max-height:70vh; overflow:auto"
                >

                    {{-- SEARCH PRODUK --}}
                    <div class="mb-3">

                        <form
                            method="GET"
                            action="{{ route('penjualan.create') }}"
                        >

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control"
                                placeholder="Cari produk..."
                                onkeyup="this.form.submit()"
                            >

                        </form>

                    </div>


                    {{-- DAFTAR PRODUK --}}
                    @forelse ($products as $product)

                        <form
                            method="POST"
                            action="{{ route('itempenjualan.store') }}"
                            class="row mb-2"
                        >

                            @csrf

                            <input
                                type="hidden"
                                name="product_id"
                                value="{{ $product->id }}"
                            >


                            {{-- NAMA PRODUK --}}
                            <div class="col-7">

                                <button
                                    type="button"
                                    class="btn btn-outline-primary w-100 text-start p-2
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}"
                                >

                                    <div class="d-flex align-items-center gap-2">

                                        @if ($product->foto)

                                            <img
                                                src="{{ asset('storage/' . $product->foto) }}"
                                                alt="{{ $product->nama }}"
                                                class="rounded-circle"
                                                style="width:45px; height:45px; object-fit:cover"
                                            >

                                        @else

                                            <div
                                                class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                                style="width:45px; height:45px;"
                                            >
                                                <i class="bi bi-image text-muted"></i>
                                            </div>

                                        @endif


                                        <div>

                                            <div class="fw-semibold">
                                                {{ $product->nama }}
                                            </div>

                                            <small class="text-muted">
                                                Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                            </small>

                                        </div>

                                    </div>

                                </button>

                            </div>


                            {{-- QUANTITY --}}
                            <div class="col-3">

                                <input
                                    type="number"
                                    name="quantity"
                                    value="1"
                                    min="1"
                                    max="{{ $product->stok }}"
                                    class="form-control"
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}
                                >

                            </div>


                            {{-- TAMBAH --}}
                            <div class="col-2">

                                <button
                                    type="submit"
                                    class="btn btn-primary w-100"
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}
                                >
                                    +
                                </button>

                            </div>

                        </form>

                    @empty

                        <div class="text-center text-muted py-4">

                            <i class="bi bi-box-seam fs-1 d-block mb-2"></i>

                            Produk tidak ditemukan.

                        </div>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- =====================================================
            KERANJANG
        ====================================================== --}}
        <div class="col-md-6">

            <div class="card">

                <div class="table-responsive">

                    <table class="table table-bordered mb-0">

                        <thead>

                            <tr>

                                <th>Produk</th>

                                <th style="width:100px;">
                                    Qty
                                </th>

                                <th>
                                    Subtotal
                                </th>

                                <th style="width:100px;">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($sale->itemPenjualan as $item)

                                <tr>

                                    {{-- =================================================
                                        PRODUK
                                    ================================================== --}}
                                    <td>

                                        @if ($item->produk)

                                            {{ $item->produk->nama }}

                                        @else

                                            <span class="text-danger">

                                                <i class="bi bi-exclamation-triangle-fill me-1"></i>

                                                Produk tidak ditemukan

                                            </span>

                                            <small class="d-block text-muted">
                                                ID Produk: {{ $item->produk_id }}
                                            </small>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        QTY
                                    ================================================== --}}
                                    <td>

                                        @if ($item->produk && $sale->status === 'OPEN')

                                            <form
                                                method="POST"
                                                action="{{ route('itempenjualan.update', $item->id) }}"
                                            >

                                                @csrf

                                                @method('PUT')

                                                <input
                                                    type="number"
                                                    name="quantity"
                                                    value="{{ $item->kuantitas }}"
                                                    min="1"
                                                    max="{{ $item->produk->stok + $item->kuantitas }}"
                                                    class="form-control form-control-sm"
                                                    onchange="this.form.submit()"
                                                >

                                            </form>

                                        @else

                                            <span>
                                                {{ $item->kuantitas }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                        SUBTOTAL
                                    ================================================== --}}
                                    <td>

                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}

                                    </td>


                                    {{-- =================================================
                                        AKSI
                                    ================================================== --}}
                                    <td>

                                        @if ($sale->status === 'OPEN' && $item->produk)

                                            <form
                                                method="POST"
                                                action="{{ route('itempenjualan.destroy', $item->id) }}"
                                                onsubmit="return confirm('Hapus produk ini dari keranjang?')"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm"
                                                >
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </form>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="4"
                                        class="text-center text-muted py-4"
                                    >

                                        <i class="bi bi-cart-x fs-1 d-block mb-2"></i>

                                        Keranjang masih kosong.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- =====================================================
                    FOOTER KERANJANG
                ====================================================== --}}
                <div class="card-footer">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span class="fw-semibold">
                            Total Pembayaran
                        </span>

                        <strong class="fs-5 text-primary">

                            Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}

                        </strong>

                    </div>


                    {{-- =================================================
                        CHECKOUT
                    ================================================== --}}
                    @if ($sale->status === 'OPEN')

                        <form
                            method="POST"
                            action="{{ route('penjualan.update', $sale->id) }}"
                            onsubmit="return confirm('Yakin ingin checkout transaksi ini?')"
                        >

                            @csrf

                            @method('PUT')


                            <select
                                name="payment_method"
                                class="form-select mb-2"
                                required
                            >

                                <option value="">
                                    Pilih Pembayaran
                                </option>

                                <option value="CASH">
                                    Cash
                                </option>

                                <option value="QRIS">
                                    QRIS
                                </option>

                            </select>

                            <div id="qris-payment-fields" class="border rounded p-3 mb-2 text-center d-none">
                                <div class="fw-semibold mb-2">QRIS Pembayaran</div>
                                <div id="payment-qr" class="d-flex justify-content-center"></div>
                                <div class="small text-muted mt-2">Scan QR untuk transaksi #{{ $sale->id }}</div>
                            </div>

                            <div id="cash-payment-fields">
                                <label for="jumlah_bayar" class="form-label mb-1">
                                    Jumlah Bayar
                                </label>

                                <input
                                    id="jumlah_bayar"
                                    name="jumlah_bayar"
                                    type="number"
                                    min="{{ $sale->total_pembayaran }}"
                                    step="1"
                                    class="form-control mb-2"
                                    placeholder="Masukkan jumlah uang"
                                    required
                                >

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="fw-semibold">Kembalian</span>
                                    <strong id="change-amount" class="text-success">Rp 0</strong>
                                </div>
                            </div>

                            <div id="cash-payment-error" class="text-danger small mb-2 d-none">
                                Jumlah bayar kurang dari total pembayaran.
                            </div>


                            <button
                                type="submit"
                                class="btn btn-success w-100"
                                {{ $sale->itemPenjualan->count() === 0 ? 'disabled' : '' }}
                            >

                                <i class="bi bi-check-circle me-1"></i>

                                Checkout

                            </button>

                        </form>

                    @else

                        <button
                            type="button"
                            class="btn btn-secondary w-100"
                            disabled
                        >

                            <i class="bi bi-check-circle me-1"></i>

                            Transaksi Sudah Selesai

                        </button>

                    @endif


                    {{-- =================================================
                        BATALKAN TRANSAKSI
                    ================================================== --}}
                    @if ($sale->status === 'OPEN')

                        <form
                            action="{{ route('penjualan.destroy', $sale->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin membatalkan transaksi? Stok produk akan dikembalikan.')"
                        >

                            @csrf

                            @method('DELETE')


                            <button
                                type="submit"
                                class="btn btn-outline-danger w-100 mt-2"
                            >

                                <i class="bi bi-x-circle me-1"></i>

                                Batalkan Transaksi

                            </button>

                        </form>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@if ($sale->status === 'OPEN')
    <script>
        const paymentMethod = document.querySelector('[name="payment_method"]');
        const paymentAmount = document.querySelector('#jumlah_bayar');
        const cashFields = document.querySelector('#cash-payment-fields');
        const qrisFields = document.querySelector('#qris-payment-fields');
        const changeAmount = document.querySelector('#change-amount');
        const paymentError = document.querySelector('#cash-payment-error');
        const totalAmount = {{ (int) $sale->total_pembayaran }};

        function updatePaymentFields() {
            const isCash = paymentMethod.value === 'CASH';
            cashFields.classList.toggle('d-none', !isCash);
            qrisFields.classList.toggle('d-none', paymentMethod.value !== 'QRIS');
            paymentAmount.required = isCash;

            if (!isCash) {
                paymentAmount.value = totalAmount;
                changeAmount.textContent = 'Rp 0';
                paymentError.classList.add('d-none');
                return;
            }

            const paid = Number(paymentAmount.value || 0);
            const change = Math.max(0, paid - totalAmount);
            changeAmount.textContent = 'Rp ' + change.toLocaleString('id-ID');
            paymentError.classList.toggle('d-none', paid >= totalAmount);
        }

        paymentMethod.addEventListener('change', updatePaymentFields);
        paymentAmount.addEventListener('input', updatePaymentFields);
        updatePaymentFields();
    </script>
@endif

<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
    if (typeof QRCode !== 'undefined') {
        new QRCode(document.querySelector('#payment-qr'), {
            text: 'NUYMART-{{ $sale->id }}',
            width: 160,
            height: 160,
            correctLevel: QRCode.CorrectLevel.M
        });
    }
</script>

@endsection
