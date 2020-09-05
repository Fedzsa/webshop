<?php

namespace App\Http\Controllers;

use App\Services\Notification\NotificationServiceInterface;
use Illuminate\Support\Facades\Lang;

class NotificationController extends Controller
{
    private NotificationServiceInterface $notificationService;

    public function __construct(
        NotificationServiceInterface $notificationService
    ) {
        $this->notificationService = $notificationService;
    }

    /**
     * Mark as read the notification.
     */
    public function update(string $id)
    {
        $this->notificationService->markAsRead($id);

        return response()->json(
            [
                'notificationNumber' => countUnreadNotificationsForAuthUser(),
                'notificationInfo' => Lang::get('messages.notification-info', [
                    'value' => countUnreadNotificationsForAuthUser(),
                ]),
            ],
            200
        );
    }

    /**
     * Mark all notification as read.
     */
    public function markAllAsRead()
    {
        $this->notificationService->markAllAsRead();

        return response()->json(
            [
                'notificationNumber' => countUnreadNotificationsForAuthUser(),
                'notificationInfo' => Lang::get('messages.notification-info', [
                    'value' => countUnreadNotificationsForAuthUser(),
                ]),
            ],
            200
        );
    }
}
