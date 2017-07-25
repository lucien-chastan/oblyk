var inputMap = null,
    markerInputMap = null,
    circleRayon = null;


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
        let inputDatas = document.getElementsByClassName('input-data');
        if(inputDatas.length > 0 ) inputDatas[0].focus();

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

    //init des inputs date
    $('.datepicker').pickadate({
        monthsFull : ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthsShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Déc'],
        weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 80, // Creates a dropdown of 80 years to control year,
        today: 'Aujourd\'hui',
        format: 'yyyy-mm-dd',
        clear: 'Annuler',
        close: 'Ok',
        closeOnSelect: true // Close upon selecting a date,
    });

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

    //va chercher la liste des topos proches d'un point
    try {
        getTopoArround();
    }catch (e){}

    //va chercher la liste des massif proches d'un point
    try {
        getMassiveArround();
    }catch (e){}

    //initialise l'éiteur wysiwyg
    try{
        $('.trumbowyg-post-editor').trumbowyg({
            lang: 'fr',
            autogrow: true,
            btnsDef: {
                // Customizables dropdowns
                image: {
                    dropdown: ['insertImage', 'upload', 'base64'],
                    ico: 'insertImage'
                }
            },
            btns: ['formatting',
                '|', 'btnGrp-design',
                '|', 'superscript',
                '|', 'link',
                '|', 'image',
                '|', 'btnGrp-justify',
                '|', 'btnGrp-lists',
                '|', 'horizontalRule',
                '|', 'removeformat'
            ],
        });
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
        method = form.querySelector('#_method').value,
        route = form.getAttribute('data-route'),
        errorPopupText = form.getElementsByClassName('error-popup-text')[0],
        data = {};

    //Si nous ne somme pas déjà entrain de soumettre un formulaire
    if(!ajaxSubmited){

        ajaxSubmited = true;

        //on affiche un loader à la place du bouton submit
        showSubmitLoader(true, form);

        //on cache le message d'erreur
        errorPopupText.style.display = 'none';

        //créer un talbeau JSON des données à passer en paramètre
        for(let i in inputData){
            if(typeof inputData[i].value != "undefined"){
                if(inputData[i].getAttribute('type') === 'checkbox'){
                    data[inputData[i].name] = inputData[i].checked;
                }else{
                    data[inputData[i].name] = inputData[i].value;
                }

                //on enleve le invalid s'il y a
                inputData[i].setAttribute('class', inputData[i].className.replace(' invalid', ''));
            }
        }

        //on va chercher les valeurs des wysiwyg
        let wysiwyg = document.getElementsByClassName('trumbowyg-post-editor');
        if(wysiwyg.length > 0){
            data['trumbowyg-post-editor'] = $('#trumbowyg-post-editor').trumbowyg('html');
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
            showSubmitLoader(false, form);

            console.log(error);

            if(error.response.status === 422){

                //table des erreurs
                let errorArray = [];

                // on boucle sur les erreurs renvoyées
                for(let key in error.response.data){

                    //on ajout au tableau l'erreur courante
                    errorArray.push(error.response.data[key]);

                    try {
                        //on ajoute la class invalid au champs qui ne sont pas bon
                        let errorInput = form.querySelector("input[name='" + key + "']");
                        errorInput.setAttribute('class', errorInput.className + ' invalid');
                    }catch (e){}
                }

                //compil les erreurs
                let textError = errorArray.join('<br>');

                //on affiche les erreurs
                errorPopupText.style.display = 'block';
                errorPopupText.innerHTML = textError;
            }else{
                errorPopupText.style.display = 'block';
                errorPopupText.innerHTML = 'Erreur ' + error.response.status;
            }
        });
    }
}

//MONTRE OU CACHE LE LOADER AU SUBMIT D'UN FORM EN AJAX
function showSubmitLoader(visible, form = document.getElementsByClassName('submit-form')[0]) {
    let submitBtn = form.querySelector('#submit-btn'),
        submitLoader = form.querySelector('#submit-loader');

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
    input.value = (input.value === '1')? 0 : 1;
    colorOrientation();
}

