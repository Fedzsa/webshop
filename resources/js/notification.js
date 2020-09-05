function markAsRead(notificationId) {
    $.ajax({
        type: "PUT",
        url: `/notifications/${notificationId}`,
        success: (response) => {
            $(`#notification-${notificationId}`).remove();

            refreshNotificationBadge(response.notificationNumber);

            refreshNotificationInfo(response.notificationInfo);
        },
        error: (error) => {
            console.error(error);
        },
    });
}

function refreshNotificationBadge(notificationNumber) {
    if (notificationNumber === 0) {
        $("#notification-badge").remove();
    } else {
        $("#notification-badge").html(notificationNumber);
    }
}

function refreshNotificationInfo(text) {
    $("#notification-info-card .row .col:first-child").html(text);
}

function markAllAsRead() {
    $.ajax({
        type: "PUT",
        url: `/notifications/mark-all-as-read`,
        success: (response) => {
            $("#notification-panel").html("");

            refreshNotificationBadge(response.notificationNumber);

            refreshNotificationInfo(response.notificationInfo);
        },
        error: (error) => console.error(error),
    });
}
