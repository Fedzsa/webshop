<?php

namespace App\Http\Controllers;

use App\Services\Notification\NotificationServiceInterface;

class NotificationController extends Controller
{
    private NotificationServiceInterface $notificationService;

    public function __construct(
        NotificationServiceInterface $notificationService
    ) {
        $this->notificationService = $notificationService;
    }

    /**
     * Get unread notification number.
     */
    public function unreadNumber()
    {
        return response()->json(
            ['notificationNumber' => countUnreadNotificationsForAuthUser()],
            200
        );
    }

    /**
     * Mark as read the notification.
     */
    public function update(string $id)
    {
        $this->notificationService->markAsRead($id);

        return response()->json(['marked' => true], 200);
    }

    /**
     * Mark all notification as read.
     */
    public function markAllAsRead()
    {
        $this->notificationService->markAllAsRead();

        return response()->ok(null, 200);
    }
}
