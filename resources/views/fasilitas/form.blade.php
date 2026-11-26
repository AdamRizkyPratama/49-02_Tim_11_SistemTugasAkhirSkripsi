<x-layout :title="$item ? 'Edit Fasilitas' : 'Tambah Fasilitas'">

    <div class="card border-0 shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body p-4">

            <h4 class="fw-bold mb-1">{{ $item ? 'Edit Fasilitas' : 'Tambah Fasilitas' }}</h4>
            <p class="text-secondary mb-4">
                {{ $item ? 'Perbarui data fasilitas ruangan.' : 'Isi data fasilitas ruangan baru.' }}
            </p>

            <form method="POST"
                  action="{{ $item ? route('fasilitas.update', $item->id) : route('fasilitas.store') }}">
                @csrf
                @if ($item)
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nama_ruang" class="form-label">Ruang</label>
                    <input type="text" id="nama_ruang" name="nama_ruang"
                           class="form-control"
                           list="daftar-ruang"
                           value="{{ old('nama_ruang', $item?->nama_ruang) }}"
                           placeholder="Contoh: Ruang Sidang 4"
                           required>
                    <datalist id="daftar-ruang">
                        @foreach ($ruang as $nama)
                            <option value="{{ $nama }}"></option>
                        @endforeach
                    </datalist>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="proyektor" class="form-label">Proyektor</label>
                        <select id="proyektor" name="proyektor" class="form-select" required>
                            @foreach ($opsi as $status)
                                <option value="{{ $status }}"
                                    {{ old('proyektor', $item?->proyektor ?? 'Ada') === $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="pc" class="form-label">PC</label>
                        <select id="pc" name="pc" class="form-select" required>
                            @foreach ($opsi as $status)
                                <option value="{{ $status }}"
                                    {{ old('pc', $item?->pc ?? 'Ada') === $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                    <a href="{{ route('fasilitas.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>

</x-layout>
