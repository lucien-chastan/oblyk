var editionSectorId = null, newArea = null;

function startNewSector(sectorId) {
    inEdition = true;
    editionSectorId = sectorId;
    scheme.editTools.startPolygon();
    showSaveBtn();
}

function startEditSector(sectorId) {
    if (!inEdition) {
        var sector = sectors[sectorId];
        sector.enableEdit();
        inEdition = true;
        editionSectorId = sectorId;
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
    axios.put(`/admin/${GlobalGymId}/sector/${sectorId}/save-area`, {area : area}).then(function () {
        Materialize.toast('Zone enregistrée');
        if (reload) location.reload();
    });
}

function showSaveBtn(status = true) {
    var btnArea = document.getElementById('edit-btn-sector'),
        startBtns = document.getElementsByClassName('start-edition-btn');

    if(status) {
        btnArea.classList.remove('hide');
        for (let btn of startBtns ) {
            btn.classList.add('hide');
        }
    } else {
        btnArea.classList.add('hide');
        for (let btn of startBtns ) {
            btn.classList.remove('hide');
        }
    }
}

function relaodSectors() {
    endEditSector(false);
    sectors.forEach(function (sector) {
        sector.remove();
    });
    sectors = [];
    getJsonGymSector(GlobalRoomId);
}