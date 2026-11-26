<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    protected $table = 'topik';
    protected $primaryKey = 'id';
    public $incrementing = false;  
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['id', 'nama', 'topik_utama', 'keywords', 'deskripsi', 'studi_kasus'];
}
