<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    Route::prefix('notifications')->name('user.notifications.')->group(function () {
        // name wajib: user.notifications (sidebar memanggil route('user.notifications'))
        Route::get('/', [NotificationController::class, 'index'])->name('notifications');
        Route::post('/mark-all-read', [NotificationController::class, 'markAllRead'])->name('markAllRead');
        Route::post('/{id}/read', [NotificationController::class, 'mark'])->name('read');
        Route::delete('/{id}', [NotificationController::class, 'delete'])->name('delete');
    });
});

