<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;


class DosenController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->query('cari', '');
        $dosen = Dosen::where('nama', 'like', "%{$cari}%")
            ->orWhere('nidn', 'like', "%{$cari}%")
            ->orWhere('kepakaran', 'like', "%{$cari}%")
            ->orderBy('nama')
            ->get();

        return view('dosen.index', compact('dosen', 'cari'));
    }

    public function show(Dosen $dosen)
    {
        return view('dosen.show', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nidn'       => ['required', 'max:50', 'unique:dosen_bimbingan,nidn'],
            'nama'       => 'required|max:255',
            'foto'       => 'nullable|string|max:255',
            'jabatan'    => 'nullable|string|max:255',
            'kepakaran'  => 'nullable|string|max:255',
            'email'      => 'nullable|email|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'deskripsi'  => 'nullable|string',
        ], [
            'nidn.unique' => 'NIDN sudah terdaftar',
        ]);

        Dosen::create($data);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        return view('dosen.form', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $data = $request->validate([
            'nama'       => 'required|max:255',
            'foto'       => 'nullable|string|max:255',
            'jabatan'    => 'nullable|string|max:255',
            'kepakaran'  => 'nullable|string|max:255',
            'email'      => 'nullable|email|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'deskripsi'  => 'nullable|string',
        ]);

        $dosen->update($data);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus.');
    }
}
