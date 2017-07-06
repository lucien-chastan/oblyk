var inputMap,
    markerInputMap;


//FONCTION D'OUVERUTRE DES MODALES PERMETTANTS L'ÉDITION DU CONTENUE DES TABLES
function openModal(route, data) {

    let loadModal = document.getElementById('load-modal'),
        contentModal = document.getElementById('modal-content');

    //on montre le loader et cache le contenu
    loadModal.style.display = 'block';
    contentModal.style.display = 'none';

    //on change les ' par des " pour pouvoir parser en JSON
    if(typeof data != 'object') data = JSON.parse(data.replace(/[']/g,'"'));

    //requête ajax
    axios.post(route, data).then(function (response) {

        contentModal.innerHTML = response.data;

        //lie des actions particulière à la modal
        specialAction(data);

        //on cache le loader et on montre le contenu
        loadModal.style.display = 'none';
        contentModal.style.display = 'block';

        //on donne le focus au premier input
        document.getElementsByClassName('input-data')[0].focus();

    });
}

//FUNCTION D'AJOUT D'ACTION SPÉCIAL
function specialAction(data) {

    //si nous avons un input du type lien de la page courante
    let inputCurrentPage = document.getElementById('inputCurrentPage');
    try {inputCurrentPage.value = location.href;}catch (e){}

    //resize les textarea
    $('.md-textarea').trigger('autoresize');

    //init les selects
    $('select').material_select();

    //color les branches de la boussole dans l'input orientation
    colorOrientation();

    //color les icônes de saison
    colorSaison();

    //optimise l'affichage de la popup route
    try {
        optimisePopupRoute();
        dupliqueLongueurLine();
        document.getElementById('type_cotation_longeur').addEventListener('change', optimisePopupRoute);
        document.getElementById('nb_longueur').addEventListener('change', setJsonLongueur);
        document.getElementById('nb_longueur').addEventListener('change', dupliqueLongueurLine);
        document.getElementById('popup_line_name').addEventListener('keyup', getSimilarRoute);
    }catch (e){}

    //créer la map de localisation (s'il y en a une)
    setTimeout(function () {
        try {creatInputMap();}catch (e){}
    },500);

    if(data['MapReverseGeoCoding'] === true){
        MapReverseGeoCoding();
    }
}

//AU CHARGEMENT DE LA PAGE, ON ACCROCHE LES ÉVÉNEMENTS OPEN MODAL SUR LES BTNMODAL
window.addEventListener('load', function () {
    initOpenModal();
});


//ACCROCHE LES ÉVÉNEMENTS ONCLICK POUR L'OUVERTURE DES MODALES
function initOpenModal() {
    let btnModal = document.getElementsByClassName('btnModal');

    for(let i = 0 ; i < btnModal.length ; i++){

        //si l'événement openModal n'a pas déjà été ajouté
        if(btnModal[i].getAttribute('data-parsed') !== 'true'){
            let route = btnModal[i].getAttribute('data-route'),
                data = btnModal[i].getAttribute('data-modal');

            //on ajoute l'événement openModal à l'élément
            btnModal[i].addEventListener('click', function() {openModal(route, data);});

            //on note que l'événement openModal a été ajouté
            btnModal[i].setAttribute('data-parsed', 'true');
        }
    }
}


//CETTE FONCTION GÉRE LE SUBMIT DES DONNÉES EN AJAX
function submitData(form, callback) {
    let inputData = form.getElementsByClassName('input-data'),
        method = document.getElementById('_method').value,
        route = form.getAttribute('data-route'),
        errorPopupText = document.getElementById('errorPopupText'),
        data = {};

    //Si nous ne somme pas déjà entrain de soumettre un formulaire
    if(!ajaxSubmited){

        ajaxSubmited = true;
        showSubmitLoader(true);

        //on cache le message d'erreur
        errorPopupText.style.display = 'none';

        //on affiche un loader à la place du bouton submit

        //créer un talbeau JSON des données à passer en paramètre
        for(let i in inputData){
            if(typeof inputData[i].value != "undefined") data[inputData[i].name] = inputData[i].value;
        }

        //lance la fonction ajax
        axios(
            {
                method : method,
                url : route,
                data : data
            }
        ).then(function (response) {

            //on renseigne comme quoi nous ne somme plus entrain de soumettre un forumlaire
            ajaxSubmited = false;

            //appel du callback avec les datas de réponse
            callback(response);

        }).catch(function (error) {

            //on renseigne comme quoi nous ne somme plus entrain de soumettre un forumlaire
            ajaxSubmited = false;
            showSubmitLoader(false);

            //table des erreurs
            let errorArray = [];

            //on boucle sur les erreurs renvoyées
            for(let detailError in error.response.data){

                //on ajout au tableau l'erreur courante
                errorArray.push(error.response.data[detailError]);

                //on ajoute la class invalid au champs qui ne sont pas bon
                let errorInput = document.querySelector('.submit-form #description');
                errorInput.setAttribute('class', errorInput.className + ' invalid');
            }

            //compil les erreurs
            let textError = errorArray.join('<br>');

            //on affiche les erreurs
            errorPopupText.style.display = 'block';
            errorPopupText.innerHTML = textError;

        });
    }
}

//MONTRE OU CACHE LE LOADER AU SUBMIT D'UN FORM EN AJAX
function showSubmitLoader(visible) {
    let submitBtn = document.getElementById('submit-btn'),
        submitLoader = document.getElementById('submit-loader');

    if(visible){
        submitBtn.style.display = 'none';
        submitLoader.style.display = 'block';
    }else{
        submitBtn.style.display = 'block';
        submitLoader.style.display = 'none';
    }
}


//CALLBACK BASIC APRÈS UN SUBMIT EN AJAX : UN REFRESH DE LA PAGE
function refresh() {
    window.location.reload();
}


//CALLBACK CLASSIQUE QUI FERME LA MODAL OUVERTE
function closeModal() {
    $('#modal').modal('close');
}


//CALLBACK AVEC MESSAGE DE REMERCIMENT
function closeProblemModal() {
    $('#modal').modal('close');
    setTimeout(function () {
        Materialize.toast('Merci de votre signalement !<br>On va corriger ça rapidement', 3000);
    },1500);
}


//CHANGE L'ORIENTATION DANS UN INPUT DU TYPE ORIENTATION
function switchOrientation(inputHidden) {
    let input = document.getElementById(inputHidden);
    input.value = (input.value == 1)? 0 : 1;
    colorOrientation();
}

//COLOR LES BRANCHES DE LA BOUSSOLE SUIVANT SI SES INPUTS SONT À 1 OU 0
function colorOrientation() {
    let hiddenInput = document.getElementsByClassName('hidden_orientation_input'),
        pathOrientation = document.querySelectorAll(".orientations-input path");

    for(let i = 0 ; i < hiddenInput.length ; i++){
        pathOrientation[i].style.fill = (hiddenInput[i].value === 1)? 'rgb(33,150,243)' : 'rgb(77,77,77)';
    }
}

//CHANGE LA SAISON DANS UN INPUT DU TYPE SAISON
function switchSaison(inputHidden) {
    let input = document.getElementById(inputHidden);
    input.value = (input.value === 1)? 0 : 1;
    colorSaison();
}

//COLOR LES ICÔNES DE SAISON SUIVANT SI SES INPUTS SONT À 1 OU 0
function colorSaison() {
    let hiddenInput = document.getElementsByClassName('hidden_season_input'),
        pathSaison = document.querySelectorAll(".season-input path");

    for(let i = 0 ; i < hiddenInput.length ; i++){
        pathSaison[i].style.fill = (hiddenInput[i].value === 1)? 'rgb(33,150,243)' : 'rgb(77,77,77)';
    }
}


//CRÉATION DE LA MAP
function creatInputMap() {
    let lat = parseFloat(document.getElementById('lat-hidden-input').value),
        lng = parseFloat(document.getElementById('lng-hidden-input').value),
        defautLat = (lat === 0)? 46.927527 : lat,
        defautLng = (lng === 0)? 2.871905 : lng,
        defautZoom = (lat === 0 && lng === 0)? 5 : 16;

    //définition des différents style de tuile
    let cartePopupMap = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/outdoors-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib2JseWsiLCJhIjoiY2oxMGl1MDJvMDAzbzJycGd1MWl6NDBpYyJ9.CXlzqHwoaZ0LlxWjuaj7ag', { attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}),
        satellitePopupMap   = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib2JseWsiLCJhIjoiY2oxMGl1MDJvMDAzbzJycGd1MWl6NDBpYyJ9.CXlzqHwoaZ0LlxWjuaj7ag', { attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'});

    //si la carte existe déjà on la détruit
    if(typeof inputMap !== "undefined"){
        markerInputMap.remove();
        inputMap.remove();

        markerInputMap = undefined;
    }

    //création de la map
    inputMap = L.map('input-map',{ zoomControl : true, center:[defautLat, defautLng], zoom : defautZoom, layers: [cartePopupMap]});

    //création du controlleur de tuile
    let basePopUpMaps = {
        "Relief": cartePopupMap,
        "Satellite": satellitePopupMap
    };

    //ajout du controleur de tuile
    L.control.layers(basePopUpMaps).addTo(inputMap);

    if(lat !== 0 || lng !== 0){
        markerInputMap = L.marker([lat,lng], {}).addTo(inputMap);
    }

    inputMap.on('click', pointMarkerInputMap);

    //on change le curseur pour une croix
    document.getElementById('input-map').style.cursor = 'crosshair';

}


//CHANGE L'EMPLACEMENT DU POINT SUR LA CARTE
function pointMarkerInputMap(e) {
    let lat = document.getElementById('lat-hidden-input'),
        lng = document.getElementById('lng-hidden-input');

    lat.value = e['latlng']['lat'];
    lng.value = e['latlng']['lng'];

    if(typeof markerInputMap !== "undefined"){
        markerInputMap.setLatLng(e['latlng']);
    }else{
        markerInputMap = L.marker(e['latlng'], {}).addTo(inputMap);
    }
}