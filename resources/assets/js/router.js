let loadedTab = [];

//LIE LES ONCLICKS SUR LES LIENS QUI MÈNE AUX VUES
window.addEventListener('load', function () {
    let routerTab = document.getElementsByClassName('router-link');
    for(let i = 0 ; i < routerTab.length ; i++){
        loadedTab[routerTab[i].getAttribute('href')] = false;
        routerTab[i].addEventListener('click', loadTab);
    }
});

//CHARGE LE CONTENU DE LA VUE DANS L'ONGLET CORRESPONDANT
function loadTab() {
    let tab = this;
    location.href = tab.href;

    if(!loadedTab[tab.getAttribute('href')]){
        loadedTab[tab.getAttribute('href')] = true;

        let route = tab.getAttribute('data-route'),
            target = document.getElementById(tab.getAttribute('href').replace('#',''));

        axios.get(route).then(function (response) {target.innerHTML = response.data;});
    }
}