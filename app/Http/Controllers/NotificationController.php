<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()
            ->latest()
            ->paginate(15);

        return view('user.notifications', compact('notifications'));
    }

    public function mark($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->markAsRead();

        return back();
    }

    public function markAllRead()
    {
        Auth::user()->notifications()
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return back()->with('success', 'Semua notifikasi sudah ditandai sebagai terbaca');
    }

    public function delete($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return back()->with('success', 'Notifikasi dihapus');
    }
}
