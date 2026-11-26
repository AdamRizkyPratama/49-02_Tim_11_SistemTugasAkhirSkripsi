<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterRuang extends Model
{
    protected $table = 'master_ruang';

    public $timestamps = false;

    protected $fillable = ['nama_ruang', 'gedung'];
}
