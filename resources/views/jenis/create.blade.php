@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Tambah Jenis</h1>

        <a href="{{ route('jenis.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <form action="{{ route('jenis.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_jenis" class="form-label">
                        Nama Jenis
                    </label>

                    <input
                        type="text"
                        name="nama_jenis"
                        id="nama_jenis"
                        class="form-control"
                        value="{{ old('nama_jenis') }}"
                        placeholder="Masukkan nama jenis"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('jenis.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </form>

        </div>
    </div>
</div>
@endsection

