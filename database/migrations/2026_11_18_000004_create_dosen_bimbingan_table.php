<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosen_bimbingan', function (Blueprint $table) {
            $table->string('nidn', 50)->primary();
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('kepakaran')->nullable();
            $table->string('email')->nullable();
            $table->string('pendidikan')->nullable();
            $table->text('deskripsi')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen_bimbingan');
    }
};
