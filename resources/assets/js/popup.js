let inputMap = null,
    inputMapApproach = null,
    markerInputMap = null,
    polylineApproach = null,
    circleRayon = null,
    cropper = null;


// Open modal and init special action
function openModal(route, data) {

    let loadModal = document.getElementById('load-modal'),
        contentModal = document.getElementById('modal-content');

    // Show loader
    loadModal.style.display = 'block';
    contentModal.style.display = 'none';

    // Change ' to " for parse into JSON
    if (typeof data != 'object') data = JSON.parse(data.replace(/[']/g, '"'));

    // Ajax query
    axios.post(route, data).then(function (response) {

        contentModal.innerHTML = response.data;

        // Init special input in new modal
        specialAction(data);

        // Hide loader and display content
        loadModal.style.display = 'none';
        contentModal.style.display = 'block';

        // Set focus on first modal input
        let inputDatas = document.getElementsByClassName('input-data');
        if (inputDatas.length > 0) inputDatas[0].focus();

    });
}

// Special action after load modal
function specialAction(data) {

    // Input type link
    let inputCurrentPage = document.getElementById('inputCurrentPage');
    try {
        inputCurrentPage.value = location.href;
    } catch (e) {
    }

    // Auto resize textarea
    $('.md-textarea').trigger('autoresize');

    // Init select input
    if (windowWidth() > 480) {
        $('select').material_select();
    } else {
        var selectForms = $('#modal-content select');
        for (let i = 0; i < selectForms.length; i++) {
            selectForms[i].classList.add('browser-default');
            try {
                let label = selectForms[i].parentElement.getElementsByTagName('label')[0];
                label.classList.add('active');
            } catch (e) {}
        }
    }

    // Init materialize tab
    setTimeout(function () {
        try {
            $('.topotabs').tabs();
        } catch (e) {
        }
    }, 500);

    // Init date picker
    $('.datepicker').pickadate({
        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthsShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Déc'],
        weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 120, // Creates a dropdown of 120 years to control year,
        today: 'Aujourd\'hui',
        min: '1900-01-01',
        format: 'yyyy-mm-dd',
        clear: 'Annuler',
        close: 'Ok',
        closeOnSelect: true, // Close upon selecting a date,
        onSet: function (ele) {
            if (ele.select) {
                this.close();
            }
        }
    });

    // Init compass
    colorOrientation();

    // Init season
    colorSaison();

    // Optimize crag route modal
    try {
        optimisePopupRoute();
        dupliqueLongueurLine();
        document.getElementById('type_cotation_longeur').addEventListener('change', optimisePopupRoute);
        document.getElementById('nb_longueur').addEventListener('change', setJsonLongueur);
        document.getElementById('nb_longueur').addEventListener('change', dupliqueLongueurLine);
        document.getElementById('popup_line_name').addEventListener('keyup', getSimilarRoute);
    } catch (e) {
    }

    // Get guidebook around
    try {
        getTopoArround();
    } catch (e) {
    }

    // Get massive around
    try {
        getMassiveArround();
    } catch (e) {
    }

    // Init markdown wysiwyg
    try {
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
    } catch (e) {
    }

    // Init map on modal
    setTimeout(function () {
        try {
            creatInputMap();
        } catch (e) {
        }
    }, 500);

    // Init approach map
    setTimeout(function () {
        try {
            creatInputMapApproach();
        } catch (e) {
        }
    }, 500);

    // init reverse geo coding
    if (data['MapReverseGeoCoding'] === true) {
        MapReverseGeoCoding();
    }

    // Init crop image
    if (typeof document.getElementById('original-picture-for-crop') == "object") {
        try {
            cropper = $('#original-picture-for-crop').croppie({
                customClass: 'crop-picture-class',
                showZoomer: false,
                viewport: {type: 'circle'}
            });
        } catch (e) {
        }
    }
}

// When page is load, add initOpenModal event
window.addEventListener('load', function () {
    initOpenModal();
});


// Add openModal event
function initOpenModal() {
    let btnModal = document.getElementsByClassName('btnModal');

    for (let i = 0; i < btnModal.length; i++) {

        if (btnModal[i].getAttribute('data-parsed') !== 'true') {
            let route = btnModal[i].getAttribute('data-route'),
                data = btnModal[i].getAttribute('data-modal');

            btnModal[i].addEventListener('click', function () {
                openModal(route, data);
            });

            btnModal[i].setAttribute('data-parsed', 'true');
        }
    }
}


// When you submit modal
function submitData(form, callback) {
    let inputData = form.getElementsByClassName('input-data'),
        method = form.querySelector('#_method').value,
        route = form.getAttribute('data-route'),
        errorPopupText = form.getElementsByClassName('error-popup-text')[0],
        data = {};

    // control if not already submitted
    if (!ajaxSubmited) {

        ajaxSubmited = true;

        // Display loader
        showSubmitLoader(true, form);

        // Hide error area
        errorPopupText.style.display = 'none';

        // Serialize input data in JSON array
        for (let i in inputData) {
            if (typeof inputData[i].value != "undefined") {
                if (inputData[i].getAttribute('type') === 'checkbox') {
                    data[inputData[i].name] = inputData[i].checked;
                } else if(inputData[i].getAttribute('type') === 'radio') {
                    if (inputData[i].checked) {
                        data[inputData[i].name] = inputData[i].value;
                    }
                } else {
                    data[inputData[i].name] = inputData[i].value;
                }

                inputData[i].setAttribute('class', inputData[i].className.replace(' invalid', ''));
            }
        }

        // get markdown wysiwyg data
        let wysiwyg = document.getElementsByClassName('trumbowyg-post-editor');
        if (wysiwyg.length > 0) {
            data['trumbowyg-post-editor'] = $('#trumbowyg-post-editor').trumbowyg('html');
        }

        // Get approach polyline
        let approaches = document.getElementsByClassName('input-map-approach');
        if (approaches.length > 0) {
            data['polyline'] = getPolylinePoints();
            data['length'] = getLengthPolyline();
        }

        axios(
            {
                method: method,
                url: route,
                data: data
            }
        ).then(function (response) {
            ajaxSubmited = false;
            callback(response);
        }).catch(function (error) {
            ajaxSubmited = false;
            showSubmitLoader(false, form);

            if (error.response.status === 422) {
                let errorArray = [];

                // loop on errors
                for (let key in error.response.data) {
                    errorArray.push(error.response.data[key]);

                    try {
                        let errorInput = form.querySelector("input[name='" + key + "']");
                        errorInput.setAttribute('class', errorInput.className + ' invalid');
                    } catch (e) {
                    }
                }

                // join error
                let textError = errorArray.join('<br>');

                // and display error
                errorPopupText.style.display = 'block';
                errorPopupText.innerHTML = textError;
            } else {
                errorPopupText.style.display = 'block';
                errorPopupText.innerHTML = 'Erreur ' + error.response.status;
            }
        });
    }
}

// Show or hide loader
function showSubmitLoader(visible, form = document.getElementsByClassName('submit-form')[0]) {
    let submitBtn = form.querySelector('#submit-btn'),
        submitLoader = form.querySelector('#submit-loader');

    if (visible) {
        submitBtn.style.display = 'none';
        submitLoader.style.display = 'block';
    } else {
        submitBtn.style.display = 'block';
        submitLoader.style.display = 'none';
    }
}


// Basic callback after submit
function refresh() {
    window.location.reload();
}


// Close modal after submit
function closeModal() {
    $('#modal').modal('close');
}


// Callback problem modal
function closeProblemModal() {
    $('#modal').modal('close');
    setTimeout(function () {
        Materialize.toast('Merci de votre signalement !<br>On va corriger ça rapidement', 3000);
    }, 1500);
}


// Switch orientation input
function switchOrientation(inputHidden) {
    let input = document.getElementById(inputHidden);
    input.value = (input.value === '1') ? 0 : 1;
    colorOrientation();
}

// Paint compass branch
function colorOrientation() {
    let hiddenInput = document.getElementsByClassName('hidden_orientation_input'),
        pathOrientation = document.querySelectorAll(".orientations-input path");

    for (let i = 0; i < hiddenInput.length; i++) {
        pathOrientation[i].style.fill = (hiddenInput[i].value === '1') ? 'rgb(33,150,243)' : 'rgb(77,77,77)';
    }
}

// Switch season input
function switchSaison(inputHidden) {
    let input = document.getElementById(inputHidden);
    input.value = (input.value === '1') ? 0 : 1;
    colorSaison();
}

// Paint season input
function colorSaison() {
    let hiddenInput = document.getElementsByClassName('hidden_season_input'),
        pathSaison = document.querySelectorAll(".season-input path");

    for (let i = 0; i < hiddenInput.length; i++) {
        pathSaison[i].style.fill = (hiddenInput[i].value === '1') ? 'rgb(33,150,243)' : 'rgb(77,77,77)';
    }
}

// Init modal map
function creatInputMap() {
    let lat = parseFloat(document.getElementById('lat-hidden-input').value),
        lng = parseFloat(document.getElementById('lng-hidden-input').value),
        rayon = document.getElementById('rayon-localisation-popup'),
        defautLat = (lat === 0) ? 46.927527 : lat,
        defautLng = (lng === 0) ? 2.871905 : lng,
        defautZoom = (lat === 0 && lng === 0) ? 5 : 16;


    // Init tile
    let mapBoxCartePopupMap = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/outdoors-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib2JseWsiLCJhIjoiY2oxMGl1MDJvMDAzbzJycGd1MWl6NDBpYyJ9.CXlzqHwoaZ0LlxWjuaj7ag', {attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}),
        mapBoxSatellitePopupMap = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib2JseWsiLCJhIjoiY2oxMGl1MDJvMDAzbzJycGd1MWl6NDBpYyJ9.CXlzqHwoaZ0LlxWjuaj7ag', {attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}),
        reliefPopupMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}', {attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors - Tiles &copy; <a href="http://www.esrifrance.fr" title="Esri, DeLorme, NAVTEQ, TomTom, Intermap, iPC, USGS, FAO, NPS, NRCAN, GeoBase, Kadaster NL, Ordnance Survey, Esri Japan, METI, Esri China (Hong Kong), and the GIS User Community">Esri</a>\''}),
        cartePopupMap = L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}),
        satellitePopupMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors - Tiles &copy; <a href="http://www.esrifrance.fr" title="Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community">Esri</a>'});


    // Destroy map if already exist
    if (inputMap !== null) {
        inputMap = null;
        markerInputMap = null;
    }

    // create map
    inputMap = L.map('input-map', {
        zoomControl: true,
        center: [defautLat, defautLng],
        zoom: defautZoom,
        layers: [cartePopupMap]
    });

    // Tile controler
    let basePopUpMaps = {
        "Carte": cartePopupMap,
        "Relief": reliefPopupMap,
        "Satellite": satellitePopupMap
    };
    L.control.layers(basePopUpMaps).addTo(inputMap);

    if (lat !== 0 || lng !== 0) {
        markerInputMap = L.marker([lat, lng], {}).addTo(inputMap);

        try {
            let valRayon = parseInt(rayon.value);
            circleRayon = L.circle([lat, lng], {
                radius: valRayon * 1000,
                fill: false,
                color: '#2196F3'
            }).addTo(inputMap);
            inputMap.fitBounds(circleRayon.getBounds());
        } catch (e) {
        }
    }

    inputMap.on('click', pointMarkerInputMap);

    // Change cursor for cross
    document.getElementById('input-map').style.cursor = 'crosshair';

}


