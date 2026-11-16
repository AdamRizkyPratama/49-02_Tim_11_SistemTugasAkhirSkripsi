<?php

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use App\Models\Mahasiswa;


Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});

// Redirect ke mahasiswa (kalo bukan admin)
Route::get('/dashboard', function (Request $request) { 
    if (! $request->user()->hasRole('admin')) {         
        return redirect()->route('mahasiswa.index');
    }

    return view('dashboard', [
        'total'      => Mahasiswa::count(),
        'aktif'      => Mahasiswa::where('status_keaktifan', 'Aktif')->count(),
        'tidakAktif' => Mahasiswa::where('status_keaktifan', '!=', 'Aktif')->count(),
        'terbaru'    => Mahasiswa::latest()->take(5)->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::middleware('role:admin')->group(function () {
        Route::resource('mahasiswa', MahasiswaController::class)
            ->except(['index', 'show']);
    });

    Route::resource('mahasiswa', MahasiswaController::class)
        ->only(['index', 'show']);

    // Profile Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';