<?php

namespace App\Http\Controllers;

use App\Models\Topik;
use Illuminate\Http\Request;

class TopikController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->query('cari', '');
        $topik = Topik::where('nama', 'like', "%{$cari}%")->orderBy('nama')->get();
        return view('topik.index', compact('topik', 'cari'));
    }

    public function show(Topik $topik)
    {
        return view('topik.show', compact('topik'));
    }

    public function create()
    {
        return view('topik.form');
    }

    public function store(Request $request)
    {
        $request->merge(['id' => strtolower(trim($request->id ?? ''))]);

        $data = $request->validate([
            'id'          => ['required', 'regex:/^[a-z0-9_-]{1,50}$/', 'unique:topik,id'],
            'nama'        => 'required|max:255',
            'topik_utama' => 'nullable|string',
            'keywords'    => 'nullable|string',
            'deskripsi'   => 'nullable|string',
            'studi_kasus' => 'nullable|string',
        ], [
            'id.regex'  => 'ID hanya boleh huruf kecil, angka, - dan _',
            'id.unique' => 'ID sudah dipakai',
        ]);

        Topik::create(array_map(fn($v) => $v ?? '', $data));
        return redirect()->route('topik.index')->with('success', 'Topik berhasil ditambahkan.');
    }

    public function edit(Topik $topik)
    {
        return view('topik.form', compact('topik'));
    }

    public function update(Request $request, Topik $topik)
    {
        $data = $request->validate([
            'nama'        => 'required|max:255',
            'topik_utama' => 'nullable|string',
            'keywords'    => 'nullable|string',
            'deskripsi'   => 'nullable|string',
            'studi_kasus' => 'nullable|string',
        ]);

        $topik->update(array_map(fn($v) => $v ?? '', $data));
        return redirect()->route('topik.index')->with('success', 'Topik berhasil diperbarui.');
    }

    public function destroy(Topik $topik)
    {
        $topik->delete();
        return redirect()->route('topik.index')->with('success', 'Topik berhasil dihapus.');
    }
}