<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\DonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-notifications', [UserController::class, 'myNotifications']);
    Route::get('/notifications', [UserController::class, 'notificationsIndex'])->name('notifications.index');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/historique', [DashboardController::class, 'historique'])->name('historique.index');
    Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.index');
    Route::get('/admin/users', [DashboardController::class, 'adminUsers'])->name('admin.users');

    Route::resource('campagnes', CampagneController::class);

    Route::get('/dons', [DonController::class, 'index'])->name('dons.index');
    Route::get('/dons/create', [DonController::class, 'create'])->name('dons.create');
    Route::post('/dons', [DonController::class, 'store'])->name('dons.store');

    Route::post('/dons/{id}/accepter', [DonController::class, 'accepter'])->name('dons.accepter');
    Route::post('/dons/{id}/refuser', [DonController::class, 'refuser'])->name('dons.refuser');
    Route::post('/dons/{id}/distribuer', [DonController::class, 'distribuer'])->name('dons.distribuer');

});

require __DIR__ . '/auth.php';
