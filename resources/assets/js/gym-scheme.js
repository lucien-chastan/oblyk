let scheme;

function initSchemeGymMap(gym_id) {
    let shemeUrl = '/storage/gyms/schemes/scheme-1.png',
        heightScheme = 22,
        widthScheme = 80,
        mapBounds = [[0, 0], [heightScheme, widthScheme]];

    scheme = L.map('gym-scheme',{ zoomControl : false});
    L.control.zoom({position : 'topright'}).addTo(scheme);
    L.imageOverlay (
        shemeUrl,
        mapBounds,
        {
            alt : 'Plan de la salle de M\'roc',
            attribution : '<a href="https://www.mroc3.com/">M\'roc Laennec</a>'
        }
    ).addTo(scheme);

    scheme.fitBounds([[0, 0],[heightScheme, widthScheme]]);

    loadGymSector(gym_id);
}

function loadGymSector(gym_id) {
    axios.get('/API/gyms/get-sectors/' + gym_id).then(function (response) {
        console.log(response);
    });
}