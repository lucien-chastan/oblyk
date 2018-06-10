let scheme;

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

    // loadGymSector(data.gym_id);
}

function loadGymSector(gym_id) {
    axios.get('/API/gyms/get-sectors/' + gym_id).then(function (response) {
        console.log(response);
    });
}