// Creat approach map
function creatInputMapApproach() {
    let stringPolyline = document.getElementById('polyline-hidden-input').value,
        points = convertApprocheString(stringPolyline);
    defautLat = 46.927527,
        defautLng = 2.871905,
        defautZoom = 5;


    // Define map tile
    let cartePopupMapMapbox = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/outdoors-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib2JseWsiLCJhIjoiY2oxMGl1MDJvMDAzbzJycGd1MWl6NDBpYyJ9.CXlzqHwoaZ0LlxWjuaj7ag', {attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}),
        satellitePopupMapMapBox = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib2JseWsiLCJhIjoiY2oxMGl1MDJvMDAzbzJycGd1MWl6NDBpYyJ9.CXlzqHwoaZ0LlxWjuaj7ag', {attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}),
        reliefPopupMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}', {attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors - Tiles &copy; <a href="http://www.esrifrance.fr" title="Esri, DeLorme, NAVTEQ, TomTom, Intermap, iPC, USGS, FAO, NPS, NRCAN, GeoBase, Kadaster NL, Ordnance Survey, Esri Japan, METI, Esri China (Hong Kong), and the GIS User Community">Esri</a>\''}),
        cartePopupMap = L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}),
        satellitePopupMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors - Tiles &copy; <a href="http://www.esrifrance.fr" title="Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community">Esri</a>'});

    // Destroy map if already exist
    if (inputMapApproach !== null) {
        inputMapApproach = null;
        polylineApproach = null;
    }

    // Creat map
    inputMapApproach = L.map('input-map-approach', {
        zoomControl: true,
        center: [defautLat, defautLng],
        zoom: defautZoom,
        layers: [cartePopupMap]
    });

    // Tile controler
    let basePopUpMaps = {
        "Carte": cartePopupMap,
        "Relief": reliefPopupMap,
        "Satellite": satellitePopupMap
    };
    L.control.layers(basePopUpMaps).addTo(inputMapApproach);

    // Add sector, parking and crag marker
    let elements = JSON.parse(document.getElementById('over-elements-for-map').value);
    for (let i = 0; i < elements.length; i++) {
        if (elements[i].type === 'sector') L.marker([parseFloat(elements[i].lat), parseFloat(elements[i].lng)], {icon: marker_sector}).bindPopup(elements[i].label).addTo(inputMapApproach);
        if (elements[i].type === 'crag') L.marker([parseFloat(elements[i].lat), parseFloat(elements[i].lng)], {icon: marker_10000}).bindPopup(elements[i].label).addTo(inputMapApproach);
        if (elements[i].type === 'parking') L.marker([parseFloat(elements[i].lat), parseFloat(elements[i].lng)], {icon: marker_parking}).bindPopup(elements[i].label).addTo(inputMapApproach);
    }

    // Add approach polyline
    polylineApproach = L.Polyline.Plotter(points, {weight: 2, color: '#2196F3'}).addTo(inputMapApproach);

    inputMapApproach.fitBounds(polylineApproach.getBounds());

    // Change cursor for cross
    document.getElementById('input-map-approach').style.cursor = 'crosshair';
}

