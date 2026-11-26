<x-layout :title="$item ? 'Edit Ruang' : 'Tambah Ruang'">

    <div class="card border-0 shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body p-4">

            <h4 class="fw-bold mb-1">{{ $item ? 'Edit Ruang' : 'Tambah Ruang' }}</h4>
            <p class="text-secondary mb-4">
                {{ $item ? 'Perbarui data ruang sidang.' : 'Isi data ruang sidang baru.' }}
            </p>

            <form method="POST"
                  action="{{ $item ? route('ruang.update', $item->id) : route('ruang.store') }}">
                @csrf
                @if ($item)
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nama_ruang" class="form-label">Nama Ruang</label>
                    <input type="text" id="nama_ruang" name="nama_ruang"
                           class="form-control"
                           value="{{ old('nama_ruang', $item?->nama_ruang) }}"
                           placeholder="Contoh: Ruang Sidang 3"
                           required>
                </div>

                <div class="mb-4">
                    <label for="gedung" class="form-label">Gedung</label>
                    <input type="text" id="gedung" name="gedung"
                           class="form-control"
                           list="daftar-gedung"
                           value="{{ old('gedung', $item?->gedung) }}"
                           placeholder="Contoh: Gedung D"
                           required>
                    <datalist id="daftar-gedung">
                        @foreach ($gedung as $nama)
                            <option value="{{ $nama }}"></option>
                        @endforeach
                    </datalist>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                    <a href="{{ route('ruang.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>

</x-layout>
