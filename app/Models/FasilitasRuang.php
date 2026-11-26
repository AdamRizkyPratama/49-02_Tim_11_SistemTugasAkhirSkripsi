<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FasilitasRuang extends Model
{
    protected $table = 'fasilitas_ruang';

    public $timestamps = false;

    protected $fillable = ['nama_ruang', 'proyektor', 'pc'];
}
