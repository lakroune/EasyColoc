<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\InvetationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Colocations Routes (Manual) ---
    Route::get('/colocations', [ColocationController::class, 'index'])->name('colocations.index');
    Route::post('/colocations', [ColocationController::class, 'store'])->name('colocations.store');
    Route::get('/colocations/{colocation}', [ColocationController::class, 'show'])->name('colocations.show');
    Route::delete('/colocations/{colocation}', [ColocationController::class, 'destroy'])->name('colocations.destroy');
    Route::put('/colocations/{colocation}', [ColocationController::class, 'leave'])->name('colocations.leave');

    Route::get('/expenses', [DepenseController::class, 'index'])->name('expenses.index');
    Route::post('/expenses', [DepenseController::class, 'store'])->name('expenses.store');
    Route::delete('/expenses/{expense}', [DepenseController::class, 'destroy'])->name('expenses.destroy');

    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');

    Route::post('/invitations', [InvetationController::class, 'store'])->name('invitations.store');
    Route::get('/invitations/{token}', [InvetationController::class, 'show'])->name('invitations.show');
    Route::post('/invitations/{token}', [InvetationController::class, 'accepter'])->name('invitations.accepter');

    Route::get('/admin', [ColocationController::class, 'stats'])->name('admin.stats');
    Route::get('/admins', [ColocationController::class, 'stats'])->name('admin.users');
});


require __DIR__ . '/auth.php';
