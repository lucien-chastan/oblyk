function notificationsAsRead(notification_id) {

    let iconNotification = document.getElementById('icon-notification-' + notification_id),
        read = (iconNotification.textContent === 'visibility')? 1 : 0,
        divNotification = document.getElementById('div-notification-' + notification_id);

    axios.post('/notification/read',{ id : notification_id, read : read}).then(function (response) {
        if(read === 1) {
            divNotification.setAttribute('class', divNotification.className.replace(' new-notification', ''));
            iconNotification.textContent = 'visibility_off';
            iconNotification.setAttribute('data-tooltip','Marquer comme non vu');
            Materialize.toast('Notification marquée comme lu', 4000)
        }else{
            divNotification.setAttribute('class', divNotification.className + ' new-notification');
            iconNotification.textContent = 'visibility';
            iconNotification.setAttribute('data-tooltip','Marquer comme vu');
            Materialize.toast('Notification marquée comme non-lu', 4000)
        }

        $('.tooltipped').tooltip({delay: 50});

        getNewNotificationAndMessage();

    });
}

//Note le nombre de notification vu et recharge la page
function reloadNotificationAfterDelete(){
    getNewNotificationAndMessage();
    reloadCurrentVue();
}

function notificationAction(notification_id) {
    let iconNotification = document.getElementById('icon-notification-' + notification_id),
        read = (iconNotification.textContent === 'visibility')? 1 : 0;
    if(read === 1) {
        notificationsAsRead(notification_id);
    }
}