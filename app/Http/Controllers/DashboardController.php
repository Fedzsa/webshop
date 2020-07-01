<?php

namespace App\Http\Controllers;

use App\Services\Notification\NotificationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private NotificationServiceInterface $notificationService;

    public function __construct(NotificationServiceInterface $notificationService)
    {
        $this->notificationService = $notificationService;

        $this->middleware('auth');
    }

    /**
     * Display unread notifications.
     */
    public function __invoke() {
        $notifications = $this->notificationService->getUnreadNotificationsForUser();

        return view('dashboard.index', compact('notifications'));
    }
}
