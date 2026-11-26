<x-layout :title="$item ? 'Edit Gedung' : 'Tambah Gedung'">

    <div class="card border-0 shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body p-4">

            <h4 class="fw-bold mb-1">{{ $item ? 'Edit Gedung' : 'Tambah Gedung' }}</h4>
            <p class="text-secondary mb-4">
                {{ $item ? 'Perbarui data gedung.' : 'Isi data gedung baru.' }}
            </p>

            <form method="POST"
                  action="{{ $item ? route('gedung.update', $item->id) : route('gedung.store') }}">
                @csrf
                @if ($item)
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="nama_gedung" class="form-label">Nomor/Nama Gedung</label>
                    <input type="text" id="nama_gedung" name="nama_gedung"
                           class="form-control"
                           value="{{ old('nama_gedung', $item?->nama_gedung) }}"
                           placeholder="Contoh: Gedung E"
                           required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                    <a href="{{ route('gedung.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>

</x-layout>
