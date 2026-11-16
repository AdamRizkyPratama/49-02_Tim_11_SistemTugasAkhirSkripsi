<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        .stat-card { border-left: 4px solid; }
        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }
        .avatar-initial {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e7f1ff;
            color: #0d6efd;
            font-weight: 700;
            font-size: 1.1rem;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Dashboard Admin</h2>
            <p class="text-secondary mb-0">
                Halo, {{ auth()->user()->name }}
                <span class="badge bg-danger">Admin</span>
            </p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('profile.edit') }}"
               class="btn btn-outline-secondary btn-sm">
                Profil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="alert alert-primary border-0 shadow-sm" role="alert">
        Anda login sebagai <strong>Admin</strong>. Anda dapat melihat,
        menambah, mengubah, dan menghapus data mahasiswa.
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card stat-card border-0 shadow-sm h-100"
                 style="border-left-color: #0d6efd !important;">
                <div class="card-body">
                    <p class="text-secondary small text-uppercase fw-semibold mb-1">
                        Total Mahasiswa
                    </p>
                    <h2 class="fw-bold mb-0">{{ $total }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card border-0 shadow-sm h-100"
                 style="border-left-color: #198754 !important;">
                <div class="card-body">
                    <p class="text-secondary small text-uppercase fw-semibold mb-1">
                        Mahasiswa Aktif
                    </p>
                    <h2 class="fw-bold text-success mb-0">{{ $aktif }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card border-0 shadow-sm h-100"
                 style="border-left-color: #6c757d !important;">
                <div class="card-body">
                    <p class="text-secondary small text-uppercase fw-semibold mb-1">
                        Tidak Aktif
                    </p>
                    <h2 class="fw-bold text-secondary mb-0">{{ $tidakAktif }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div>
                    <h5 class="fw-bold mb-0">Mahasiswa Terbaru</h5>
                    <p class="text-secondary small mb-0">
                        5 data yang terakhir ditambahkan
                    </p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('mahasiswa.index') }}"
                       class="btn btn-outline-primary btn-sm">
                        Lihat Semua
                    </a>

                    <a href="{{ route('mahasiswa.create') }}"
                       class="btn btn-primary btn-sm">
                        + Tambah Mahasiswa
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-2 p-md-3">
            <div class="list-group list-group-flush">

                @forelse ($terbaru as $mhs)
                    <a href="{{ route('mahasiswa.show', $mhs->id) }}"
                       class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3">

                        @if ($mhs->gambar)
                            <img src="{{ asset('storage/' . $mhs->gambar) }}"
                                 alt="Foto {{ $mhs->nama }}"
                                 class="avatar">
                        @else
                            <div class="avatar avatar-initial">
                                {{ strtoupper(mb_substr($mhs->nama, 0, 1)) }}
                            </div>
                        @endif

                        <div class="flex-grow-1">
                            <div class="fw-semibold">{{ $mhs->nama }}</div>
                            <div class="text-secondary small">
                                {{ $mhs->nim }}
                                &middot; Angkatan {{ $mhs->angkatan }}
                                &middot; {{ $mhs->sks_lulus }} SKS
                            </div>
                        </div>

                        <div class="text-end">
                            @if ($mhs->status_keaktifan == 'Aktif')
                                <span class="badge rounded-pill bg-success">Aktif</span>
                            @else
                                <span class="badge rounded-pill bg-secondary">Tidak Aktif</span>
                            @endif

                            @if ($mhs->created_at)
                                <div class="text-secondary small mt-1">
                                    {{ $mhs->created_at->locale('id')->diffForHumans() }}
                                </div>
                            @endif
                        </div>

                    </a>
                @empty
                    <div class="text-center text-secondary py-5">
                        Belum ada data mahasiswa.
                    </div>
                @endforelse

            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>