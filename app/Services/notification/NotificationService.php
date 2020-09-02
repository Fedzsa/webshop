<?php

namespace App\Services\Notification;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationService implements NotificationServiceInterface
{
    /**
     * Get the authenticated user's unread notifications.
     *
     * @return Notification
     */
    public function getUnreadNotificationsForUser()
    {
        return Auth::user()->unreadNotifications;
    }

    /**
     * Count the unread notifications.
     *
     * @return int
     */
    public function countUnreadNotificationsForUser()
    {
        $userId = Auth::user()->id;

        return DB::table('notifications')
            ->where('notifiable_id', $userId)
            ->whereNull('read_at')
            ->count();
    }

    /**
     * Mark the unread notification.
     *
     * @param string $id - notification id
     * @return bool
     */
    public function markAsRead(string $id)
    {
        return DB::table('notifications')
            ->where('id', $id)
            ->update(['read_at' => now()]);
    }
}
