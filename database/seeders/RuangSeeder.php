<?php

namespace Database\Seeders;

use App\Models\FasilitasRuang;
use App\Models\MasterRuang;
use App\Models\NomorGedung;
use Illuminate\Database\Seeder;

class RuangSeeder extends Seeder
{
    public function run(): void
    {
        if (MasterRuang::count() === 0) {
            MasterRuang::insert([
                ['nama_ruang' => 'Ruang Sidang 1', 'gedung' => 'Gedung D'],
                ['nama_ruang' => 'Ruang Sidang 2', 'gedung' => 'Gedung D'],
            ]);
        }

        if (NomorGedung::count() === 0) {
            NomorGedung::insert([
                ['nama_gedung' => 'Gedung A'],
                ['nama_gedung' => 'Gedung B'],
                ['nama_gedung' => 'Gedung D'],
            ]);
        }

        if (FasilitasRuang::count() === 0) {
            FasilitasRuang::insert([
                ['nama_ruang' => 'Ruang Sidang 1', 'proyektor' => 'Ada',       'pc' => 'Ada'],
                ['nama_ruang' => 'Ruang Sidang 2', 'proyektor' => 'Ada',       'pc' => 'Tidak Ada'],
                ['nama_ruang' => 'Ruang Sidang 3', 'proyektor' => 'Tidak Ada', 'pc' => 'Ada'],
            ]);
        }
    }
}
