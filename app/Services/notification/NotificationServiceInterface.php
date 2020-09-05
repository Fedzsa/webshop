<?php

namespace App\Services\Notification;

interface NotificationServiceInterface
{
    function getUnreadNotificationsForUser();
    function countUnreadNotificationsForUser();
    function markAsRead(string $id);
    function markAllAsRead();
}
