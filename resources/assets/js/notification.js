function notificationsAsRead(notification_id, element) {

    let read = (element.textContent === 'visibility')? 1 : 0;

    axios.post('/notification/read',{ id : notification_id, read : read}).then(function (response) {
        if(read === 1) {
            element.textContent = 'visibility_off';
            element.setAttribute('data-tooltip','Marquer comme non vu');
            Materialize.toast('Notification marquée comme lu', 4000)
        }else{
            element.textContent = 'visibility';
            element.setAttribute('data-tooltip','Marquer comme vu');
            Materialize.toast('Notification marquée comme non-lu', 4000)
        }

        $('.tooltipped').tooltip({delay: 50});

        getNewNotificationAndMessage();

    });
}