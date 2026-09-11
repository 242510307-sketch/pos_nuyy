@extends('layouts.app')

@section('title', 'Edit Jenis Produk')

@section('content')

<style>
    .jenis-edit-page {
        max-width: 900px;
        margin: 0 auto;
    }

    .edit-header {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        color: #fff;
        background: linear-gradient(
            135deg,
            #0d6efd 0%,
            #0dcaf0 100%
        );
    }

    .edit-header::before {
        content: "";
        position: absolute;
        width: 250px;
        height: 250px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        top: -140px;
        right: -60px;
    }

    .edit-header::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
        bottom: -100px;
        left: -60px;
    }

    .edit-header-content {
        position: relative;
        z-index: 2;
    }

    .edit-icon {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 17px;
        background: rgba(255,255,255,.18);
        font-size: 27px;
    }

    .form-card {
        border: none;
        border-radius: 20px;
        background: #fff;
    }

    .form-label {
        color: #343a40;
        font-weight: 600;
    }

    .form-control {
        padding: 12px 15px;
        border-radius: 12px;
        border: 1px solid #dee2e6;
    }

    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 .2rem rgba(13,110,253,.12);
    }

    .current-type {
        padding: 18px;
        border: 1px solid #e8f1ff;
        border-radius: 15px;
        background: #f8fbff;
    }

    .current-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 16px;
        border-radius: 50px;
        color: #0d6efd;
        background: rgba(13,110,253,.10);
        font-weight: 600;
    }

    .btn-simpan,
    .btn-kembali,
    .btn-hapus {
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
    }

    .danger-box {
        margin-top: 30px;
        padding: 20px;
        border: 1px solid #f5c2c7;
        border-radius: 16px;
        background: #fff5f5;
    }

    .danger-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 14px;
        color: #dc3545;
        background: rgba(220,53,69,.10);
        font-size: 21px;
    }

    @media (max-width: 576px) {

        .jenis-edit-page {
            padding-left: 8px;
            padding-right: 8px;
        }

        .edit-header {
            border-radius: 16px;
        }

        .danger-box .d-flex {
            align-items: flex-start !important;
        }

        .btn-hapus {
            width: 100%;
        }
    }
</style>


<div class="container-fluid py-4 jenis-edit-page">

    {{-- HEADER --}}
    <div class="edit-header shadow-sm p-4 p-md-5 mb-4">

        <div class="edit-header-content">

            <div class="d-flex align-items-center">

                <div class="edit-icon me-3">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <div>

                    <h3 class="fw-bold mb-1">
                        Edit Jenis Produk
                    </h3>

                    <p class="mb-0 opacity-75">
                        Perbarui informasi jenis produk.
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- ERROR --}}
    @if ($errors->any())

        <div class="alert alert-danger border-0 rounded-4 shadow-sm">

            <div class="fw-bold mb-2">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Terjadi kesalahan
            </div>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- CARD --}}
    <div class="card form-card shadow-sm">

        <div class="card-body p-4 p-md-5">

            {{-- JENIS SAAT INI --}}
            <div class="current-type mb-4">

                <small class="text-muted d-block mb-2">
                    Jenis saat ini
                </small>

                <span class="current-badge">

                    <i class="bi bi-tag-fill"></i>

                    {{ $jenis->nama_jenis }}

                </span>

            </div>


            {{-- FORM EDIT --}}
            <form
                action="{{ route('jenis.update', $jenis->id) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="mb-4">

                    <label
                        for="nama_jenis"
                        class="form-label"
                    >
                        Nama Jenis
                    </label>

                    <input
                        type="text"
                        name="nama_jenis"
                        id="nama_jenis"
                        class="form-control @error('nama_jenis') is-invalid @enderror"
                        value="{{ old('nama_jenis', $jenis->nama_jenis) }}"
                        placeholder="Masukkan nama jenis"
                        required
                    >

                    @error('nama_jenis')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- TOMBOL --}}
                <div class="d-flex flex-wrap gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary btn-simpan"
                    >
                        <i class="bi bi-check-lg me-1"></i>
                        Simpan Perubahan
                    </button>

                    <a
                        href="{{ route('jenis.index') }}"
                        class="btn btn-secondary btn-kembali"
                    >
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                    </a>

                </div>

            </form>


            {{-- HAPUS --}}
            <div class="danger-box">

                <div class="d-flex justify-content-between align-items-center gap-3">

                    <div class="d-flex align-items-center">

                        <div class="danger-icon me-3">
                            <i class="bi bi-trash3-fill"></i>
                        </div>

                        <div>

                            <h6 class="fw-bold text-danger mb-1">
                                Hapus Jenis
                            </h6>

                            <small class="text-muted">
                                Jenis ini akan dihapus secara permanen.
                            </small>

                        </div>

                    </div>


                    <form
                        action="{{ route('jenis.destroy', $jenis->id) }}"
                        method="POST"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger btn-hapus"
                            onclick="return confirm('Yakin ingin menghapus jenis ini?')"
                        >
                            <i class="bi bi-trash3 me-1"></i>
                            Hapus
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection