var nav_barre = document.getElementById('nav_barre'), collapseTable = [];
nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));

function getRoute() {
    let route_id = document.getElementById('route_id').value,
        informationZone = document.getElementById('insert-route-information');

    axios.get('/get/route/' + route_id + '/information').then(function (response) {
        informationZone.innerHTML = response.data;
    });
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