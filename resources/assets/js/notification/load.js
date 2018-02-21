var notifications = [];

const NOTIFICATION_TYPES = {
    UserNotification: 'App\\Notifications\\UsersNotifications\\SendUserNotification'
};


$(document).ready(function() {
	// check if there's a logged in user
    if(window.userId) {
        $.get('/notifications', function (data) {
            addNotifications(data, "#notifications");
        });
    }
});

function addNotifications(newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    // show only last 5 notifications
    notifications.slice(0, 5);
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    if(notifications.length) {
        var htmlElements = notifications.map(function (notification) {
        return makeNotification(notification);

        });
        $(target + 'Menu').html(htmlElements.join(''));
        $(target).addClass('has-notifications')
    } else {
        $(target + 'Menu').html('<li class="dropdown-header">No notifications</li>');
        $(target).removeClass('has-notifications');
    }
}
// Make a single notification string
function makeNotification(notification) {
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);
    return '<li><a href="' + to + '">' + notificationText + '</a></li>';
}
// get the notification text based on it's type
function makeNotificationText(notification) {
    var text = '';
                	console.log(notification)

    if(notification.type === NOTIFICATION_TYPES.UserNotification) {
    	console.log(notification)
        const name = notification.data.data.id;
        text += '<strong>'+ name + '</strong> followed you';
    }
    return text;
}
// get the notification route based on it's type
function routeNotification(notification) {
    var to = '?read=' + notification.id;
    if(notification.type === NOTIFICATION_TYPES.UserNotification) {
        to = to;
    }
    return '/' + to;
}