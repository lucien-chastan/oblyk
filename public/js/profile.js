let chargedBox = 0,
    nbBox = 0;

function activeMenu(element) {
    let navHeadItem = document.getElementsByClassName('collapsible-header'),
        navBodyItem = document.querySelectorAll('.collapsible-body .row');

    for(let i = 0 ; i < navHeadItem.length ; i++) navHeadItem[i].setAttribute('class', navHeadItem[i].className.replace('active-item', ''))
    for(let i = 0 ; i < navBodyItem.length ; i++) navBodyItem[i].setAttribute('class', navBodyItem[i].className.replace('active-item', ''))

    element.setAttribute('class', element.className + ' active-item');
}

function loadDashBoxs() {
    let targetBoxs = document.getElementsByClassName('target-box'),
        flexDashBoxs = document.getElementById('flexDashBoxs');

    flexDashBoxs.style.height = 'auto';
    chargedBox = 0;
    nbBox = targetBoxs.length;

    for(let i = 0 ; i < targetBoxs.length ; i++){
        let route = targetBoxs[i].getAttribute('data-sub-route');
        loadBox(route,targetBoxs[i]);
    }
}

function loadBox(target, element) {
    axios.get(target).then(function (response) {
        chargedBox++;
        element.innerHTML = response.data;
        if(nbBox === chargedBox) dimDashboard();
    });
}

function dimDashboard() {
    setTimeout(function () {
        let targetBoxs = document.getElementsByClassName('target-box'),
            flexDashBoxs = document.getElementById('flexDashBoxs'),
            somme = 0;

        for(let i = 0 ; i < targetBoxs.length ; i++){
            console.log(targetBoxs[i].offsetHeight);
            somme += targetBoxs[i].offsetHeight + 200;
        }

        flexDashBoxs.style.height = (somme / 2) + 'px';
    },100);
}
