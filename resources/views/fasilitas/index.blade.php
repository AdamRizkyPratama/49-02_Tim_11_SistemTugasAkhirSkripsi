@php $isAdmin = auth()->user()->hasRole('admin'); @endphp

<x-layout title="Fasilitas Ruangan">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h3 class="fw-bold mb-1">Fasilitas Ruangan</h3>
            <p class="text-secondary mb-0">Ketersediaan proyektor dan PC di tiap ruang.</p>
        </div>

        @if ($isAdmin)
            <a href="{{ route('fasilitas.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Tambah Fasilitas
            </a>
        @endif
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" style="width: 80px;">No.</th>
                        <th>Ruang</th>
                        <th>Proyektor</th>
                        <th>PC</th>
                        @if ($isAdmin)
                            <th class="text-end pe-4">Aksi</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data as $row)
                        <tr>
                            <td class="ps-4">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $row->nama_ruang }}</td>
                            <td>
                                <span class="badge rounded-pill {{ $row->proyektor === 'Ada' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $row->proyektor }}
                                </span>
                            </td>
                            <td>
                                <span class="badge rounded-pill {{ $row->pc === 'Ada' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $row->pc }}
                                </span>
                            </td>

                            @if ($isAdmin)
                                <td class="pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('fasilitas.edit', $row->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('fasilitas.destroy', $row->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $isAdmin ? 5 : 4 }}"
                                class="text-center text-secondary py-4">
                                Belum ada data fasilitas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layout>
