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
    showSubmitLoader(false);
}

//INDICATION QUE LE COMPTE À ÉTÉ MIS À JOUR
function majSettingsCompte() {
    Materialize.toast('Votre compte a été mis à jour', 4000);
    showSubmitLoader(false);
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
