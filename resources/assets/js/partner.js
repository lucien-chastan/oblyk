var map, markers, marker_user;

window.addEventListener('load', function () {
    openVoletMyCircle(true);
});

//INITIALISE LA CARTE
function loadPartnerMap() {
    let lat = 46.927527,
        lng = 2.871905,
        zoom = 5,
        dashLocation = location.href,
        splitDash = dashLocation.split('#');

    if(splitDash[1]){
        if(/^[-]?(?:\d*\.)?\d+[/][-]?(?:\d*\.)?\d+[/]\d{1,2}$/.test(splitDash[1])){
            lat = splitDash[1].split('/')[0];
            lng = splitDash[1].split('/')[1];
            zoom = splitDash[1].split('/')[2];
        }
    }

    map = L.map('map',{ zoomControl : false, center:[lat, lng], zoom : zoom, layers: [carte]});
    markers = L.markerClusterGroup({
        showCoverageOnHover:false
    });
    map.addLayer(markers);

    L.control.zoom({position : 'bottomright'}).addTo(map);

    //ajout du controleur de tuile
    L.control.layers(baseMaps).addTo(map);

    //ferme le volet
    map.on('click', function () {
        openVoletProfil(false);
        openVoletMyCircle(false);
    });

    map.on('zoomend', function () {changeDash();});
    map.on('moveend', function () {changeDash();});
}

function changeDash() {
    location.replace('#' + map.getCenter().lat.toPrecision(7) + '/' + map.getCenter().lng.toPrecision(7) + '/' +  map.getZoom());
}

//VA CHERCHER ET AFFCHE LES POINTS SUR LA CARTE
function getPartnerPoints() {
    axios.post('/partner/getPartnerPoints').then(function (response) {

        let users = response.data.users,
            iconUser = [];

        for(let i in users){

            //création d'un icon spécial pour l'utilisateur
            iconUser[users[i].id] = L.divIcon({
                className: 'icon-user-map',
                html : '<img title="' + users[i].name + '" class="circle" src="' + users[i].photo + '"><img class="barre-accroche" src="/img/user-map-accroche-3.svg">',
                iconAnchor : [13,37]
            });

            for(let j in users[i].places){

                //On place l'icon de l'utilisateur
                let point = L.marker(
                    [users[i].places[j].lat,users[i].places[j].lng],
                    {icon : iconUser[users[i].id]}
                ).on('click', ()=>{
                    openProfile(users[i].id);
                });

                markers.addLayer(point);
            }
        }
    });
}

function getMyPlaces() {
    axios.post('/partner/getMyPlaces').then(function (response) {

        let user = response.data.user;

        for(let i in user.places){
            //circle
            L.circle([user.places[i].lat,user.places[i].lng],{
                radius : user.places[i].rayon * 1000,
                fill : false,
                interactive : false,
                color : '#FF5722',
                weight : 2
            }).addTo(map);
        }
    });
}

//FUNCTION D'OUVERTURE DES INFORMATIONS DE LA PERSONNE
function openProfile(user_id) {
    let content = document.getElementById('content-side-map-partner');

    showPartnerLoader(true);

    openVoletProfil(true);
    openVoletMyCircle(false);

    axios.post('/partner/getUserInformation', {user_id : user_id}).then(function (response) {
        content.innerHTML = response.data;
        $('.tooltipped').tooltip({delay: 50});
        showPartnerLoader(false);
    });
}

//OUVRE OU FERME LE VOLET LATÉRAL
function openVoletProfil(open) {
    let volet = document.getElementById('side-user-map-partner');

    if (open){
        volet.style.transform = 'translateX(0)';
    }else{
        volet.style.transform = 'translateX(-100%)';
    }
}

//OUVRE OU FERME LE VOLET LATÉRAL
function openVoletMyCircle(open) {
    let volet = document.getElementById('my-user-circle-partner'),
        scale = document.getElementById('btn-mes-lieux');

    if (open){
        volet.style.transform = 'translateX(0)';
        setTimeout(function () {
            scale.setAttribute('class', scale.className.replace('scale-in', 'scale-out'))
        },400);
    }else{
        volet.style.transform = 'translateX(-100%)';
        setTimeout(function () {
            scale.setAttribute('class', scale.className.replace('scale-out', 'scale-in'))
        },500);
    }
}


//AFFICHE OU CACHE LE LOADER DE PORIFL
function showPartnerLoader(visible) {
    let content = document.getElementById('content-side-map-partner'),
        looder = document.getElementById('load-side-map-partner');

    if (visible) {
        content.style.display = 'none';
        looder.style.display = 'block';
    } else {
        content.style.display = 'block';
        looder.style.display = 'none';
    }
}

//ZOOM SUR UN LIEUX EN PARTICULIER
function zoomOn(lat, lng) {
    let floatLat = parseFloat(lat),
        floatLng = parseFloat(lng);

    map.setView([floatLat,floatLng],15, true);
}