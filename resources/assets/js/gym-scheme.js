let scheme, timeToLoad;

window.addEventListener('load', function () {
    openVoletSectors(true);
});

function initSchemeGymMap() {
    let mapArea = document.getElementById('gym-scheme'),
        nav_barre = document.getElementById('nav_barre'),
        nav_link = nav_barre.getElementsByTagName('a'),
        heightScheme = 0,
        widthScheme = 0,
        data = {
            'room_id':mapArea.getAttribute('data-room-id'),
            'gym_id':mapArea.getAttribute('data-gym-id'),
            'gym_label':mapArea.getAttribute('data-gym-label'),
            'gym_url':mapArea.getAttribute('data-gym-url'),
            'banner_color':mapArea.getAttribute('data-banner-color'),
            'banner_bg_color':mapArea.getAttribute('data-banner-bg-color'),
            'scheme_bg_color':mapArea.getAttribute('data-scheme-bg-color'),
            'scheme_height':parseInt(mapArea.getAttribute('data-scheme-height')),
            'scheme_width':parseInt(mapArea.getAttribute('data-scheme-width')),
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

    scheme = L.map('gym-scheme',{ zoomControl : false});
    L.control.zoom({position : 'topright'}).addTo(scheme);
    L.imageOverlay (
        shemeUrl,
        mapBounds,
        {
            alt : 'Plan de la salle ' + data.gym_label,
            attribution : '<a href="' + data.gym_url + '">' + data.gym_label + '</a>'
        }
    ).addTo(scheme);

    scheme.fitBounds([[0, 0],[heightScheme, widthScheme]]);
    scheme.on('click',function (e) {
        console.log('[' + Math.round(e['latlng']['lat'],2) + ',' + Math.round(e['latlng']['lng'],2) + ']');
    });

    getJsonGymSector(data.room_id);
}

function getJsonGymSector(room_id) {
    axios.get('/API/gyms/get-sectors/' + room_id).then(function (response) {

        for(var i = 0 ; i < response.data.sectors.length; i++) {
            var sector = response.data.sectors[i];
            var polygon = L.polygon(JSON.parse(sector.area), {color: 'red'}).addTo(scheme);
        }
    });
}

// OUVRE OU FERME LE VOLET LATÉRAL
function openVoletSectors(open) {
    let volet = document.getElementById('side-map-gym-scheme');

    if (open){
        volet.style.transform = 'translateX(0)';
    }else{
        volet.style.transform = 'translateX(-100%)';
    }
}

// LOAD ROOM SECTORS
function getSectors(room_id) {
    var content = document.getElementById('content-side-map-gym-scheme'),
        item2 = document.getElementById('item-nav-2'),
        item3 = document.getElementById('item-nav-3');

    sideNavLoader(false);

    axios.get('/salle-escalade/topo/sectors/' + room_id).then(function (response) {
        sweetDisappearance(false,item2);
        sweetDisappearance(false,item3);
        content.innerHTML = response.data;
        sideNavLoader(true);
    });
}

// LOAD SECTOR
function getGymSector(sector_id, sector_label) {
    var content = document.getElementById('content-side-map-gym-scheme'),
        item2 = document.getElementById('item-nav-2'),
        item3 = document.getElementById('item-nav-3');

    sideNavLoader(false);

    axios.get('/salle-escalade/topo/sector/' + sector_id).then(function (response) {
        sweetDisappearance(true,item2);
        sweetDisappearance(false,item3);
        sideNavLoader(true);
        item2.textContent = sector_label;
        content.innerHTML = response.data;

        item2.onclick = function () {
            getGymSector(sector_id, sector_label);
            animationLoadSideNav('l');
        };
    });
}

// LOAD ROUTE
function getGymRoute(route_id, route_label) {
    var content = document.getElementById('content-side-map-gym-scheme'),
        item3 = document.getElementById('item-nav-3');

    sideNavLoader(false);

    axios.get('/salle-escalade/topo/route/' + route_id).then(function (response) {
        sweetDisappearance(true,item3);
        item3.textContent = route_label;
        content.innerHTML = response.data;
        sideNavLoader(true);
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
        }, 100);
    }, 100);
}

function rightLeftAnimation(direction, element) {
    if(direction === 'r') {
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