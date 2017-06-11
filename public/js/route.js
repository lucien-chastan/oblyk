let loadedRouteTab = [];

//charge la structure d'une ligne
function loadRoute(id_route) {
    let route = '/vue/route/' + id_route + '/route',
        target = document.getElementById('slide-route'),
        callback = null;

    loadedRouteTab = [];

    ajaxRouter(route, target, callback);
}

//charge un onglet
function loadTabRoute(id_route, tab, callback) {
    if(!loadedRouteTab[tab]){
        loadedRouteTab[tab] = true;

        let route = '/vue/route/' + id_route + '/' + tab,
            target = document.getElementById('route-tab-' + tab);

        axios.get(route).then(function (response) {
            target.innerHTML = response.data;
            if(callback !== null) callFunction(callback, window);
        });

    }
}

function reloadRouteInformationTab() {
    let route_id = document.getElementById('info-route-id');
    closeModal();
    loadTabRoute(route_id.value, 'information', null);
    return false;
}