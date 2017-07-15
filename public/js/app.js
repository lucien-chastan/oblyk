var sMDE,
    ajaxSubmited = false;

//initialisation des composants pour materialize
$(".button-collapse").sideNav();
$('.modal').modal(
    {
        endingTop: '10px', // Ending top style attribute
    }
);

//on blanchie la barre de navigation au scroll
var backgroundNav = function () {
    let nav_barre = document.getElementById('nav_barre');

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
function followedElement(DomElement, followed_type, followed_id) {
    if(DomElement.getAttribute('data-followed') === 'false'){
        DomElement.setAttribute('data-followed', 'true');
        Materialize.toast('Vous suivez cet élément', 4000);
        axios.post('/follows',
            {
                followed_id : followed_id,
                followed_type: 'App\\' + followed_type
            }
        );
    }else{
        DomElement.setAttribute('data-followed', 'false');
        Materialize.toast('Vous ne suivez plus cet élément', 4000);
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
    window.scroll({
        top: 0,
        left: 0,
        behavior: 'smooth'
    });
}

//regarde les nouveaux messages
function getNewNotificationAndMessage() {
    let nbMessage = document.getElementById('badge-nb-new-message'),
        global = document.getElementById('global-badge-notification-message'),
        badgeUserMessage = document.getElementById('badge-message-user-profile');

    axios.post('/new/notifications-and-messages').then(function (response) {
        let data = response.data;

        nbMessage.textContent = data.messages !== 0 ? data.messages : '';
        global.textContent = data.messages + data.notifications;

        //cache ou affiche le badge des messages et notification
        global.style.display = data.messages + data.notifications === 0 ? 'none' : 'inline-block';

        //affichage du nombre de message dans la partie profil
        try{
            badgeUserMessage.textContent = data.messages !== 0 ? data.messages : '';
        }catch (e){}

    });
}