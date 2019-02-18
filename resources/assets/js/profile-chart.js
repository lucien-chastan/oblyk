let paintedCharts = [],
    analytiksMap = null,
    initMap = false;

function getChartMyCross() {
    let user_id = document.getElementById('user-id-climb-type').value;

    axios.post('/chart/cross/climb-type', {user_id: user_id}).then(function (response) {
        new Chart(
            document.getElementById("chart-climb-id").getContext('2d'),
            JSON.parse(response.data)
        );
    });

}

function cocheFiltre(check, elementName) {
    let checkboxes = document.getElementsByName(elementName);
    for (let i = 0; i < checkboxes.length; i++) checkboxes[i].checked = check;
}

function visibleFilterPeriod(switchbox) {
    let divFilter = document.getElementById('div-filter-period');
    divFilter.style.display = switchbox.checked === true ? 'block' : 'none';
}

// Save analytics filter
function submitFilter() {
    let statusesIpt = document.getElementsByName('statusesFilter'),
        statusesArray = {},
        climbsIpt = document.getElementsByName('climbsFilter'),
        climbsIndoorIpt = document.getElementsByName('indoorClimbsFilter'),
        climbsArray = {},
        climbsIndoorArray = {},
        switchFilter = document.getElementById('switch-filter'),
        climbStart = document.getElementById('climb-filter-start'),
        climbEnd = document.getElementById('climb-filter-end'),
        periodFilter = '';

    for (let i = 0; i < statusesIpt.length; i++) statusesArray[statusesIpt[i].value] = (statusesIpt[i].checked === true);
    for (let i = 0; i < climbsIpt.length; i++) climbsArray[climbsIpt[i].value] = (climbsIpt[i].checked === true);
    for (let i = 0; i < climbsIndoorIpt.length; i++) climbsIndoorArray[climbsIndoorIpt[i].value] = (climbsIndoorIpt[i].checked === true);

    if (switchFilter.checked === true) {
        periodFilter = '{"start":"' + climbStart.value + '","end":"' + climbEnd.value + '"}';
    } else {
        periodFilter = '{"start":"first","end":"now"}';
    }

    axios.post('/user/settings/filter', {
        filter_climb: JSON.stringify(climbsArray),
        filter_indoor_climb: JSON.stringify(climbsIndoorArray),
        filter_status: JSON.stringify(statusesArray),
        filter_period: periodFilter
    }).then(function () {
        initMap = false;
        paintedCharts = [];
        reloadCurrentVue();
    });
}


// Loop on graphic canvas
function getAnalytiksCharts(canvasClass = 'route-analytiks-canvas') {
    let analytkisCanvas = document.getElementsByClassName(canvasClass);

    setTimeout(function () {
        for (let i = 0; i < analytkisCanvas.length; i++) {
            let route = analytkisCanvas[i].getAttribute('data-route'),
                element = analytkisCanvas[i];

            if (paintedCharts[element.id] !== true) paintChart(route, element);

        }

        if (canvasClass === 'environment-analytiks-canvas' && initMap !== true) {
            setTimeout(function () {
                initAnalytiksMap();
            }, 500);
        }
    }, 300);
}


// Get graphics
function paintChart(route, element) {
    axios.post(route).then(function (response) {

        paintedCharts[element.id] = true;

        new Chart(
            element.getContext('2d'),
            JSON.parse(response.data)
        );

    });
}

function initAnalytiksMap() {
    let latLngPolyline = [];

    if (analytiksMap !== null) analytiksMap.remove();

    analytiksMap = L.map('analytiks-map', {zoomControl: true, center: [46.5, 4.5], zoom: 5, layers: [carte]});

    // Add zoom controller
    L.control.layers(baseMaps).addTo(analytiksMap);

    axios.post('/chart/analytiks/maps').then(function (response) {
        let crags = response.data.crags,
            gyms = response.data.gyms;

        // Add crag on map
        for (let i in crags) {

            let markerIcon = styleIcon(crags[i].type_voie + '' + crags[i].type_grande_voie + '' + crags[i].type_bloc + '' + crags[i].type_deep_water + '' + crags[i].type_via_ferrata);

            L.marker(
                [crags[i].lat, crags[i].lng],
                {icon: markerIcon}
            ).bindPopup(buildPopup(crags[i])).addTo(analytiksMap);

            latLngPolyline.push([crags[i].lat, crags[i].lng])
        }

        // Add gym on map
        for (let i in gyms) {

            let markerIcon = styleGymIcon(gyms[i].type_route + '' + gyms[i].type_pan + '' + gyms[i].type_boulder);

            L.marker(
                [gyms[i].lat, gyms[i].lng],
                {icon: markerIcon}
            ).bindPopup(buildGymPopup(gyms[i])).addTo(analytiksMap);

            latLngPolyline.push([gyms[i].lat, gyms[i].lng])
        }

        let polyline = L.polyline(latLngPolyline, {color: 'rgba(255,255,255,0'}).addTo(analytiksMap);

        // zoom the map to the polyline
        analytiksMap.fitBounds(polyline.getBounds());

        //on supprime la polyline de zoom
        polyline.remove();

        initMap = true;
    });
}