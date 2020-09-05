function markAsRead(notificationId) {
    $.ajax({
        type: "PUT",
        url: `/notifications/${notificationId}`,
        success: (response) => {
            if (response.marked) {
                $(`#notification-${notificationId}`).remove();

                getUnreadNotificationNumber();
            }
        },
        error: (error) => {
            console.error(error);
        },
    });
}

function getUnreadNotificationNumber() {
    $.ajax({
        type: "GET",
        url: "/notifications/unread-number",
        success: (response) => {
            if (response.notificationNumber === 0) {
                $("#notification-badge").remove();
            } else {
                $("#notification-badge").html(response.notificationNumber);
            }
        },
        error: (error) => {
            console.error(error);
        },
    });
}


function markAllAsRead() {
    $.ajax({
        type: 'PUT',
        url: `/notifications/mark-all-as-read`,
        success: response => {
            $('#notification-panel').html('');
        },
        error: error => console.error(error)
    });
}
