let scheme, timeToLoad, sectors = [], routeLines = [], inEdition = false, crossesIsLoaded = false,
    current_sector_label, current_sector_id,
    current_route_label, current_route_id,
    side_nav_is_open = true, sector_area_layer = null, route_line_layer = null;

window.addEventListener('load', function () {
    openSideNav(true);
});

function initGetElement() {
    var hash = location.hash,
        sectorRegExp = /^#sector-\d+$/,
        lineRegExp = /^#line-\d+$/;

    if (sectorRegExp.test(hash)) {
        getGymSector(hash.split('-')[1]);
    } else if (lineRegExp.test(hash)) {
        getGymRoute(hash.split('-')[1]);
    } else {
        getSectors();
    }
}

function initSchemeGymMap() {
    let mapArea = document.getElementById('gym-scheme'),
        nav_barre = document.getElementById('nav_barre'),
        nav_link = nav_barre.getElementsByTagName('a'),
        heightScheme = 0,
        widthScheme = 0,
        data = {
            'room_id': mapArea.getAttribute('data-room-id'),
            'gym_id': mapArea.getAttribute('data-gym-id'),
            'gym_label': mapArea.getAttribute('data-gym-label'),
            'gym_url': mapArea.getAttribute('data-gym-url'),
            'banner_color': mapArea.getAttribute('data-banner-color'),
            'banner_bg_color': mapArea.getAttribute('data-banner-bg-color'),
            'scheme_bg_color': mapArea.getAttribute('data-scheme-bg-color'),
            'scheme_height': parseInt(mapArea.getAttribute('data-scheme-height')),
            'scheme_width': parseInt(mapArea.getAttribute('data-scheme-width')),
        };

    if (data.scheme_height > data.scheme_width) {
        heightScheme = 100;
        widthScheme = 100 * data.scheme_width / data.scheme_height;
    } else {
        heightScheme = 100 * data.scheme_height / data.scheme_width;
        widthScheme = 100;
    }

    // Style
    mapArea.style.backgroundColor = data.scheme_bg_color;
    nav_barre.style.backgroundColor = data.banner_bg_color;
    for (var i = 0; i < nav_link.length; i++) {
        nav_link[i].style.color = data.banner_color;
    }

    let shemeUrl = '/storage/gyms/schemes/scheme-' + data.room_id + '.png',
        mapBounds = [[0, 0], [heightScheme, widthScheme]];

    sector_area_layer = L.layerGroup();
    var backGroundMap = L.imageOverlay(
        shemeUrl,
        mapBounds,
        {
            alt: 'Plan de la salle ' + data.gym_label,
            attribution: '<a href="' + data.gym_url + '">' + data.gym_label + '</a>'
        }
    );

    scheme = L.map('gym-scheme', {
        zoomControl: false,
        editable: true,
        layers: [sector_area_layer, backGroundMap]
    });

    L.control.zoom({position: 'bottomright'}).addTo(scheme);

    var schemeLayer = {
        'Plan de la structure': backGroundMap,
        "Secteurs": sector_area_layer
    };

    L.control.layers(null, schemeLayer).addTo(scheme);

    scheme.fitBounds([[0, 0], [heightScheme, widthScheme]]);
    scheme.on('click', function (e) {
        if (window.windowWidth() < 780 && side_nav_is_open === true) {
            closeGymSchemeSideNave();
        }
    });

    scheme.on('editable:created', function (e) {
        newArea = e.layer;
        newRouteLine = e.layer;
    });

    getJsonGymSector(data.room_id, true);
}

function getJsonGymSector(room_id, runGetJsonRoute = false) {
    axios.get('/API/gyms/get-sectors/' + room_id).then(function (response) {
        for (var i = 0; i < response.data.sectors.length; i++) {

            var sector = response.data.sectors[i];
            if (sector.area !== '') {
                var polygon = L.polygon(JSON.parse(sector.area), {
                    color: 'red',
                    className: 'sector-map-area map-class-sector-' + sector.id,
                    attribution: {'id': sector.id, 'label': sector.label}
                }).addTo(scheme);
                polygon.on('click', (e) => {
                    var sectorAttribute = e.target.options.attribution;
                    getGymSector(sectorAttribute.id, 'map');
                });
                polygon.addTo(sector_area_layer);
                sectors[sector.id] = polygon;
            }
        }
        if (runGetJsonRoute) {
            getJsonGymRoute(room_id)
        }
    });
}

