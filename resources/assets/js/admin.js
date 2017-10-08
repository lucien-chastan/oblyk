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

//ELASTIC
function elasticWords() {
    axios.get('/elastic/words').then(function (response) {
        console.log(response);
        Materialize.toast('Words indexés', 4000);
    });
}

function elasticCrags() {
    axios.get('/elastic/crags').then(function (response) {
        console.log(response);
        Materialize.toast('Crags indexés', 4000);
    });
}

function elasticGyms() {
    axios.get('/elastic/gyms').then(function (response) {
        console.log(response);
        Materialize.toast('Salles indexés', 4000);
    });
}

function elasticHelps() {
    axios.get('/elastic/helps').then(function (response) {
        console.log(response);
        Materialize.toast('Aides indexés', 4000);
    });
}


function elasticMassives() {
    axios.get('/elastic/massives').then(function (response) {
        console.log(response);
        Materialize.toast('Massive indexés', 4000);
    });
}

function elasticRoutes() {
    axios.get('/elastic/routes').then(function (response) {
        console.log(response);
        Materialize.toast('Routes indexés', 4000);
    });
}

function elasticTopics() {
    axios.get('/elastic/topics').then(function (response) {
        console.log(response);
        Materialize.toast('Topics indexés', 4000);
    });
}

function elasticTopos() {
    axios.get('/elastic/topos').then(function (response) {
        console.log(response);
        Materialize.toast('Topos indexés', 4000);
    });
}

function elasticTopoPdfs() {
    axios.get('/elastic/topoPdfs').then(function (response) {
        console.log(response);
        Materialize.toast('TopoPdfs indexés', 4000);
    });
}

function elasticTopoWebs() {
    axios.get('/elastic/topoWebs').then(function (response) {
        console.log(response);
        Materialize.toast('TopoWebs indexés', 4000);
    });
}

function elasticUsers() {
    axios.get('/elastic/users').then(function (response) {
        console.log(response);
        Materialize.toast('Users indexés', 4000);
    });
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
