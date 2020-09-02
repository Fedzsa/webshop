<?php

use App\Services\Notification\NotificationService;

function countUnreadNotificationsForAuthUser()
{
    $notificationService = new NotificationService();

    return $notificationService->countUnreadNotificationsForUser();
}

function formatStringToDateTime(
    string $datetime,
    string $format = 'Y.m.d H:i:s'
) {
    $date_time = new DateTime($datetime);

    return $date_time->format($format);
}
