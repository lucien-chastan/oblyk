let gymMap;

function initGymMap() {
    let map = document.getElementById('gym-map'),
        latCenter = parseFloat(document.getElementById('gymLat').value),
        lngCenter = parseFloat(document.getElementById('gymLng').value);

    gymMap = L.map('gym-map',{ zoomControl : true, center:[latCenter, lngCenter], zoom : 16, layers: [carte]});

    //ajout du controleur de tuile
    L.control.layers(baseMaps).addTo(gymMap);

    L.marker([latCenter,lngCenter]).addTo(gymMap);
}

function getGymPosts(){
    getPosts('Gym',document.getElementById('id-gym-actualite').value, document.getElementById('insert-posts-zone'));
}

function uploadGymLogo() {
    console.log('ok');
}

function closeManagerModal() {
    $('#modal').modal('close');
    setTimeout(function () {
        Materialize.toast('Votre demande a été envoyée<br>Nous vous répondrons dans les plus brefs délais', 3000);
    },1500);
}