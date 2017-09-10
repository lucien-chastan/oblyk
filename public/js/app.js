let ajaxSubmited = false;

//initialisation des composants pour materialize
$(".button-collapse").sideNav();
$('.modal').modal(
    {
        endingTop: '10px', // Ending top style attribute
    }
);

//on blanchie la barre de navigation au scroll
let backgroundNav = function () {
    var nav_barre = document.getElementById('nav_barre');

    if(window.pageYOffset > 0){
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    }else{
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-black','nav-white'));
    }
};

//changement de la couleur du fond de la nav bar au scroll
window.addEventListener('scroll', backgroundNav);

//check les messages et notification toutes les 30 secondes
window.addEventListener('load', function () {
   setTimeout(function () {
      setInterval(function () {
          getNewNotificationAndMessage();
      },30000);
   },30000);
});

//INITIALISATION ET STYLE DES DROP DOWN DU MENU
$('.nav-dropdown').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: false, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: true, // Displays dropdown below the button
        alignment: 'left', // Displays dropdown with edge aligned to the left of button
        stopPropagation: false // Stops event propagation
    }
);


//CONVERTIE LES ZONE MARKDOWN EN MARKDOWN
function convertMarkdownZone() {
    let markdown = document.getElementsByClassName('markdownZone');
    for(let i = 0 ; i < markdown.length ; i++){
        if(markdown[i].getAttribute('data-parsed') !== 'true'){
            markdown[i].setAttribute('data-parsed','true');
            markdown[i].innerHTML = marked(markdown[i].innerHTML);
        }
    }
}

//retourne en JS le slug d'une chaine de caractère
function string_to_slug(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    let from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;",
        to   = "aaaaeeeeiiiioooouuuunc------";
    for (let i = 0, l = from.length ; i < l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');

    return str;
}

//Follow un élément
function followedElement(DomElement, followed_type, followed_id, addToast = 'Vous suivez cet élément', deleteToast = 'Vous ne suivez plus cet élément') {
    if(DomElement.getAttribute('data-followed') === 'false'){
        DomElement.setAttribute('data-followed', 'true');
        Materialize.toast(addToast, 4000);
        axios.post('/follows',
            {
                followed_id : followed_id,
                followed_type: 'App\\' + followed_type
            }
        );
    }else{
        DomElement.setAttribute('data-followed', 'false');
        Materialize.toast(deleteToast, 4000);
        axios.post('/follow/delete',
            {
                followed_id : followed_id,
                followed_type: 'App\\' + followed_type
            }
        );
    }
}

//scroll jusqu'au haut de la page
function backToTop() {
    try {
        window.scroll({
            top: 0,
            left: 0,
            behavior: 'smooth'
        });
    }catch (e){
        window.scrollTo(0,0);
    }
}

//regarde les nouveaux messages
function getNewNotificationAndMessage() {
    let nbMessage = document.getElementById('badge-nb-new-message'),
        nbNotification = document.getElementById('badge-nb-new-notification'),
        nbPost = document.getElementById('badge-nb-new-posts'),
        global = document.getElementById('global-badge-notification-message'),
        badgeUserMessage = document.getElementById('badge-message-user-profile'),
        badgeUserPost = document.getElementById('badge-post-user-profile'),
        badgeUserNotification = document.getElementById('badge-notification-user-profile');

    axios.post('/new/notifications-and-messages').then(function (response) {
        let data = response.data;

        nbMessage.textContent = data.messages !== 0 ? data.messages : '';
        nbNotification.textContent = data.notifications !== 0 ? data.notifications : '';
        nbPost.textContent = data.posts !== 0 ? data.posts : '';
        global.textContent = data.messages + data.notifications + data.posts;

        //enleve l'ancienne notification du title de la page
        document.title = document.title.replace(/^(\([0-9]+\))\s/,'');

        //cache ou affiche le badge des messages et notification
        if (data.messages + data.notifications + data.posts === 0) {
            global.style.display = 'none';
        } else {
            global.style.display = 'inline-block';

            //inscrit le nombre de notification dans le haut de la page
            document.title = '(' + (parseInt(data.messages) + parseInt(data.notifications) + parseInt(data.posts))  + ') ' +  document.title
        }

        //affichage du nombre de message dans la partie profil
        try{
            badgeUserMessage.textContent = data.messages !== 0 ? data.messages : '';
            badgeUserNotification.textContent = data.notifications !== 0 ? data.notifications : '';
            badgeUserPost.textContent = data.posts !== 0 ? data.posts : '';
        }catch (e){}

    });
}

function newMessage(user_id, btn) {

    btn.style.display = 'none';

    axios.post('/message/new',{user_id : user_id}).then(function (response) {
        location.href = response.data.url + "#messages";
    });
}

windowWidth = function (){
    if(window.innerWidth)
        return window.innerWidth;
    else if (document.documentElement.clientWidth)
        return document.documentElement.clientWidth;
    else if(document.body.clientWidth)
        return document.body.clientWidth;
    else
        return -1;
};

function showMeAResponse(response) {
    console.log(response)
}

//CALCUL DE DISTANCE ENTRE DEUX POINTS
function getGpsRange(lat_1, long_1, lat_2, long_2){
    r_lat1 = lat_1 * (Math.PI / 180);
    r_lat2 = lat_2 * (Math.PI / 180);
    r_long1 = long_1 * (Math.PI / 180);
    r_long2 = long_2 * (Math.PI / 180);
    return (Math.acos(Math.sin(r_lat1) * Math.sin(r_lat2) + Math.cos(r_lat1) * Math.cos(r_lat2) * Math.cos(r_long1 - r_long2)) * 6371 );
}