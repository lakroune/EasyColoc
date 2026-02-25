<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\ProfileController;
use App\Mail\InvitationMail;
use App\Models\Colocation;
use Illuminate\Support\Facades\Mail;
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
});

Route::resource('colocations', ColocationController::class);
Route::resource('expenses', DepenseController::class);
Route::resource('balances', ColocationController::class);
Route::resource('settlements', ColocationController::class);
Route::get('admin', [ColocationController::class, 'stats'])->name('admin.stats');
Route::get('admins', [ColocationController::class, 'stats'])->name('admin.users');

Route::get('/send-invite', function () {
    $colocation = Colocation::find(1);
    Mail::to('fesafi6156@bultoc.com')->send(
        new InvitationMail(
            $colocation
        )
    );

    return 'Email envoyé avec succès';
});
require __DIR__ . '/auth.php';
