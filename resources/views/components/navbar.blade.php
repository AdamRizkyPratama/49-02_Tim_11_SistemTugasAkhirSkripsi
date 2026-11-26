<style>
    .app-navbar {
        background: #ffffff;
        border-bottom: 1px solid #e5e7eb;
    }
    .app-brand {
        display: flex;
        align-items: center;
        gap: .65rem;
        font-weight: 700;
        color: #111827;
        text-decoration: none;
        letter-spacing: -.01em;
    }
    .app-brand-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #2563eb, #4f46e5);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
    }
    .app-link {
        position: relative;
        color: #6b7280;
        font-weight: 500;
        font-size: .93rem;
        padding: 1.15rem .25rem !important;
        margin: 0 .75rem;
        display: flex;
        align-items: center;
        gap: .4rem;
        transition: color .15s;
    }
    .app-link:hover { color: #111827; }
    .app-link.active { color: #2563eb; }
    .app-link.active::after {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        bottom: -1px;
        height: 2px;
        background: #2563eb;
        border-radius: 2px 2px 0 0;
    }
    .app-user {
        display: flex;
        align-items: center;
        gap: .6rem;
        padding: .3rem .6rem .3rem .3rem;
        border: 1px solid #e5e7eb;
        border-radius: 999px;
        background: #fff;
        color: #111827;
        text-decoration: none;
        transition: background .15s;
    }
    .app-user:hover { background: #f9fafb; }
    .app-user::after { display: none; }
    .app-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #e0e7ff;
        color: #4338ca;
        font-weight: 700;
        font-size: .85rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .app-user-name {
        font-size: .875rem;
        font-weight: 600;
        line-height: 1.1;
    }
    .app-user-role {
        font-size: .72rem;
        color: #6b7280;
        line-height: 1.1;
    }
    .app-dropdown {
        min-width: 230px;
        border: 1px solid #e5e7eb;
        border-radius: .75rem;
        padding: .5rem;
    }
    .app-dropdown .dropdown-item {
        border-radius: .5rem;
        font-size: .9rem;
        padding: .5rem .75rem;
    }
    @media (max-width: 767.98px) {
        .app-link {
            padding: .75rem .25rem !important;
            margin: 0;
        }
        .app-link.active::after { display: none; }
    }
</style>

<nav class="navbar navbar-expand-md app-navbar sticky-top py-0">
    <div class="container">

        <a href="{{ auth()->user()->hasRole('admin') ? route('dashboard') : route('mahasiswa.index') }}"
           class="app-brand">
            <span class="app-brand-icon">
                <i class="bi bi-mortarboard-fill"></i>
            </span>
            Data Mahasiswa
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="bi bi-list fs-2"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav ms-md-4 me-auto">
                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                           class="nav-link app-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid-1x2"></i>
                            Dashboard
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('mahasiswa.index') }}"
                       class="nav-link app-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        Kelola Mahasiswa
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="#"
                       class="nav-link app-link {{ request()->routeIs('ruang.*', 'gedung.*', 'fasilitas.*') ? 'active' : '' }}"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-building"></i>
                        Ruang &amp; Sidang
                        <i class="bi bi-chevron-down small"></i>
                    </a>

                    <ul class="dropdown-menu app-dropdown shadow">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('ruang.*') ? 'active' : '' }}"
                               href="{{ route('ruang.index') }}">
                                <i class="bi bi-door-open me-2"></i>Master Ruang
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('gedung.*') ? 'active' : '' }}"
                               href="{{ route('gedung.index') }}">
                                <i class="bi bi-buildings me-2"></i>Nomor Gedung
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('fasilitas.*') ? 'active' : '' }}"
                               href="{{ route('fasilitas.index') }}">
                                <i class="bi bi-projector me-2"></i>Fasilitas Ruangan
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('topik.index') }}"
                       class="nav-link app-link {{ request()->routeIs('topik.*') ? 'active' : '' }}">
                        <i class="bi bi-journal-text"></i>
                        Topik Riset
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('dosen.index') }}"
                    class="nav-link app-link {{ request()->routeIs('dosen.*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge"></i>
                        Dosen Pembimbing
                    </a>
                </li>
            </ul>

            <div class="dropdown py-2 py-md-0">
                <a href="#"
                   class="app-user dropdown-toggle"
                   data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <span class="app-avatar">
                        {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                    </span>
                    <span class="d-flex flex-column">
                        <span class="app-user-name">{{ auth()->user()->name }}</span>
                        <span class="app-user-role">{{ ucfirst(auth()->user()->role) }}</span>
                    </span>
                    <i class="bi bi-chevron-down small text-secondary"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow app-dropdown">
                    <li class="px-3 py-2">
                        <div class="fw-semibold small">{{ auth()->user()->name }}</div>
                        <div class="text-secondary small">{{ auth()->user()->email }}</div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person me-2"></i>Profil Saya
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>