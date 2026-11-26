<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<x-navbar />
<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 750px;">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex flex-wrap align-items-center gap-4 mb-4">
                @if ($dosen->foto)
                    <img src="{{ $dosen->foto }}" alt="{{ $dosen->nama }}" class="rounded-3"
                         style="width:140px;height:140px;object-fit:cover;">
                @else
                    <div class="rounded-3 d-flex align-items-center justify-content-center fs-1 fw-bold"
                         style="width:140px;height:140px;background:linear-gradient(135deg,#dbeafe,#e0e7ff);">
                        {{ strtoupper(mb_substr($dosen->nama, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <span class="badge bg-primary-subtle text-primary mb-2">NIDN {{ $dosen->nidn }}</span>
                    <h2 class="fw-bold mb-0">{{ $dosen->nama }}</h2>
                </div>
            </div>

            <h6 class="text-secondary">Jabatan Fungsional</h6>
            <p>{{ $dosen->jabatan ?: '-' }}</p>

            <h6 class="text-secondary">Kepakaran Riset</h6>
            <p>{{ $dosen->kepakaran ?: '-' }}</p>

            <h6 class="text-secondary">Email</h6>
            <p>{{ $dosen->email ?: '-' }}</p>

            <h6 class="text-secondary">Pendidikan</h6>
            <p>{{ $dosen->pendidikan ?: '-' }}</p>

            <h6 class="text-secondary">Deskripsi</h6>
            <p>{{ $dosen->deskripsi ?: '-' }}</p>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary">Kembali</a>
                <a href="{{ route('dosen.edit', $dosen->nidn) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
