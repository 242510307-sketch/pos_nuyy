@extends('layouts.app')

@section('title', 'Struk Penjualan')

@section('content')
<style>
    .receipt-page {
        max-width: 480px;
        margin: 0 auto;
        padding: 24px 12px 40px;
    }

    .receipt-actions {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 16px;
    }

    .receipt {
        padding: 28px 26px;
        border: 1px solid #dee2e6;
        background: #fff;
        color: #212529;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
    }

    .receipt-header {
        padding-bottom: 18px;
        border-bottom: 1px dashed #adb5bd;
        text-align: center;
    }

    .receipt-header h1 {
        margin: 0 0 4px;
        color: #0d6efd;
        font-size: 1.45rem;
        font-weight: 700;
    }

    .receipt-header p,
    .receipt-meta,
    .receipt-footer {
        margin: 0;
        color: #6c757d;
        font-size: .82rem;
    }

    .receipt-meta {
        display: grid;
        gap: 4px;
        padding: 16px 0;
    }

    .receipt-meta div {
        display: flex;
        justify-content: space-between;
        gap: 12px;
    }

    .receipt-items {
        width: 100%;
        border-top: 1px dashed #adb5bd;
        border-bottom: 1px dashed #adb5bd;
        font-size: .86rem;
    }

    .receipt-items th,
    .receipt-items td {
        padding: 9px 0;
    }

    .receipt-items th {
        color: #6c757d;
        font-size: .76rem;
        font-weight: 600;
    }

    .receipt-items .number,
    .receipt-items .price {
        text-align: right;
        white-space: nowrap;
    }

    .receipt-total {
        display: flex;
        justify-content: space-between;
        padding: 16px 0 8px;
        font-size: 1rem;
        font-weight: 700;
    }

    .receipt-footer {
        padding-top: 14px;
        text-align: center;
    }

    @media print {
        body { background: #fff !important; }
        .navbar, .receipt-actions, .alert { display: none !important; }
        .container { width: 100% !important; max-width: none !important; margin: 0 !important; padding: 0 !important; }
        .receipt-page { max-width: 80mm; padding: 0; }
        .receipt { border: 0; padding: 8px 0; box-shadow: none; }
    }
</style>

<main class="receipt-page">
    <div class="receipt-actions">
        <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
        <button type="button" class="btn btn-primary" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Cetak Struk
        </button>
    </div>

    <section id="struk" class="receipt">
        <header class="receipt-header">
            <h1>NuyMart</h1>
            <p>Struk Pembayaran</p>
        </header>

        <div class="receipt-meta">
            <div><span>No. Transaksi</span><strong>#{{ $penjualan->id }}</strong></div>
            <div><span>Tanggal</span><strong>{{ $penjualan->created_at->format('d/m/Y H:i') }}</strong></div>
            <div><span>Kasir</span><strong>{{ $penjualan->user->name ?? 'Kasir' }}</strong></div>
        </div>

        <div class="text-center border-bottom pb-3 mb-3">
            <div id="sale-qr" class="d-flex justify-content-center"></div>
            <div class="small text-muted mt-1">QRIS transaksi #{{ $penjualan->id }}</div>
        </div>

        <table class="receipt-items">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th class="number">Qty</th>
                    <th class="price">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan->itemPenjualan as $item)
                    <tr>
                        <td>
                            {{ $item->produk->nama_produk ?? $item->produk->nama ?? 'Produk' }}<br>
                            <small class="text-muted">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</small>
                        </td>
                        <td class="number">{{ $item->kuantitas }}</td>
                        <td class="price">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="receipt-total">
            <span>Total</span>
            <span>Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</span>
        </div>
        <div class="receipt-meta border-top pt-2">
            <div><span>Jumlah Bayar</span><strong>Rp {{ number_format($penjualan->jumlah_bayar ?? $penjualan->total_pembayaran, 0, ',', '.') }}</strong></div>
            <div><span>Kembalian</span><strong>Rp {{ number_format($penjualan->kembalian ?? 0, 0, ',', '.') }}</strong></div>
            <div><span>Pembayaran</span><strong>{{ ucfirst($penjualan->metode_pembayaran) }}</strong></div>
            <div><span>Status</span><strong>{{ ucfirst($penjualan->status) }}</strong></div>
        </div>
        <p class="receipt-footer">Terima kasih telah berbelanja di NuyMart.</p>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
    if (typeof QRCode !== 'undefined') {
        new QRCode(document.querySelector('#sale-qr'), {
            text: 'NUYMART-{{ $penjualan->id }}',
            width: 140,
            height: 140,
            correctLevel: QRCode.CorrectLevel.M
        });
    }
</script>
@endsection
