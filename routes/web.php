<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\InvetationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('colocations', ColocationController::class);
    Route::resource('expenses', DepenseController::class);
    Route::resource('categories', InvetationController::class);
    Route::get('admin', [ColocationController::class, 'stats'])->name('admin.stats');
    Route::get('admins', [ColocationController::class, 'stats'])->name('admin.users');
    Route::post('invitations', [InvetationController::class, 'store'])->name('invitations.store');
    Route::get('/invitations/{token}', [InvetationController::class, 'show'])->name('invitations.show');
    Route::post('/invitations/{token}', [InvetationController::class, 'accepter'])->name('invitations.accepter');
});


require __DIR__ . '/auth.php';
