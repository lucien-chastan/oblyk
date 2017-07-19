let chargedBox = 0,
    nbBox = 0;

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
        let targetBoxs = document.getElementsByClassName('target-box'),
            flexDashBoxs = document.getElementById('flexDashBoxs'),
            somme = 0;

        for(let i = 0 ; i < targetBoxs.length ; i++){
            console.log(targetBoxs[i].offsetHeight);
            somme += targetBoxs[i].offsetHeight + 200;
        }

        flexDashBoxs.style.height = (somme / 2) + 'px';
    },100);
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

        new Phototheque('#albumPhototheque',
            {
                "maxHeight" : "150px","gouttiere" : "3px",
                "lastRow" : "center",
                "visiotheque" : true,
                "visiotheque-option" : {
                    "legende" : "data-legende"
                }
            }
        );
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
            console.log(err.message);
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
            console.log(err.message);
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