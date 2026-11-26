<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Topik Riset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<x-navbar />
<div class="container py-5">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <h2 class="fw-bold mb-0">Topik Riset &amp; Bidang Minat</h2>

        @if (auth()->user()->hasRole('admin'))
            <a href="{{ route('topik.create') }}" class="btn btn-primary">+ Tambah Topik</a>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('topik.index') }}" method="GET" class="row g-2 mb-4">
        <div class="col-md-9">
            <input type="text" name="cari" class="form-control"
                   placeholder="Cari topik..." value="{{ $cari }}">
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">Cari</button>
            <a href="{{ route('topik.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
        </div>
    </form>

    <div class="row g-4">
        @forelse ($topik as $t)
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <a href="{{ route('topik.show', $t->id) }}" class="text-decoration-none text-reset">
                        <div class="d-flex align-items-center justify-content-center fs-3 fw-bold"
                             style="height:120px;background:linear-gradient(135deg,#dbeafe,#e0e7ff);">
                            {{ strtoupper($t->id) }}
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0">{{ $t->nama }}</h6>
                        </div>
                    </a>

                    @if (auth()->user()->hasRole('admin'))
                        <div class="card-footer bg-white border-0 d-flex justify-content-center gap-2 pb-3">
                            <a href="{{ route('topik.edit', $t->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('topik.destroy', $t->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus topik ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-secondary py-5">Topik tidak ditemukan.</div>
        @endforelse
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
