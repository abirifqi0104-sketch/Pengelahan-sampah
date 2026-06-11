<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

// NOTE: dipisah agar tidak bentrok, tapi cukup dimuat di RouteServiceProvider (atau di web.php)

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::prefix('notifications')->group(function () {
        // route name HARUS cocok dengan sidebar: route('user.notifications')
        Route::get('/', [NotificationController::class, 'index'])->name('notifications');
        Route::post('/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
        Route::post('/{id}/read', [NotificationController::class, 'mark'])->name('notifications.read');
        Route::delete('/{id}', [NotificationController::class, 'delete'])->name('notifications.delete');
    });
});