//COLOR LES BRANCHES DE LA BOUSSOLE SUIVANT SI SES INPUTS SONT À 1 OU 0
function colorOrientation() {
    let hiddenInput = document.getElementsByClassName('hidden_orientation_input'),
        pathOrientation = document.querySelectorAll(".orientations-input path");

    for(let i = 0 ; i < hiddenInput.length ; i++){
        pathOrientation[i].style.fill = (hiddenInput[i].value === '1')? 'rgb(33,150,243)' : 'rgb(77,77,77)';
    }
}

//CHANGE LA SAISON DANS UN INPUT DU TYPE SAISON
function switchSaison(inputHidden) {
    let input = document.getElementById(inputHidden);
    input.value = (input.value === '1')? 0 : 1;
    colorSaison();
}

//COLOR LES ICÔNES DE SAISON SUIVANT SI SES INPUTS SONT À 1 OU 0
function colorSaison() {
    let hiddenInput = document.getElementsByClassName('hidden_season_input'),
        pathSaison = document.querySelectorAll(".season-input path");

    for(let i = 0 ; i < hiddenInput.length ; i++){
        pathSaison[i].style.fill = (hiddenInput[i].value === '1')? 'rgb(33,150,243)' : 'rgb(77,77,77)';
    }
}


//CRÉATION DE LA MAP
function creatInputMap() {
    let lat = parseFloat(document.getElementById('lat-hidden-input').value),
        lng = parseFloat(document.getElementById('lng-hidden-input').value),
        rayon = document.getElementById('rayon-localisation-popup'),
        defautLat = (lat === 0)? 46.927527 : lat,
        defautLng = (lng === 0)? 2.871905 : lng,
        defautZoom = (lat === 0 && lng === 0)? 5 : 16;


    //définition des différents style de tuile
    let cartePopupMap = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/outdoors-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib2JseWsiLCJhIjoiY2oxMGl1MDJvMDAzbzJycGd1MWl6NDBpYyJ9.CXlzqHwoaZ0LlxWjuaj7ag', { attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}),
        satellitePopupMap   = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib2JseWsiLCJhIjoiY2oxMGl1MDJvMDAzbzJycGd1MWl6NDBpYyJ9.CXlzqHwoaZ0LlxWjuaj7ag', { attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'});

    //si la carte existe déjà on la détruit
    if(inputMap !== null){
        inputMap = null;
        markerInputMap = null;
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

        try {
            let valRayon = parseInt(rayon.value);
            circleRayon = L.circle([lat,lng],{
                radius : valRayon * 1000,
                fill : false,
                color : '#2196F3'
            }).addTo(inputMap);
            inputMap.fitBounds(circleRayon.getBounds());
        }catch (e){}
    }

    inputMap.on('click', pointMarkerInputMap);

    //on change le curseur pour une croix
    document.getElementById('input-map').style.cursor = 'crosshair';

}


//CHANGE L'EMPLACEMENT DU POINT SUR LA CARTE
function pointMarkerInputMap(e) {
    let lat = document.getElementById('lat-hidden-input'),
        lng = document.getElementById('lng-hidden-input'),
        rayon = document.getElementById('rayon-localisation-popup');

    lat.value = e['latlng']['lat'];
    lng.value = e['latlng']['lng'];

    if(markerInputMap !== null){
        markerInputMap.setLatLng(e['latlng']);
        try {
            circleRayon.setLatLng(e['latlng']);
        }catch (e){}
    }else{
        markerInputMap = L.marker(e['latlng'], {}).addTo(inputMap);

        try {
            let valRayon = parseInt(rayon.value);
            circleRayon = L.circle(e['latlng'],{
                radius : valRayon * 1000,
                fill : false,
                color : '#2196F3'
            }).addTo(inputMap);
            inputMap.fitBounds(circleRayon.getBounds());
        }catch (e){}
    }
}

function changeRayonPopupMap() {
    let lat = parseFloat(document.getElementById('lat-hidden-input').value),
        lng = parseFloat(document.getElementById('lng-hidden-input').value),
        rayon = document.getElementById('rayon-localisation-popup');

    if(lat !== 0 || lng !== 0){
        try {
            let valRayon = parseInt(rayon.value);
            circleRayon.setRadius(valRayon * 1000);
            inputMap.fitBounds(circleRayon.getBounds());
        }catch (e){}
    }
}