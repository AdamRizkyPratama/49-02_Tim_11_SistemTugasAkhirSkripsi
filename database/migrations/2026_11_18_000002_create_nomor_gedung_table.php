<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('nomor_gedung')) {
            Schema::create('nomor_gedung', function (Blueprint $table) {
                $table->id();
                $table->string('nama_gedung', 100);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('nomor_gedung');
    }
};
