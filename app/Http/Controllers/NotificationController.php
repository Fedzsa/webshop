<?php

namespace App\Http\Controllers;

use App\Services\Notification\NotificationServiceInterface;

class NotificationController extends Controller {
    private NotificationServiceInterface $notificationService;

    public function __construct(NotificationServiceInterface $notificationService) {
        $this->notificationService = $notificationService;
    }

    public function unreadNumber() {
        return response()->json(['notificationNumber' => countUnreadNotificationsForAuthUser()]);
    }

    public function update(string $id) {
        $this->notificationService->markAsRead($id);

        return response()->json(['marked' => true]);
    }
}