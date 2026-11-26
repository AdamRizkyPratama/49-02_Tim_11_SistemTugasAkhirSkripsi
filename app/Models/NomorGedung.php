<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NomorGedung extends Model
{
    protected $table = 'nomor_gedung';

    public $timestamps = false;

    protected $fillable = ['nama_gedung'];
}
