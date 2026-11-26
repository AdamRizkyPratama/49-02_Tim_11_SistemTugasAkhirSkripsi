@php $isAdmin = auth()->user()->hasRole('admin'); @endphp

<x-layout title="Nomor Gedung">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h3 class="fw-bold mb-1">Nomor Gedung</h3>
            <p class="text-secondary mb-0">Daftar gedung yang dipakai untuk ruang sidang.</p>
        </div>

        @if ($isAdmin)
            <a href="{{ route('gedung.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Tambah Gedung
            </a>
        @endif
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" style="width: 80px;">No.</th>
                        <th>Nomor/Nama Gedung</th>
                        @if ($isAdmin)
                            <th class="text-end pe-4">Aksi</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data as $row)
                        <tr>
                            <td class="ps-4">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $row->nama_gedung }}</td>

                            @if ($isAdmin)
                                <td class="pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('gedung.edit', $row->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('gedung.destroy', $row->id) }}"
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
                            <td colspan="{{ $isAdmin ? 3 : 2 }}"
                                class="text-center text-secondary py-4">
                                Belum ada data gedung.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layout>