function getJsonGymRoute(room_id) {
    axios.get('/API/gyms/get-routes/' + room_id).then(function (response) {
        for (var i = 0; i < response.data.routes.length; i++) {

            var route = response.data.routes[i];
            if (route.line !== '') {
                var polyline = L.polyline(JSON.parse(route.line), {
                    color: route.line_color,
                    className: 'route-map-line line-in-sector-' + route.sector_id + ' map-class-line-' + route.id,
                    attribution: {'id': route.id, 'label': route.label, 'sector_id': route.sector_id}
                }).addTo(scheme);
                polyline.on('click', (e) => {
                    var routeAttribute = e.target.options.attribution;
                    getGymRoute(routeAttribute.id, 'map');
                    activeMapSector(routeAttribute.sector_id, 'map');
                });
                routeLines[route.id] = polyline;
            }
        }
    });
}

// Open or close side nav
function openSideNav(open) {
    let volet = document.getElementById('side-map-gym-scheme');

    if (open) {
        volet.style.transform = 'translateX(0)';
    } else {
        volet.style.transform = 'translateX(-100%)';
    }
}

// Load room sectors
function getSectors() {
    var content = document.getElementById('content-side-map-gym-scheme'),
        item2 = document.getElementById('item-nav-2'),
        item3 = document.getElementById('item-nav-3');

    sideNavLoader(false);

    axios.get('/salle-escalade/topo/sectors/' + GlobalRoomId).then(function (response) {
        sweetDisappearance(false, item2);
        sweetDisappearance(false, item3);
        content.innerHTML = response.data;
        sideNavLoader(true);
        initOpenModal();
        $('.tooltipped').tooltip({delay: 50});
        $('ul.tabs').tabs();
        unActiveAllMapSector();
        unActiveAllMapLine();
        hiddenAllLines();
        location.hash = '';
    });
}

// Load sector
function getGymSector(sector_id, origin = null) {
    if (!inEdition) {
        var content = document.getElementById('content-side-map-gym-scheme'),
            item2 = document.getElementById('item-nav-2'),
            item3 = document.getElementById('item-nav-3');

        sideNavLoader(false);

        if (origin === 'map' && window.windowWidth() < 780 && side_nav_is_open === false) {
            setTimeout(function () {
                closeGymSchemeSideNave();
            }, 50);
        }

        hiddenAllLines();

        axios.get('/salle-escalade/topo/sector/' + sector_id).then(function (response) {
            sweetDisappearance(true, item2);
            sweetDisappearance(false, item3);
            sideNavLoader(true);
            content.innerHTML = response.data;
            var sector_label = document.getElementById('sector-name-for-ajax').value;
            item2.textContent = sector_label;

            current_sector_id = sector_id;
            current_sector_label = sector_label;

            initOpenModal();
            $('.tooltipped').tooltip({delay: 50});
            activeMapSector(current_sector_id);
            showMapSectorLines(current_sector_id);
            unActiveAllMapLine();
            location.replace('#sector-' + current_sector_id);
            item2.onclick = function () {
                getGymSector(sector_id);
                animationLoadSideNav('l');
            };
        });
    }
}

// Load route
function getGymRoute(route_id, origin = null) {
    var content = document.getElementById('content-side-map-gym-scheme'),
        item3 = document.getElementById('item-nav-3');

    sideNavLoader(false);

    if (origin === 'map' && window.windowWidth() < 780 && side_nav_is_open === false) {
        setTimeout(function () {
            closeGymSchemeSideNave();
        }, 50);
    }

    axios.get('/salle-escalade/topo/route/' + route_id).then(function (response) {
        sweetDisappearance(true, item3);
        content.innerHTML = response.data;
        var route_label = document.getElementById('route-name-for-ajax').value;
        item3.textContent = route_label;
        sideNavLoader(true);
        initOpenModal();

        current_route_id = route_id;
        current_route_label = route_label;
        activeMapLine(current_route_id);
        showMapLine(current_route_id);
        location.replace('#line-' + current_route_id);
    });
}

