<?php

namespace App\Services\Notification;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationService implements NotificationServiceInterface {

    public function getUnreadNotificationsForUser() {
        return Auth::user()->unreadNotifications;
    }

    public function countUnreadNotificationsForUser() {
        $userId = Auth::user()->id;

        return DB::table('notifications')->where('notifiable_id', $userId)->whereNull('read_at')->count();
    }

    public function markAsRead(string $id) {
        return DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);
    }
}