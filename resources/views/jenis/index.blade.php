@extends('layouts.app')

@section('title', 'Jenis Produk')

@section('content')

<style>
    .jenis-page {
        max-width: 1450px;
        margin: 0 auto;
    }

    .jenis-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
    }

    .jenis-header {
        background: linear-gradient(
            135deg,
            #0d6efd 0%,
            #0dcaf0 100%
        );
        color: white;
        border-radius: 20px;
        position: relative;
        overflow: hidden;
    }

    .jenis-header::before {
        content: "";
        position: absolute;
        width: 250px;
        height: 250px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        top: -130px;
        right: -50px;
    }

    .jenis-header::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
        bottom: -100px;
        left: -50px;
    }

    .jenis-header-content {
        position: relative;
        z-index: 2;
    }

    .jenis-icon {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 17px;
        background: rgba(255,255,255,.18);
        font-size: 27px;
    }

    .jenis-title {
        font-weight: 700;
        margin-bottom: 3px;
    }

    .jenis-subtitle {
        opacity: .85;
        margin-bottom: 0;
    }

    .btn-tambah {
        border-radius: 50px;
        padding: 11px 20px;
        font-weight: 600;
        background: #fff;
        color: #0d6efd;
        border: none;
        transition: .25s ease;
    }

    .btn-tambah:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,.15);
        color: #0d6efd;
        background: #fff;
    }

    .alert-success-custom {
        border: none;
        border-radius: 14px;
        background: #d1e7dd;
        color: #0f5132;
    }

    .table-wrapper {
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid #edf0f2;
    }

    .jenis-table {
        margin-bottom: 0;
    }

    .jenis-table thead th {
        background: #f8f9fa;
        color: #495057;
        font-weight: 700;
        padding: 15px;
        border-bottom: 1px solid #dee2e6;
        vertical-align: middle;
    }

    .jenis-table tbody td {
        padding: 15px;
        vertical-align: middle;
    }

    .jenis-table tbody tr {
        transition: .2s ease;
    }

    .jenis-table tbody tr:hover {
        background: #f8fbff;
    }

    .nomor {
        width: 70px;
        color: #6c757d;
        font-weight: 600;
    }

    .jenis-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 14px;
        border-radius: 50px;
        background: rgba(13,110,253,.10);
        color: #0d6efd;
        font-weight: 600;
    }

    .aksi {
        width: 220px;
        text-align: center;
    }

    /*
    |--------------------------------------------------------------------------
    | TOMBOL AKSI
    |--------------------------------------------------------------------------
    */

    .aksi-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .aksi-wrapper form {
        margin: 0;
        padding: 0;
    }

    .btn-edit,
    .btn-hapus {
        min-width: 82px;
        border-radius: 10px;
        padding: 8px 13px;
        font-weight: 600;
        transition: .25s ease;
    }

    .btn-edit {
        color: #fff;
        background: #ffc107;
        border: 1px solid #ffc107;
    }

    .btn-edit:hover {
        background: #e0a800;
        border-color: #e0a800;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(255,193,7,.25);
    }

    .btn-hapus {
        color: #fff;
        background: #dc3545;
        border: 1px solid #dc3545;
    }

    .btn-hapus:hover {
        background: #bb2d3b;
        border-color: #bb2d3b;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(220,53,69,.25);
    }

    .empty-state {
        padding: 60px 20px !important;
        text-align: center;
        color: #6c757d;
    }

    .empty-icon {
        width: 75px;
        height: 75px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        border-radius: 20px;
        background: rgba(13,110,253,.08);
        color: #0d6efd;
        font-size: 34px;
    }

    .jenis-count {
        color: #6c757d;
        font-size: 14px;
    }

    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 768px) {

        .jenis-page {
            padding-left: 5px;
            padding-right: 5px;
        }

        .jenis-header {
            border-radius: 16px;
        }

        .jenis-header .d-flex {
            align-items: flex-start !important;
        }

        .jenis-icon {
            width: 50px;
            height: 50px;
            font-size: 23px;
        }

        .btn-tambah {
            padding: 9px 14px;
        }

        .aksi {
            width: 190px;
        }

        .aksi-wrapper {
            gap: 6px;
        }

        .btn-edit,
        .btn-hapus {
            min-width: 75px;
            padding: 7px 10px;
        }
    }

    @media (max-width: 576px) {

        .jenis-header .d-flex.justify-content-between {
            flex-direction: column;
            align-items: stretch !important;
        }

        .btn-tambah {
            width: 100%;
            text-align: center;
            margin-top: 10px;
        }

        .aksi-wrapper {
            justify-content: flex-start;
        }

        .btn-edit,
        .btn-hapus {
            min-width: 75px;
        }
    }
</style>


<div class="container-fluid py-4 jenis-page">

    {{-- HEADER --}}
    <div class="jenis-header shadow-sm p-4 p-md-5 mb-4">

        <div class="jenis-header-content">

            <div class="d-flex justify-content-between align-items-center gap-3">

                <div class="d-flex align-items-center">

                    <div class="jenis-icon me-3">
                        <i class="bi bi-tags-fill"></i>
                    </div>

                    <div>
                        <h3 class="jenis-title">
                            Jenis Produk
                        </h3>

                        <p class="jenis-subtitle">
                            Kelola kategori atau jenis produk yang tersedia.
                        </p>
                    </div>

                </div>

                <a
                    href="{{ route('jenis.create') }}"
                    class="btn btn-tambah"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Jenis
                </a>

            </div>

        </div>

    </div>


    {{-- CARD DATA --}}
    <div class="card jenis-card shadow-sm">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>

                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-list-ul text-primary me-2"></i>
                        Daftar Jenis
                    </h5>

                    <span class="jenis-count">
                        Data jenis produk yang tersedia
                    </span>

                </div>

                <span class="badge bg-primary rounded-pill px-3 py-2">
                    {{ $jenis->count() }} Jenis
                </span>

            </div>


            {{-- TABLE --}}
            <div class="table-wrapper">

                <div class="table-responsive">

                    <table class="table jenis-table">

                        <thead>

                            <tr>

                                <th class="nomor">
                                    No
                                </th>

                                <th>
                                    Nama Jenis
                                </th>

                                <th class="aksi">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($jenis as $item)

                                <tr>

                                    <td class="nomor">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>

                                        <span class="jenis-badge">

                                            <i class="bi bi-tag-fill"></i>

                                            {{ $item->nama_jenis }}

                                        </span>

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="aksi">

                                        <div class="aksi-wrapper">

                                            {{-- EDIT --}}
                                            <a
                                                href="{{ route('jenis.edit', $item->id) }}"
                                                class="btn btn-edit btn-sm"
                                            >

                                                <i class="bi bi-pencil-square me-1"></i>

                                                Edit

                                            </a>


                                            {{-- HAPUS --}}
                                            <form
                                                action="{{ route('jenis.destroy', $item->id) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-hapus btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus jenis ini?')"
                                                >

                                                    <i class="bi bi-trash3 me-1"></i>

                                                    Hapus

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="3"
                                        class="empty-state"
                                    >

                                        <div class="empty-icon">

                                            <i class="bi bi-tags"></i>

                                        </div>

                                        <h5 class="fw-bold text-dark">

                                            Belum Ada Jenis

                                        </h5>

                                        <p class="mb-3">

                                            Belum ada jenis produk yang ditambahkan.

                                        </p>

                                        <a
                                            href="{{ route('jenis.create') }}"
                                            class="btn btn-primary rounded-pill px-4"
                                        >

                                            <i class="bi bi-plus-lg me-1"></i>

                                            Tambah Jenis

                                        </a>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection