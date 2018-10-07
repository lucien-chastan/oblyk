let chargedBox = 0,
    nbBox = 0,
    parnterSettingMap = null;

//AJOUT UN ÉVÉNEMENT AU ONRESEIZE POUR REDIMENSIONNER LE DASHBOAD
window.addEventListener('resize', function () {
    let flexDashBoxs = document.getElementById('flexDashBoxs');
    if (flexDashBoxs !== null){
        dimDashboard();
    }
});

//CHANGE L'INDICATEUR DU MENU ACTIF
function activeMenu(element) {
    let navHeadItem = document.getElementsByClassName('collapsible-header'),
        navBodyItem = document.querySelectorAll('.collapsible-body .row');

    for(let i = 0 ; i < navHeadItem.length ; i++) navHeadItem[i].setAttribute('class', navHeadItem[i].className.replace('active-item', ''))
    for(let i = 0 ; i < navBodyItem.length ; i++) navBodyItem[i].setAttribute('class', navBodyItem[i].className.replace('active-item', ''))

    element.setAttribute('class', element.className + ' active-item');
}


//CHARGE LES BOXS DU DASHBOARD
function loadDashBoxs() {
    let targetBoxs = document.getElementsByClassName('target-box'),
        refreshTargetBox = document.getElementsByClassName('refresh-target-box'),
        flexDashBoxs = document.getElementById('flexDashBoxs');

    flexDashBoxs.style.height = 'auto';
    chargedBox = 0;
    nbBox = targetBoxs.length;

    for(let i = 0 ; i < targetBoxs.length ; i++){
        let route = targetBoxs[i].getAttribute('data-sub-route');
        loadBox(route,targetBoxs[i]);
        refreshTargetBox[i].addEventListener('click', ()=> {refreshBox(route, targetBoxs[i]);});
    }
}


//CHARGE UNE BOX
function loadBox(target, element) {
    axios.get(target).then(function (response) {
        chargedBox++;
        element.innerHTML = response.data;
        element.style.height = 'auto';
        if(nbBox === chargedBox) dimDashboard();
    });
}


//RAFRAICHI UNE BOX
function refreshBox(route, element) {
    element.style.height = element.offsetHeight + 'px';
    element.innerHTML = '<div class="text-center"><div class="preloader-wrapper small active"> <div class="spinner-layer spinner-blue-only"> <div class="circle-clipper left"><div class="circle"></div> </div><div class="gap-patch"><div class="circle"></div> </div><div class="circle-clipper right"> <div class="circle"></div></div></div></div></div>';
    setTimeout(function () {loadBox(route,element);},300);
}


//FONCTION DE CALCUL DE LA HAUTEUR DU DASHBOARD
function dimDashboard() {
    setTimeout(function () {

        let largeur_ecran = windowWidth(),
            flexDashBoxs = document.getElementById('flexDashBoxs');

        if(largeur_ecran > 1000){

            let targetBoxs = document.getElementsByClassName('dashbox'),
                somme = 0,
                additionnel = 20,
                newSomme = 0,
                goodHeight = 0,
                trouver = false;

            //Calcul de la somme des hauteurs des boites
            for(let i = 0 ; i < targetBoxs.length ; i++) somme += targetBoxs[i].offsetHeight + additionnel;

            //On parcours les boîtes et on s'arrête quand la somme des hauteurs des boîtes et supérieurs à la moitité de la hauteur total
            for(let i = 0 ; i < targetBoxs.length ; i++){
                newSomme += targetBoxs[i].offsetHeight + additionnel;
                if(newSomme > somme / 2 && trouver === false) {
                    goodHeight = newSomme;
                    trouver = true;
                }
            }

            //on attribut la hauteur à la zone des boites
            flexDashBoxs.style.height = (goodHeight + 50) + 'px';

        }else{

            //si la largeur d'écran est en dessous de 1000px on passe en hauteur auto (une seul colonne)
            flexDashBoxs.style.height = 'auto';

        }
    },500);
}

//INDICATION QUE LE DASHBOARD À ÉTÉ MIS À JOUR
function majSettingsDashboard() {
    Materialize.toast('Les paramètres du dashboard ont été mis à jour', 4000);
    showSubmitLoader(false, document.getElementById('form-dashboard-setting'));
}

//INDICATION QUE LE COMPTE À ÉTÉ MIS À JOUR
function majSettingsCompte() {
    Materialize.toast('Votre compte a été mis à jour', 4000);
    showSubmitLoader(false, document.getElementById('form-compte-setting'));
}

//INDICATION QUE L'EMAIL À ÉTÉ MIS À JOUR
function majSettingsEmail() {
    Materialize.toast('Vos options de connexion ont étées mise à jour', 4000);
    showSubmitLoader(false, document.getElementById('form-password-setting'));
}

//INDICATION QUE LES OPTIONS DE MESSAGERIE À ÉTÉ MIS À JOUR
function majSettingsMessagerie() {
    Materialize.toast('Vos options de messagerie ont étées mis à jour', 4000);
    showSubmitLoader(false, document.getElementById('form-messagerie-setting'));
}

//INDICATION QUE LES OPTIONS DE CONFIDENTIALITÉ ONT ÉTÉES MIS À JOUR
function majSettingsConfidentialite() {
    Materialize.toast('Vos options de confidentialités ont étées mis à jour', 4000);
    showSubmitLoader(false, document.getElementById('form-confidentialite-setting'));
}




//OUVRE UN PROFIL
function openAlbum(route) {
    let target = document.getElementById('user-content');
    axios.get(route).then(function (response) {
        target.innerHTML = response.data;
    });
}

function showChangeMdp() {
    let zoneMdp = document.getElementById('zone-change-mdp');

    if(zoneMdp.getAttribute('data-visible') === 'true'){
        zoneMdp.setAttribute('data-visible', 'false');
        zoneMdp.style.display = 'none';
    }else{
        zoneMdp.setAttribute('data-visible', 'true');
        zoneMdp.style.display = 'block';
    }
}

function uploadBandeau() {
    let form = document.getElementById('form-upload-photo-bandeau-setting'),
        inputData = form.getElementsByClassName('input-data'),
        data = new FormData();

    data.append('foo', 'bar');
    data.append('bandeau', document.getElementById('upload-photo-bandeau').files[0]);

    //ajout les autres données à passage de la form
    for(let i in inputData){
        if(typeof inputData[i].value !== "undefined") data.append([inputData[i].name], inputData[i].value);
    }

    let config = {
        onUploadProgress: function(progressEvent) {
            let percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
            document.getElementById('progressbar-upload-photo-bandeau').style.width = percentCompleted + '%';
        }
    };

    axios.post('/upload/userBandeau', data, config).then(
        function (response) {
            reloadCurrentVue();
        }
    ).catch(
        function (err) {

            if(err.response.status === 422){

                //table des erreurs
                let errorArray = [];

                // on boucle sur les erreurs renvoyées
                for(let key in err.response.data){

                    //on ajout au tableau l'erreur courante
                    errorArray.push(err.response.data[key]);

                }

                //compil les erreurs
                let textError = errorArray.join('<br>');

                //on affiche les erreurs
                alert(textError);
            }else{
                alert('Erreur ' + err.response.status);
            }

            document.getElementById('progressbar-upload-photo-bandeau').style.width = '0%';
        }
    );
}


function uploadImageProfile() {
    let form = document.getElementById('form-upload-photo-profil-setting'),
        inputData = form.getElementsByClassName('input-data'),
        data = new FormData();

    data.append('foo', 'bar');
    data.append('photo', document.getElementById('upload-photo-profil').files[0]);

    //ajout les autres données à passage de la form
    for(let i in inputData){
        if(typeof inputData[i].value !== "undefined") data.append([inputData[i].name], inputData[i].value);
    }

    let config = {
        onUploadProgress: function(progressEvent) {
            let percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
            document.getElementById('progressbar-upload-photo-profil').style.width = percentCompleted + '%';
        }
    };

    axios.post('/upload/userPhotoProfile', data, config).then(
        function (response) {
            reloadCurrentVue();
        }
    ).catch(
        function (err) {
            if(err.response.status === 422){

                //table des erreurs
                let errorArray = [];

                // on boucle sur les erreurs renvoyées
                for(let key in err.response.data){

                    //on ajout au tableau l'erreur courante
                    errorArray.push(err.response.data[key]);

                }

                //compil les erreurs
                let textError = errorArray.join('<br>');

                //on affiche les erreurs
                alert(textError);
            }else{
                alert('Erreur ' + err.response.status);
            }

            document.getElementById('progressbar-upload-photo-profil').style.width = '0%';
        }
    );
}

//Vue d'un post
function vuePost(post_id) {
    let innerTarget = document.getElementById('user-content'),
        itemNav = document.getElementById('item-fil-actu-menu');

    showUserLoader(true);

    axios.post('/post/vueOnePost', {id:post_id}).then(function (response) {

        //ecrit les données
        innerTarget.innerHTML = response.data;

        location.href = '#fil-actu';

        //faite des actions poste chargement
        afterLoad();

        currentVue = itemNav;

        activeMenu(itemNav);

        //cache le loader
        showUserLoader(false);
    });

}

function getMyActuality(){
    getPosts(
        'User',
        document.getElementById('id-user-actualite').value,
        document.getElementById('insert-posts-zone'),
        '/user/actuality'
    );
}

function vueTopic(topic_id) {
    location.href = '/forum-escalade/' + topic_id +  '/sujet';
}

function vueProfile(profil_id) {
    location.href = '/grimpeur/' + profil_id +  '/profil';
}

function changeRelation(user_id, relation_status) {
    axios.post('/user/relation', {user_id : user_id , relation_status : relation_status}).then(function () {

        //affiche un message
        if(relation_status === 0) Materialize.toast('Demande envoyée !', 4000);
        if(relation_status === 1) Materialize.toast('Demande annulée', 4000);
        if(relation_status === 2) Materialize.toast('Vous êtes désormais amis', 4000);
        if(relation_status === 3) Materialize.toast('Vous n\'êtes plus amis', 4000);

        //reload la vue
        reloadCurrentVue();

    });
}

function activePartner(active = true) {
    axios.post('/partner/active',{active : active}).then(function (response) {
        Materialize.toast(response.data, 4000);
        reloadCurrentVue();
    })
}

function activeLieu(switchbox) {

    let active = switchbox.checked === true,
        place_id = switchbox.value;

    axios.post('/partner/place/active',{active : active, place_id : place_id}).then(function (response) {
        Materialize.toast(response.data, 4000);
        initPartnerSettingMap();
    });
}

function initPartnerSettingMap() {

    setTimeout(function () {
        let latLngPolyline = [];

        if(parnterSettingMap !== null){
            parnterSettingMap.remove();
            parnterSettingMap = null;
        }

        parnterSettingMap = L.map('placeSettingMap',{ zoomControl : true, center:[46.5, 4.5], zoom : 5, layers: [carte]});

        //ajout du controleur de tuile
        L.control.layers(baseMaps).addTo(parnterSettingMap);

        axios.post('/partner/setting-map').then(function (response) {
            let places = response.data[0];

            //ajoute les markeurs à la carte
            for(let i in places){

                //circle
                L.circle([places[i].lat,places[i].lng],{
                    radius : places[i].rayon * 1000,
                    fill : false,
                    color : '#2196F3'
                }).addTo(parnterSettingMap);

                //polyline de centrage
                latLngPolyline.push([places[i].lat, places[i].lng])
            }

            let polyline = L.polyline(latLngPolyline, {color: 'rgba(255,255,255,0'}).addTo(parnterSettingMap);

            // zoom the map to the polyline
            parnterSettingMap.fitBounds(polyline.getBounds());

            //on supprime la polyline de zoom
            polyline.remove();

        });
    },500);
}

function majPartnerSettings(response) {
    location.href = '/partenaire-escalade/carte-des-grimpeurs';
}