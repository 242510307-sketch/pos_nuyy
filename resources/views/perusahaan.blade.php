@extends('layouts.app')

@section('title', 'Tentang Perusahaan - FruitsMart')

@section('content')
<style>
    .company-page {
        max-width: 900px;
        margin: 0 auto;
        padding: 24px 16px 48px;
        color: #17324d;
    }

    .company-hero {
        padding: 42px 28px;
        border-radius: 18px;
        color: #fff;
        background: linear-gradient(135deg, #0d6efd, #20c997);
        box-shadow: 0 12px 28px rgba(13, 110, 253, .2);
        text-align: center;
    }

    .company-hero i { font-size: 3rem; }
    .company-hero h1 { margin: 12px 0 8px; font-size: 2.4rem; }
    .company-hero p { margin: 0; font-size: 1.05rem; }

    .company-section {
        margin-top: 18px;
        padding: 24px 28px;
        border: 1px solid #dce9f7;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 8px 22px rgba(23, 50, 77, .06);
    }

    .company-section h2 {
        margin-bottom: 12px;
        color: #0d6efd;
        font-size: 1.25rem;
    }

    .company-section p { margin-bottom: 0; line-height: 1.75; color: #6b7d90; }
    .company-values { display: grid; gap: 16px; grid-template-columns: repeat(3, 1fr); }
    .company-value { text-align: center; }
    .company-value i { color: #20c997; font-size: 1.8rem; }
    .company-value h3 { margin: 8px 0 4px; font-size: 1rem; }
    .company-value p { font-size: .9rem; line-height: 1.5; }

    @media (max-width: 767.98px) {
        .company-page { padding: 12px 8px 30px; }
        .company-hero { padding: 32px 20px; }
        .company-hero h1 { font-size: 2rem; }
        .company-section { padding: 20px; }
        .company-values { grid-template-columns: 1fr; }
    }
</style>

<main class="company-page">
    <header class="company-hero">
        <i class="bi bi-shop-window"></i>
        <h1>FruitsMart</h1>
        <p>Solusi pengelolaan toko yang praktis, teratur, dan efisien.</p>
    </header>

    <section class="company-section">
        <h2><i class="bi bi-building me-2"></i>Tentang Perusahaan</h2>
        <p>FruitsMart adalah perusahaan yang menyediakan solusi digital untuk membantu pemilik toko mengelola produk, stok, pengguna, dan transaksi penjualan dalam satu aplikasi.</p>
    </section>

    <section class="company-section">
        <h2><i class="bi bi-bullseye me-2"></i>Komitmen Kami</h2>
        <div class="company-values">
            <div class="company-value">
                <i class="bi bi-lightning-charge"></i>
                <h3>Praktis</h3>
                <p>Memudahkan pekerjaan operasional toko setiap hari.</p>
            </div>
            <div class="company-value">
                <i class="bi bi-clipboard2-check"></i>
                <h3>Teratur</h3>
                <p>Membantu menjaga data produk dan transaksi tetap rapi.</p>
            </div>
            <div class="company-value">
                <i class="bi bi-graph-up-arrow"></i>
                <h3>Berkembang</h3>
                <p>Mendukung toko untuk bekerja lebih efisien.</p>
            </div>
        </div>
    </section>
</main>
@endsection