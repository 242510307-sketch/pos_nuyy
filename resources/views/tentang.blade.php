@extends('layouts.app')

@section('title', 'Tentang FruitsMart')

@section('content')
<style>
    .about-page {
        --primary: #0d6efd;
        --ink: #17324d;
        --muted: #6b7d90;
        max-width: 850px;
        margin: 0 auto;
        padding: 20px 16px 42px;
        color: var(--ink);
    }

    .about-heading { margin-bottom: 20px; text-align: center; }
    .about-heading h1 { margin-bottom: 5px; color: var(--primary); font-size: 2.45rem; font-weight: 700; }
    .about-heading p { margin: 0; color: var(--muted); }

    .about-panel {
        border: 1px solid #dce9f7;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 10px 28px rgba(23, 50, 77, .07);
    }

    .profile-panel {
        min-height: 100%;
        padding: 28px 18px;
        text-align: center;
        background: linear-gradient(150deg, #f7fbff, #fff 72%);
    }

    .profile-avatar {
        width: 116px;
        height: 116px;
        margin: 0 auto 12px;
        overflow: hidden;
        border: 5px solid #fff;
        border-radius: 50%;
        box-shadow: 0 7px 18px rgba(13, 110, 253, .18);
    }

    .profile-avatar img { width: 100%; height: 100%; display: block; object-fit: cover; }
    .profile-panel h2 { margin-bottom: 4px; color: var(--primary); font-size: 1.4rem; }
    .profile-role { margin-bottom: 14px; color: var(--muted); }
    .profile-badge { display: inline-block; padding: 6px 13px; border-radius: 999px; color: #0755b5; background: #dcecff; font-size: .82rem; font-weight: 600; }
    .profile-note { margin: 18px 0 0; padding-top: 15px; border-top: 1px solid #dce9f7; color: var(--muted); font-size: .9rem; line-height: 1.65; }

    .info-panel, .technology-panel, .application-panel { padding: 22px 26px; }
    .technology-panel, .application-panel { margin-top: 16px; }
    .panel-title { margin-bottom: 16px; color: var(--primary); font-size: 1.15rem; font-weight: 600; }
    .panel-title i { margin-right: 8px; }
    .user-details { display: grid; gap: 11px; margin: 0; }
    .user-details div { display: grid; gap: 2px; }
    .user-details dt { color: var(--muted); font-size: .8rem; font-weight: 600; }
    .user-details dd { margin: 0; font-size: .92rem; font-weight: 600; }
    .technology-list { display: grid; gap: 9px; color: var(--muted); font-size: .9rem; }
    .technology-list strong, .application-panel strong { color: var(--ink); }
    .application-panel p { margin: 0 0 8px; color: var(--muted); font-size: .9rem; line-height: 1.7; }
    .application-panel p:last-child { margin-bottom: 0; }

    @media (max-width: 767.98px) {
        .about-page { padding: 12px 8px 30px; }
        .about-heading h1 { font-size: 2rem; }
        .info-panel, .technology-panel, .application-panel { padding: 20px; }
    }
</style>

<main class="about-page">
    <header class="about-heading">
        <h1>Tentang Saya</h1>
        <p>Profil pengguna aplikasi FruitsMart</p>
    </header>

    <div class="row g-3 align-items-stretch">
        <div class="col-lg-4">
            <section class="about-panel profile-panel">
                <div class="profile-avatar">
                    <img src="{{ asset('profile/images (1).jpg') }}" alt="Foto profil bunga biru">
                </div>
                <h2>Nurul Kayla Ramadhani</h2>
                <p class="profile-role"><i class="bi bi-code-slash me-1"></i>Web Developer</p>
                <span class="profile-badge"><i class="bi bi-person-badge me-1"></i>Pengembang FruitsMart</span>
                <p class="profile-note">Selamat datang di halaman profil aplikasi FruitsMart. Kelola kebutuhan toko dan transaksi penjualan dengan lebih mudah.</p>
            </section>
        </div>

        <div class="col-lg-8">
            <section class="about-panel info-panel">
                <h2 class="panel-title"><i class="bi bi-person-vcard"></i>Informasi Pengguna</h2>
                <dl class="user-details">
                    <div><dt>Nama</dt><dd>{{ auth()->user()->name ?? 'Admin' }}</dd></div>
                    <div><dt>Email</dt><dd>{{ auth()->user()->email ?? 'admin@example.com' }}</dd></div>
                    <div><dt>Peran</dt><dd>{{ optional(auth()->user()->role)->name ?? 'admin' }}</dd></div>
                    <div><dt>Bergabung</dt><dd>{{ optional(auth()->user()->created_at)->format('d F Y') ?? date('d F Y') }}</dd></div>
                </dl>
            </section>

            <section class="about-panel technology-panel">
                <h2 class="panel-title"><i class="bi bi-layers"></i>Teknologi yang Digunakan</h2>
                <div class="technology-list">
                    <div><strong>Bahasa Pemrograman:</strong> PHP, JavaScript</div>
                    <div><strong>Framework:</strong> Laravel</div>
                    <div><strong>Frontend:</strong> HTML, CSS, Bootstrap</div>
                    <div><strong>Database:</strong> MySQL</div>
                    <div><strong>Tools:</strong> Visual Studio Code, Git</div>
                </div>
            </section>
        </div>
    </div>

    <section class="about-panel application-panel">
        <h2 class="panel-title"><i class="bi bi-info-circle"></i>Tentang Aplikasi</h2>
        <p><strong>FruitsMart</strong> merupakan aplikasi Point of Sale (POS) yang dibuat untuk membantu proses pengelolaan toko.</p>
        <p>Aplikasi ini menyediakan beberapa fitur seperti pengelolaan produk, stok, pengguna, kasir, dan transaksi penjualan.</p>
        <p>Dengan adanya aplikasi ini, proses pencatatan produk dan transaksi diharapkan menjadi lebih mudah, teratur, dan efisien.</p>
    </section>
</main>
@endsection
