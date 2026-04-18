<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\DonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Models\Don;
use App\Models\Notification;
use App\Models\HistoriqueAction;
use App\Models\User;

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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('campagnes', CampagneController::class);

    Route::get('/dons', function () {
        $dons = Don::latest()->get();
        return view('dons.index', compact('dons'));
    })->name('dons.index');

    Route::get('/dons/create', function () {
        $campagnes = \App\Models\Campagne::latest()->get();
        return view('dons.create', compact('campagnes'));
    })->name('dons.create');

    Route::post('/dons', [DonController::class, 'store'])->name('dons.store');

    Route::post('/dons/{id}/accepter', [DonController::class, 'accepter'])->name('dons.accepter');
    Route::post('/dons/{id}/refuser', [DonController::class, 'refuser'])->name('dons.refuser');
    Route::post('/dons/{id}/distribuer', [DonController::class, 'distribuer'])->name('dons.distribuer');

    Route::get('/notifications', function () {
        $notifications = Notification::where('user_id', auth()->id())->latest()->get();
        return view('notifications.index', compact('notifications'));
    })->name('notifications.index');

    Route::get('/historique', function () {
        $historiques = HistoriqueAction::latest()->get();
        return view('historique.index', compact('historiques'));
    })->name('historique.index');

    Route::get('/admin', function () {
        $usersCount = User::count();
        $campaignsCount = \App\Models\Campagne::count();
        $donsCount = Don::count();
        return view('admin.index', compact('usersCount', 'campaignsCount', 'donsCount'));
    })->name('admin.index');

    Route::get('/admin/users', function () {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    })->name('admin.users');

});

require __DIR__ . '/auth.php';
