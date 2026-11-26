<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rincian Topik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<x-navbar />
<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 750px;">
        <div class="card-body p-4 p-md-5">
            <span class="badge bg-primary-subtle text-primary mb-2">{{ strtoupper($topik->id) }}</span>
            <h2 class="fw-bold mb-4">{{ $topik->nama }}</h2>

            <h6 class="text-secondary">Topik Riset Utama</h6>
            <p>{{ $topik->topik_utama ?: '-' }}</p>

            <h6 class="text-secondary">Kata Kunci</h6>
            <p>
                @forelse (array_filter(array_map('trim', explode(',', $topik->keywords))) as $k)
                    <span class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis">{{ $k }}</span>
                @empty
                    -
                @endforelse
            </p>

            <h6 class="text-secondary">Deskripsi Fokus</h6>
            <p>{{ $topik->deskripsi ?: '-' }}</p>

            <h6 class="text-secondary">Studi Kasus</h6>
            <p>{{ $topik->studi_kasus ?: '-' }}</p>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('topik.index') }}" class="btn btn-outline-secondary">Kembali</a>
                @if (auth()->user()->hasRole('admin'))
                    <a href="{{ route('topik.edit', $topik->id) }}" class="btn btn-warning">Edit</a>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
