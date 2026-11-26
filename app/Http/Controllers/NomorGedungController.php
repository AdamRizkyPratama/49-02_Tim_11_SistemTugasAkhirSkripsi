<?php

namespace App\Http\Controllers;

use App\Models\NomorGedung;
use Illuminate\Http\Request;

class NomorGedungController extends Controller
{
    public function index()
    {
        return view('gedung.index', [
            'data' => NomorGedung::orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('gedung.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        NomorGedung::create($this->validated($request));

        return redirect()->route('gedung.index')
            ->with('success', 'Data gedung berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('gedung.form', [
            'item' => NomorGedung::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        NomorGedung::findOrFail($id)->update($this->validated($request));

        return redirect()->route('gedung.index')
            ->with('success', 'Data gedung berhasil diperbarui.');
    }

    public function destroy($id)
    {
        NomorGedung::findOrFail($id)->delete();

        return redirect()->route('gedung.index')
            ->with('success', 'Data gedung berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama_gedung' => ['required', 'string', 'max:100'],
        ], [
            'nama_gedung.required' => 'Nomor atau nama gedung wajib diisi.',
        ]);
    }
}
