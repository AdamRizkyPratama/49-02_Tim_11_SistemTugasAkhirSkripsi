<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>
        body { background: #f5f7fb; }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }
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
            background: #e0e7ff;
            color: #4338ca;
            font-weight: 700;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

<x-navbar />

<div class="container py-4">

    <div class="mb-4">
        <h3 class="fw-bold mb-1">Dashboard</h3>
        <p class="text-secondary mb-0">
            Selamat datang kembali, {{ auth()->user()->name }}.
        </p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-primary-subtle text-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <div class="text-secondary small">Total Mahasiswa</div>
                        <div class="fs-3 fw-bold lh-1 mt-1">{{ $total }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-success-subtle text-success">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                    <div>
                        <div class="text-secondary small">Mahasiswa Aktif</div>
                        <div class="fs-3 fw-bold lh-1 mt-1">{{ $aktif }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-secondary-subtle text-secondary">
                        <i class="bi bi-person-dash-fill"></i>
                    </div>
                    <div>
                        <div class="text-secondary small">Tidak Aktif</div>
                        <div class="fs-3 fw-bold lh-1 mt-1">{{ $tidakAktif }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
            <h5 class="fw-bold mb-0">Mahasiswa Terbaru</h5>
            <p class="text-secondary small mb-0">
                5 data yang terakhir ditambahkan
            </p>
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