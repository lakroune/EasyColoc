<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DashboradController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\DetteController;
use App\Http\Controllers\InvetationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboradController::class, 'index'])->name('dashboard');
    Route::get('/', [DashboradController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/colocations', [ColocationController::class, 'index'])->name('colocations.index');
    Route::post('/colocations', [ColocationController::class, 'store'])->name('colocations.store');
    Route::get('/colocations/{colocation}', [ColocationController::class, 'show'])->name('colocations.show');
    Route::delete('/colocations/{colocation}', [ColocationController::class, 'destroy'])->name('colocations.destroy');
    Route::put('/colocations/{colocation}', [ColocationController::class, 'leave'])->name('colocations.leave');
    Route::put('/colocations/{colocation}/change-owner/{newOwner}', [ColocationController::class, 'changeOwner'])->name('colocations.changeOwner');
    Route::delete('/colocations/{colocation}/kick/{membre}', [ColocationController::class, 'kickMember'])->name('colocations.kickMember');

    Route::get('/expenses', [DepenseController::class, 'index'])->name('expenses.index');
    Route::post('/expenses', [DepenseController::class, 'store'])->name('expenses.store');
    Route::delete('/expenses/{expense}', [DepenseController::class, 'destroy'])->name('expenses.destroy');
    Route::put('/dettes/{dette}', [DetteController::class, 'update'])->name('dettes.update');

    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');

    Route::post('/invitations', [InvetationController::class, 'store'])->name('invitations.store');
    Route::get('/invitations/{token}', [InvetationController::class, 'show'])->name('invitations.show');
    Route::post('/invitations/{token}', [InvetationController::class, 'accepter'])->name('invitations.accepter');
    Route::post('/invitation', [InvetationController::class, 'join'])->name('invitations.join');

    Route::get('/admin/stats', [DashboradController::class, 'stats'])->name('admin.stats');
    Route::get('/admin/users', [DashboradController::class, 'user'])->name('admin.users');
    Route::patch('/admin/users/{user}/toggle', [DashboradController::class, 'toggleStatus'])->name('admin.users.toggle-status');
});


require __DIR__ . '/auth.php';
