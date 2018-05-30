var nav_barre = document.getElementById('nav_barre'), collapseTable = [];
nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));


//VA CHERCHER LES INFORMATIONS D'UNE ROUTE
function getRoute() {
    let route_id = document.getElementById('route_id').value,
        informationZone = document.getElementById('insert-route-information');

    axios.get('/get/route/' + route_id + '/information').then(function (response) {
        informationZone.innerHTML = response.data;
    });
}


//VA CHERCHER LES INFORMATIONS D'UN ARTICLE
function getArticle() {
    let article_id = document.getElementById('article_id').value,
        informationZone = document.getElementById('insertArticle');

    axios.get('/get/article/' + article_id + '/information').then(function (response) {
        informationZone.innerHTML = response.data;
    });
}

function articleUpdated() {
    showSubmitLoader(false, document.getElementById('formUpdateArticle'));
    Materialize.toast('Article mis à jour', 4000);
}


function collapseArea(area_id, element) {
    let area = document.getElementById(area_id),
        indicator = element.getElementsByTagName('span')[0];

    if(collapseTable[area_id] === false){
        area.style.display = 'block';
        collapseTable[area_id] = true;
        indicator.textContent = '+';
    }else{
        area.style.display = 'none';
        collapseTable[area_id] = false;
        indicator.textContent = '-';
    }
}


// GET NEWSLETTER INFORMATION
function getNewsletter() {
    let ref = document.getElementById('newsletter_ref').value,
        informationZone = document.getElementById('insertNewsletter');

    axios.get('/get/newsletter/' + ref + '/information').then(function (response) {
        informationZone.innerHTML = response.data;
    });
}

function newsletterUpdated() {
    showSubmitLoader(false, document.getElementById('formUpdateNewsletter'));
    Materialize.toast('newsletter mise à jour', 4000);
}


//VA CHERCHER LES INFORMATIONS D'UNE AIDES
function getHelp() {
    let help_id = document.getElementById('help_id').value,
        informationZone = document.getElementById('insertHelp');

    axios.get('/get/aide/' + help_id + '/information').then(function (response) {
        informationZone.innerHTML = response.data;
    });
}

function helpUpdated() {
    showSubmitLoader(false, document.getElementById('formUpdateHelp'));
    Materialize.toast('Aide mis à jour', 4000);
}

function deleteHelp() {
    let help_id = document.getElementById('help_id').value;

    axios.delete('/helps/' + help_id).then(function () {
        Materialize.toast('Aide supprimée', 4000);
    });
}

//VA CHERCHER LES INFORMATIONS D'UNE EXVEPTION
function getException() {
    let exception_id = document.getElementById('exception_id').value,
        informationZone = document.getElementById('insertException');

    axios.get('/get/exception/' + exception_id + '/information').then(function (response) {
        informationZone.innerHTML = response.data;

        $('select').material_select();

    });
}

function exceptionUpdated() {
    showSubmitLoader(false, document.getElementById('formUpdateException'));
    Materialize.toast('Exception mis à jour', 4000);
}

function deleteException() {
    let exception_id = document.getElementById('exception_id').value;

    axios.delete('/exceptions/' + exception_id).then(function () {
        Materialize.toast('Exception supprimée', 4000);
    });
}

//VA CHERCHER LES INFORMATIONS D'UNE ROUTE
function getSector() {
    let sector_id = document.getElementById('sector_id').value,
        informationZone = document.getElementById('insert-sector-information');

    axios.get('/get/sector/' + sector_id + '/information').then(function (response) {
        informationZone.innerHTML = response.data;
    });
}
