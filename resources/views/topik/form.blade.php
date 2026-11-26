<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Topik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<x-navbar />
@php $edit = isset($topik); @endphp
<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 750px;">
        <div class="card-body p-4 p-md-5">

            <h2 class="fw-bold mb-4">{{ $edit ? 'Edit' : 'Tambah' }} Topik</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ $edit ? route('topik.update', $topik->id) : route('topik.store') }}">
                @csrf
                @if ($edit) @method('PUT') @endif

                <div class="mb-3">
                    <label for="id" class="form-label">ID @unless($edit)<small class="text-secondary">(contoh: datamining)</small>@endunless</label>
                    <input type="text" id="id" name="id" class="form-control"
                           value="{{ old('id', $topik->id ?? '') }}"
                           {{ $edit ? 'readonly' : 'required' }}>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Topik</label>
                    <input type="text" id="nama" name="nama" class="form-control"
                           value="{{ old('nama', $topik->nama ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="topik_utama" class="form-label">Topik Riset Utama</label>
                    <input type="text" id="topik_utama" name="topik_utama" class="form-control"
                           value="{{ old('topik_utama', $topik->topik_utama ?? '') }}">
                </div>

                <div class="mb-3">
                    <label for="keywords" class="form-label">Kata Kunci <small class="text-secondary">(pisahkan dengan koma)</small></label>
                    <input type="text" id="keywords" name="keywords" class="form-control"
                           value="{{ old('keywords', $topik->keywords ?? '') }}">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Fokus</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $topik->deskripsi ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="studi_kasus" class="form-label">Studi Kasus</label>
                    <textarea id="studi_kasus" name="studi_kasus" rows="3" class="form-control">{{ old('studi_kasus', $topik->studi_kasus ?? '') }}</textarea>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">{{ $edit ? 'Simpan Perubahan' : 'Simpan' }}</button>
                    <a href="{{ route('topik.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
