<?php

namespace App\Http\Controllers;

use App\Models\FasilitasRuang;
use App\Models\MasterRuang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FasilitasRuangController extends Controller
{
    private const STATUS = ['Ada', 'Tidak Ada'];

    public function index()
    {
        return view('fasilitas.index', [
            'data' => FasilitasRuang::orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        return view('fasilitas.form', [
            'item'  => null,
            'ruang' => MasterRuang::orderBy('nama_ruang')->pluck('nama_ruang'),
            'opsi'  => self::STATUS,
        ]);
    }

    public function store(Request $request)
    {
        FasilitasRuang::create($this->validated($request));

        return redirect()->route('fasilitas.index')
            ->with('success', 'Data fasilitas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('fasilitas.form', [
            'item'  => FasilitasRuang::findOrFail($id),
            'ruang' => MasterRuang::orderBy('nama_ruang')->pluck('nama_ruang'),
            'opsi'  => self::STATUS,
        ]);
    }

    public function update(Request $request, $id)
    {
        FasilitasRuang::findOrFail($id)->update($this->validated($request));

        return redirect()->route('fasilitas.index')
            ->with('success', 'Data fasilitas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        FasilitasRuang::findOrFail($id)->delete();

        return redirect()->route('fasilitas.index')
            ->with('success', 'Data fasilitas berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama_ruang' => ['required', 'string', 'max:100'],
            'proyektor'  => ['required', Rule::in(self::STATUS)],
            'pc'         => ['required', Rule::in(self::STATUS)],
        ], [
            'nama_ruang.required' => 'Nama ruang wajib diisi.',
            'proyektor.required'  => 'Status proyektor wajib dipilih.',
            'proyektor.in'        => 'Status proyektor tidak valid.',
            'pc.required'         => 'Status PC wajib dipilih.',
            'pc.in'               => 'Status PC tidak valid.',
        ]);
    }
}