function getPolylinePoints() {
    let points = polylineApproach.getLatLngs(),
        pointsReturn = [];

    for (let i = 0; i < points.length; i++) {
        pointsReturn.push("[" + points[i].lat + "," + points[i].lng + "]");
    }

    return pointsReturn.join(', ');
}

function getLengthPolyline() {
    let points = polylineApproach.getLatLngs(),
        length = 0;

    for (let i = 0; i < points.length; i++) {
        if (i < points.length - 1) length += getGpsRange(points[i].lat, points[i].lng, points[i + 1].lat, points[i + 1].lng)
    }

    return length * 1000;
}

// Change marker modal map
function pointMarkerInputMap(e) {
    let lat = document.getElementById('lat-hidden-input'),
        lng = document.getElementById('lng-hidden-input'),
        rayon = document.getElementById('rayon-localisation-popup');

    lat.value = e['latlng']['lat'];
    lng.value = e['latlng']['lng'];

    if (markerInputMap !== null) {
        markerInputMap.setLatLng(e['latlng']);
        try {
            circleRayon.setLatLng(e['latlng']);
        } catch (e) {
        }
    } else {
        markerInputMap = L.marker(e['latlng'], {}).addTo(inputMap);

        try {
            let valRayon = parseInt(rayon.value);
            circleRayon = L.circle(e['latlng'], {
                radius: valRayon * 1000,
                fill: false,
                color: '#2196F3'
            }).addTo(inputMap);
            inputMap.fitBounds(circleRayon.getBounds());
        } catch (e) {
        }
    }
}

