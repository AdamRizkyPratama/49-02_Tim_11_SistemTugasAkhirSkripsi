<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('fasilitas_ruang')) {
            Schema::create('fasilitas_ruang', function (Blueprint $table) {
                $table->id();
                $table->string('nama_ruang', 100);
                $table->string('proyektor', 50);
                $table->string('pc', 50);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas_ruang');
    }
};
