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
            $(`#notification-${notificationId}`).remove();

            getUnreadNotificationNumber();

            refreshNotificationInfo(response.notificationInfo);
        },
        error: (error) => {
            console.error(error);
        },
    });
}

function getUnreadNotificationNumber() {
    $.ajax({
        type: "GET",
        url: "/notifications/unread-notification-number",
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


function refreshNotificationInfo(text) {
    $('#notification-info-card .row .col:first-child').html(text);
}

function markAllAsRead() {
    $.ajax({
        type: 'PUT',
        url: `/notifications/mark-all-as-read`,
        success: response => {
            $('#notification-panel').html('');

            getUnreadNotificationNumber();

            refreshNotificationInfo(response.notificationInfo);
        },
        error: error => console.error(error)
    });
}