function changeRayonPopupMap() {
    let lat = parseFloat(document.getElementById('lat-hidden-input').value),
        lng = parseFloat(document.getElementById('lng-hidden-input').value),
        rayon = document.getElementById('rayon-localisation-popup');

    if (lat !== 0 || lng !== 0) {
        try {
            let valRayon = parseInt(rayon.value);
            circleRayon.setRadius(valRayon * 1000);
            inputMap.fitBounds(circleRayon.getBounds());
        } catch (e) {
        }
    }
}

function convertApprocheString(approachString) {
    let clean1 = approachString.replace(/["]/g, ''),
        outputArray = [],
        split1 = clean1.split(', ');

    for (let i = 0; i < split1.length; i++) {
        let clean2 = split1[i].replace(/[\[\]]/g, ''),
            split2 = clean2.split(',');
        outputArray.push([parseFloat(split2[0]), parseFloat(split2[1])]);
    }

    return outputArray;
}

// Hide tag on tag list
function searchTags() {
    let search_tags_ipt = document.getElementById('search_tags'),
        tag_div = document.getElementsByClassName('tag_div');

    for (let i = 0; i < tag_div.length; i++) {
        tag_div[i].style.display = tag_div[i].getAttribute('data-tag').indexOf(search_tags_ipt.value) !== -1 ? 'block' : 'none';
    }

}

// Join selected tag list
function parseTags() {
    let checkTags = document.getElementsByName('check_tag_route'),
        tagsList = document.getElementById('tagsList'),
        tags = [];

    for (let i = 0; i < checkTags.length; i++) {
        if (checkTags[i].checked === true) tags.push(checkTags[i].value);
    }

    tagsList.value = tags.join(';');
}