function sideNavLoader(status) {
    var loader = document.getElementById('load-side-map-gym-scheme'),
        contentArea = document.getElementById('content-side-map-gym-scheme');

    if (status) {
        clearTimeout(timeToLoad);
        loader.style.display = 'none';
        contentArea.style.display = 'block';
    } else {
        timeToLoad = setTimeout(function () {
            loader.style.display = 'block';
            contentArea.style.display = 'none';
        }, 200);
    }
}

function animationLoadSideNav(direction = 'r') {
    var animationDiv = document.getElementById('animation-div');

    animationDiv.style.opacity = '0';

    rightLeftAnimation(direction, animationDiv);

    setTimeout(function () {
        rightLeftAnimation(direction === 'r' ? 'l' : 'r', animationDiv);
        setTimeout(function () {
            animationDiv.style.transform = 'translateX(0)';
            animationDiv.style.opacity = '1';
            leaveAllMapSectors();
            leaveAllMapLines();
        }, 100);
    }, 100);
}

function rightLeftAnimation(direction, element) {
    if (direction === 'r') {
        element.style.transform = 'translateX(-100px)'
    } else {
        element.style.transform = 'translateX(100px)'
    }
}

function sweetDisappearance(status, element) {
    if (status) {
        element.style.display = 'inline';
        setTimeout(function () {
            element.style.opacity = '1';
        }, 10);
    } else {
        element.style.opacity = '0';
        setTimeout(function () {
            element.style.display = 'none';
        }, 300);
    }
}

function reloadSectorsVue() {
    getSectors();
    closeModal();
}

function reloadGymSectorVue() {
    getGymSector(current_sector_id);
    closeModal();
}

function reloadPage() {
    location.reload();
}

function loadNewGymRoom() {
    axios.get(document.getElementById('last-created-room').value).then(function (response) {
        location.href = response.data.route;
    });
}

function afterDeleteGotTo() {
    axios.get(document.getElementById('first-order-room').value).then(function (response) {
        location.href = response.data.route;
    });
}

function reloadRouteVue() {
    getGymRoute(current_route_id);
    closeModal();
}

function reloadSectorVue() {
    getGymSector(current_sector_id);
    closeModal();
}

function afterDeleteSector() {
    Materialize.toast('Secteur supprimé', 4000);
    getSectors();
    closeModal();
}

function closeGymSchemeSideNave() {
    var bodyMap = document.getElementById('body-map');

    if (bodyMap.className === 'side-nav-is-open') {
        bodyMap.className = 'side-nav-is-close';
        side_nav_is_open = false;
    } else {
        bodyMap.className = 'side-nav-is-open';
        side_nav_is_open = true;
    }
}

function getDefaultRouteGrade(element) {
    var firstColorGymRoute = document.getElementById('firstColorGymRoute'),
        secondColorGymRoute = document.getElementById('secondColorGymRoute'),
        gymRouteGradeText = document.getElementById('gymRouteGradeText'),
        useSecondColorGymRoute = document.getElementById('useSecondColorGymRoute');

    axios.get('/api/v1/gym-grade-line/' + element.value).then(function (response) {
        var gradeLine = response.data.data;

        gymRouteGradeText.value = gradeLine.grade;

        if(gradeLine.changeHoldColor) {
            firstColorGymRoute.value = gradeLine.colors[0];
            useSecondColorGymRoute.checked = gradeLine.useSecondColor;
            $('#firstColorGymRoute').material_select('update');

            if (gradeLine.useSecondColor) {
                secondColorGymRoute.value = gradeLine.colors[1];
                $('#secondColorGymRoute').material_select('update');
            }
        }
    });
}

