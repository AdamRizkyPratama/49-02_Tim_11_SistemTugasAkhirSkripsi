<?php

namespace App\Http\Controllers;

use App\Models\MasterRuang;
use App\Models\NomorGedung;
use Illuminate\Http\Request;

class MasterRuangController extends Controller
{
    public function index()
    {
        return view('ruang.index', [
            'data' => MasterRuang::orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('ruang.form', [
            'item'   => null,
            'gedung' => NomorGedung::orderBy('nama_gedung')->pluck('nama_gedung'),
        ]);
    }

    public function store(Request $request)
    {
        MasterRuang::create($this->validated($request));

        return redirect()->route('ruang.index')
            ->with('success', 'Data ruang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('ruang.form', [
            'item'   => MasterRuang::findOrFail($id),
            'gedung' => NomorGedung::orderBy('nama_gedung')->pluck('nama_gedung'),
        ]);
    }

    public function update(Request $request, $id)
    {
        MasterRuang::findOrFail($id)->update($this->validated($request));

        return redirect()->route('ruang.index')
            ->with('success', 'Data ruang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        MasterRuang::findOrFail($id)->delete();

        return redirect()->route('ruang.index')
            ->with('success', 'Data ruang berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama_ruang' => ['required', 'string', 'max:100'],
            'gedung'     => ['required', 'string', 'max:100'],
        ], [
            'nama_ruang.required' => 'Nama ruang wajib diisi.',
            'gedung.required'     => 'Gedung wajib diisi.',
        ]);
    }
}
