var editionSectorId = null, newArea = null, editionRouteId = null, newRouteLine = null;

function showSaveBtn(status = true, editionType = 'sector') {
    var btnArea = document.getElementById('edit-btn-sector'),
        startBtns = document.getElementsByClassName('start-edition-btn'),
        btnSave = document.getElementById('btn-save-edition-scheme'),
        btnCancel = document.getElementById('btn-cancel-edition-scheme'),
        btnDelete = document.getElementById('btn-delete-edition-scheme');

    if (editionType === 'sector') {
        btnSave.removeEventListener('click', endEditRouteLine);
        btnSave.addEventListener('click', endEditSector);
        btnCancel.removeEventListener('click', reloadRoutes);
        btnCancel.addEventListener('click', reloadSectors);
        btnDelete.removeEventListener('click', deleteRouteLine);
        btnDelete.addEventListener('click', deleteSectorArea);
    } else {
        btnSave.removeEventListener('click', endEditSector);
        btnSave.addEventListener('click', endEditRouteLine);
        btnCancel.removeEventListener('click', reloadSectors);
        btnCancel.addEventListener('click', reloadRoutes);
        btnDelete.removeEventListener('click', deleteSectorArea);
        btnDelete.addEventListener('click', deleteRouteLine);
    }

    if (status) {
        btnArea.classList.remove('hide');
        for (let btn of startBtns) {
            btn.classList.add('hide');
        }
    } else {
        btnArea.classList.add('hide');
        for (let btn of startBtns) {
            btn.classList.remove('hide');
        }
    }
}

// Draw sector area
function startNewSector() {
    inEdition = true;
    editionSectorId = current_sector_id;
    scheme.editTools.startPolygon();
    showSaveBtn();
}

function startEditSector() {
    if (!inEdition) {
        var sector = sectors[current_sector_id];
        sector.enableEdit();
        inEdition = true;
        editionSectorId = current_sector_id;
        showSaveBtn();
    } else if (editionSectorId !== null) {
        endEditSector();
    }
}

function endEditSector(save = true) {
    var latLngs = [],
        reloadAfterEdit = false;

    if (newArea != null) {
        sectors[editionSectorId] = newArea;
        newArea = null;
        reloadAfterEdit = true;
    }

    var sector = sectors[editionSectorId];

    sector.disableEdit();
    for (var latLng of sector.getLatLngs()[0]) {
        latLngs.push(`[${latLng.lat},${latLng.lng}]`);
    }
    if (save) saveSectorArea(editionSectorId, `[${latLngs.join(',')}]`, reloadAfterEdit);
    inEdition = false;
    editionSectorId = null;
    showSaveBtn(false);
}

function saveSectorArea(sectorId, area, reload = false) {
    axios.put(`/admin/${GlobalGymId}/sector/${sectorId}/save-area`, {area: area}).then(function () {
        Materialize.toast('Zone enregistrée', 4000);
        if (reload) location.reload();
    });
}

function deleteSectorArea() {
    axios.put(`/admin/${GlobalGymId}/sector/${current_sector_id}/delete-area`).then(function () {
        Materialize.toast('Tracé de la zone supprimé', 4000);
        location.reload();
    });
}

// Draw route line
function startNewRouteLine() {
    inEdition = true;
    editionRouteId = current_route_id;
    scheme.editTools.startPolyline();
    showSaveBtn(true, 'route');
}

function startEditRoute() {
    if (!inEdition) {
        var route = routeLines[current_route_id];
        route.enableEdit();
        inEdition = true;
        editionRouteId = current_route_id;
        showSaveBtn(true, 'route');
    } else if (editionRouteId !== null) {
        endEditRouteLine();
    }
}

function endEditRouteLine(save = true) {
    var latLngs = [],
        reloadAfterEdit = false;

    if (newRouteLine != null) {
        routeLines[editionRouteId] = newRouteLine;
        newRouteLine = null;
        reloadAfterEdit = true;
    }

    var route = routeLines[editionRouteId];

    console.log('routeLine : ' + routeLines);
    console.log('editionRouteId : ' + editionRouteId);
    console.log('newRouteLine : ' +  newRouteLine);
    console.log(route.getLatLngs());

    route.disableEdit();
    for (var latLng of route.getLatLngs()) {
        latLngs.push(`[${latLng.lat},${latLng.lng}]`);
    }
    if (save) saveRouteLine(editionRouteId, `[${latLngs.join(',')}]`, reloadAfterEdit);
    inEdition = false;
    editionRouteId = null;
    showSaveBtn(false);
}

function saveRouteLine(routeId, line, reload = false) {
    axios.put(`/admin/${GlobalGymId}/route/${routeId}/save-line`, {line: line}).then(function () {
        Materialize.toast('Ligne enregistrée', 4000);
        if (reload) location.reload();
    });
}

function deleteRouteLine() {
    axios.put(`/admin/${GlobalGymId}/route/${current_route_id}/delete-line`).then(function () {
        Materialize.toast('Tracé de la ligne supprimé', 4000);
        location.reload();
    });
}


// Reload functions after edition
function reloadSectors() {
    endEditSector(false);
    sectors.forEach(function (sector) {
        sector.remove();
    });
    sectors = [];
    getJsonGymSector(GlobalRoomId);
}

function reloadRoutes() {
    endEditRouteLine(false);
    routes.forEach(function (route) {
        route.remove();
    });
    routes = [];
    getJsonGymRoute(GlobalRoomId);
}

// Other function for dismount or add on favorite
function dismountRoute(routeId) {
    axios.put('/gym/dismount-route/' + routeId).then(function (response) {
        var data = JSON.parse(response.data);
        if (data.dismounted_at !== null) {
            Materialize.toast('Ligne démontée', 4000);
        } else {
            Materialize.toast('Ligne remontée', 4000);
        }
        reloadRouteVue();
    });
}

function favoriteRoute(routeId) {
    axios.put('/gym/favorite-route/' + routeId).then(function (response) {
        var data = JSON.parse(response.data);
        if (data.favorite) {
            Materialize.toast('Ligne favoris', 4000);
        } else {
            Materialize.toast('Favoris retiré', 4000);
        }
        reloadRouteVue();
    });
}

function deleteRoutePicture(routeId) {
    if(confirm('Êtes-vous sûr de supprimer la photo de cette ligne ?')) {
        axios.delete('/gym/route/' + routeId + '/photo-delete').then(function () {
            Materialize.toast('Photo supprimée', 4000);
            reloadRouteVue();
        });
    }
}

function deleteSectorPicture(sectorId) {
    if(confirm('Êtes-vous sûr de supprimer la photo de ce secteur ?')) {
        axios.delete('/gym/sector/' + sectorId + '/photo-delete').then(function () {
            Materialize.toast('Photo supprimée', 4000);
            reloadGymSectorVue();
        });
    }
}