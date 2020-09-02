$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

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