function getGymCrosses(force = false) {
    var content = document.getElementById('crosses-vue');

    if (crossesIsLoaded === false || force) {
        axios.get('/salle-escalade/topo/crosses/' + GlobalGymId).then(function (response) {
            content.innerHTML = response.data;
            showCrosses(true);
            crossesIsLoaded = true;
            initOpenModal();
            $('.tooltipped').tooltip({delay: 50});
            $('ul.tabs').tabs();
        });
    } else {
        showCrosses(true);
    }
}

function showCrosses(show) {
    if (show) {
        document.getElementsByClassName('crosses-vue')[0].style.display = 'block';
    } else {
        document.getElementsByClassName('crosses-vue')[0].style.display = 'none';
    }
}

function reloadCrossesVue() {
    indoorPaintedCharts = [];
    getGymCrosses(true);
    closeModal();
}


// Over and leave mouse on map sector object
function overMapSector(sectorId) {
    var sector = document.getElementsByClassName('map-class-sector-' + sectorId);
    if (sector.length > 0) {
        sector[0].classList.add('hovered-sector');
    }
}

function leaveMapSector(sectorId) {
    var sector = document.getElementsByClassName('map-class-sector-' + sectorId);
    if (sector.length > 0) {
        sector[0].classList.remove('hovered-sector');
    }
}

function leaveAllMapSectors() {
    var mapSectors = document.getElementsByClassName('sector-map-area');
    for (var mapSector of mapSectors) {
        mapSector.classList.remove('hovered-sector');
    }
}

function activeMapSector(sectorId) {
    var sector = document.getElementsByClassName('map-class-sector-' + sectorId);
    unActiveAllMapSector();
    if (sector.length > 0) {
        sector[0].classList.add('active-sector');
    }
}

function unActiveAllMapSector() {
    var mapSectors = document.getElementsByClassName('sector-map-area');
    for (var mapSector of mapSectors) {
        mapSector.classList.remove('active-sector');
    }
}

// Over and leave mouse on map line object
function overMapLine(routeId) {
    var route = document.getElementsByClassName('map-class-line-' + routeId);
    if (route.length > 0) {
        route[0].classList.add('hovered-line');
        route[0].classList.add('visible-line');
    }
}

function overMapLineInOpenerTeb(routeId) {
    var lines = document.getElementsByClassName('route-map-line');
    for(var line of lines) {
        if (line.classList.contains('map-class-line-' + routeId)) {
            line.classList.add('hovered-line');
            line.classList.add('visible-line');
        } else {
            line.classList.remove('visible-line');
        }
    }
}

function leaveMapLine(routeId) {
    var route = document.getElementsByClassName('map-class-line-' + routeId);
    if (route.length > 0) {
        route[0].classList.remove('hovered-line');
    }
}

function leaveAllMapLines() {
    var mapLines = document.getElementsByClassName('route-map-line');
    for (var mapLine of mapLines) {
        mapLine.classList.remove('hovered-line');
    }
}


function activeMapLine(lineId) {
    var line = document.getElementsByClassName('map-class-line-' + lineId);
    unActiveAllMapLine();
    if (line.length > 0) {
        line[0].classList.add('active-line');
    }
}

function unActiveAllMapLine() {
    var mapLines = document.getElementsByClassName('route-map-line');
    for (var mapLine of mapLines) {
        mapLine.classList.remove('active-line');
    }
}

function showMapSectorLines(sectorId) {
    var sectorLines = document.getElementsByClassName('line-in-sector-' + sectorId);
    for (var route of sectorLines) {
        route.classList.add('visible-line');
    }
}

function showMapLine(lineId) {
    var route = document.getElementsByClassName('map-class-line-' + lineId);
    if (route.length > 0) {
        route[0].classList.add('visible-line');
    }
}

function hiddenMapLine(lineId) {
    var route = document.getElementsByClassName('map-class-line-' + lineId);
    if (route.length > 0) {
        route[0].classList.remove('visible-line');
    }
}

function hiddenAllLines() {
    var mapLines = document.getElementsByClassName('route-map-line');
    for (var mapLine of mapLines) {
        mapLine.classList.remove('visible-line');
    }
}