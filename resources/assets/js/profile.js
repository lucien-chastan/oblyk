let chargedBox = 0,
    nbBox = 0,
    parnterSettingMap = null;

window.addEventListener('resize', function () {
    let flexDashBoxs = document.getElementById('flexDashBoxs');
    if (flexDashBoxs !== null) {
        dimDashboard();
    }
});

function activeMenu(element) {
    let navHeadItem = document.getElementsByClassName('collapsible-header'),
        navBodyItem = document.querySelectorAll('.collapsible-body .row');

    for (let i = 0; i < navHeadItem.length; i++) navHeadItem[i].setAttribute('class', navHeadItem[i].className.replace('active-item', ''))
    for (let i = 0; i < navBodyItem.length; i++) navBodyItem[i].setAttribute('class', navBodyItem[i].className.replace('active-item', ''))

    element.setAttribute('class', element.className + ' active-item');
}

function loadDashBoxs() {
    let targetBoxs = document.getElementsByClassName('target-box'),
        refreshTargetBox = document.getElementsByClassName('refresh-target-box'),
        flexDashBoxs = document.getElementById('flexDashBoxs');

    flexDashBoxs.style.height = 'auto';
    chargedBox = 0;
    nbBox = targetBoxs.length;

    for (let i = 0; i < targetBoxs.length; i++) {
        let route = targetBoxs[i].getAttribute('data-sub-route');
        loadBox(route, targetBoxs[i]);
        refreshTargetBox[i].addEventListener('click', () => {
            refreshBox(route, targetBoxs[i]);
        });
    }
}

function loadBox(target, element) {
    axios.get(target).then(function (response) {
        chargedBox++;
        element.innerHTML = response.data;
        element.style.height = 'auto';
        if (nbBox === chargedBox) dimDashboard();
    });
}

function refreshBox(route, element) {
    element.style.height = element.offsetHeight + 'px';
    element.innerHTML = '<div class="text-center"><div class="preloader-wrapper small active"> <div class="spinner-layer spinner-blue-only"> <div class="circle-clipper left"><div class="circle"></div> </div><div class="gap-patch"><div class="circle"></div> </div><div class="circle-clipper right"> <div class="circle"></div></div></div></div></div>';
    setTimeout(function () {
        loadBox(route, element);
    }, 300);
}

function dimDashboard() {
    setTimeout(function () {
        let largeur_ecran = windowWidth(),
            flexDashBoxs = document.getElementById('flexDashBoxs');

        if (largeur_ecran > 1000) {
            let targetBoxs = document.getElementsByClassName('dashbox'),
                somme = 0,
                additionnel = 20,
                newSomme = 0,
                goodHeight = 0,
                trouver = false;

            for (let i = 0; i < targetBoxs.length; i++) somme += targetBoxs[i].offsetHeight + additionnel;

            for (let i = 0; i < targetBoxs.length; i++) {
                newSomme += targetBoxs[i].offsetHeight + additionnel;
                if (newSomme > somme / 2 && trouver === false) {
                    goodHeight = newSomme;
                    trouver = true;
                }
            }

            flexDashBoxs.style.height = (goodHeight + 50) + 'px';

        } else {
            flexDashBoxs.style.height = 'auto';
        }
    }, 500);
}

function majSettingsDashboard() {
    Materialize.toast('Les paramètres du dashboard ont été mis à jour', 4000);
    showSubmitLoader(false, document.getElementById('form-dashboard-setting'));
}

function majSettingsCompte() {
    Materialize.toast('Votre compte a été mis à jour', 4000);
    showSubmitLoader(false, document.getElementById('form-compte-setting'));
}

function majSettingsEmail() {
    Materialize.toast('Vos options de connexion ont étées mise à jour', 4000);
    showSubmitLoader(false, document.getElementById('form-password-setting'));
}

function majSettingsMessagerie() {
    Materialize.toast('Vos options de messagerie ont étées mis à jour', 4000);
    showSubmitLoader(false, document.getElementById('form-messagerie-setting'));
}

function majSettingsConfidentialite() {
    Materialize.toast('Vos options de confidentialités ont étées mis à jour', 4000);
    showSubmitLoader(false, document.getElementById('form-confidentialite-setting'));
}

function openAlbum(route) {
    let target = document.getElementById('user-content');
    axios.get(route).then(function (response) {
        target.innerHTML = response.data;
    });
}

function showChangeMdp() {
    let zoneMdp = document.getElementById('zone-change-mdp');

    if (zoneMdp.getAttribute('data-visible') === 'true') {
        zoneMdp.setAttribute('data-visible', 'false');
        zoneMdp.style.display = 'none';
    } else {
        zoneMdp.setAttribute('data-visible', 'true');
        zoneMdp.style.display = 'block';
    }
}

function uploadBandeau() {
    let form = document.getElementById('form-upload-photo-bandeau-setting'),
        inputData = form.getElementsByClassName('input-data'),
        data = new FormData();

    data.append('foo', 'bar');
    data.append('bandeau', document.getElementById('upload-photo-bandeau').files[0]);

    // Add form data
    for (let i in inputData) {
        if (typeof inputData[i].value !== "undefined") data.append([inputData[i].name], inputData[i].value);
    }

    let config = {
        onUploadProgress: function (progressEvent) {
            let percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
            document.getElementById('progressbar-upload-photo-bandeau').style.width = percentCompleted + '%';
        }
    };

    axios.post('/upload/userBandeau', data, config).then(
        function () {
            reloadCurrentVue();
        }
    ).catch(
        function (err) {

            if (err.response.status === 422) {
                let errorArray = [];

                // Loop on errors
                for (let key in err.response.data) {
                    errorArray.push(err.response.data[key]);
                }

                // Concat errors
                let textError = errorArray.join('<br>');
                submitFilter();

                // Display errors
                alert(textError);
            } else {
                alert('Erreur ' + err.response.status);
            }

            document.getElementById('progressbar-upload-photo-bandeau').style.width = '0%';
        }
    );
}


function uploadImageProfile() {
    let form = document.getElementById('form-upload-photo-profil-setting'),
        inputData = form.getElementsByClassName('input-data'),
        data = new FormData();

    data.append('foo', 'bar');
    data.append('photo', document.getElementById('upload-photo-profil').files[0]);

    // Add form data
    for (let i in inputData) {
        if (typeof inputData[i].value !== "undefined") data.append([inputData[i].name], inputData[i].value);
    }

    let config = {
        onUploadProgress: function (progressEvent) {
            let percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
            document.getElementById('progressbar-upload-photo-profil').style.width = percentCompleted + '%';
        }
    };

    axios.post('/upload/userPhotoProfile', data, config).then(
        function () {
            reloadCurrentVue();
        }
    ).catch(
        function (err) {
            if (err.response.status === 422) {
                let errorArray = [];

                // Loop on errors
                for (let key in err.response.data) {
                    errorArray.push(err.response.data[key]);
                }

                // Concat errors
                let textError = errorArray.join('<br>');

                // Display errors
                alert(textError);
            } else {
                alert('Erreur ' + err.response.status);
            }

            document.getElementById('progressbar-upload-photo-profil').style.width = '0%';
        }
    );
}

// Post view
function vuePost(post_id) {
    let innerTarget = document.getElementById('user-content'),
        itemNav = document.getElementById('item-fil-actu-menu');

    showUserLoader(true);

    axios.post('/post/vueOnePost', {id: post_id}).then(function (response) {
        innerTarget.innerHTML = response.data;

        location.href = '#fil-actu';

        // Post load action
        afterLoad();

        currentVue = itemNav;

        activeMenu(itemNav);

        // Hide loader
        showUserLoader(false);
    });

}

function getMyActuality() {
    getPosts(
        'User',
        document.getElementById('id-user-actualite').value,
        document.getElementById('insert-posts-zone'),
        '/user/actuality'
    );
}

function vueTopic(topic_id) {
    location.href = '/forum-escalade/' + topic_id + '/sujet';
}

function vueProfile(profil_id) {
    location.href = '/grimpeur/' + profil_id + '/profil';
}

function goToRoute(route) {
    location.href = route;
}

function changeRelation(user_id, relation_status) {
    axios.post('/user/relation', {user_id: user_id, relation_status: relation_status}).then(function () {

        // Display message
        if (relation_status === 0) Materialize.toast('Demande envoyée !', 4000);
        if (relation_status === 1) Materialize.toast('Demande annulée', 4000);
        if (relation_status === 2) Materialize.toast('Vous êtes désormais amis', 4000);
        if (relation_status === 3) Materialize.toast('Vous n\'êtes plus amis', 4000);

        // Reload views
        reloadCurrentVue();

    });
}

function activePartner(active = true) {
    axios.post('/partner/active', {active: active}).then(function (response) {
        Materialize.toast(response.data, 4000);
        reloadCurrentVue();
    })
}

function activeLieu(switchbox) {
    let active = switchbox.checked === true,
        place_id = switchbox.value;

    axios.post('/partner/place/active', {active: active, place_id: place_id}).then(function (response) {
        Materialize.toast(response.data, 4000);
        initPartnerSettingMap();
    });
}

function initPartnerSettingMap() {
    if (document.getElementById('placeSettingMap') == null) return true;

    setTimeout(function () {
        let latLngPolyline = [];

        if (parnterSettingMap !== null) {
            parnterSettingMap.remove();
            parnterSettingMap = null;
        }

        parnterSettingMap = L.map('placeSettingMap', {
            zoomControl: true,
            center: [46.5, 4.5],
            zoom: 5,
            layers: [carte]
        });

        // Map controller
        L.control.layers(baseMaps).addTo(parnterSettingMap);

        axios.post('/partner/setting-map').then(function (response) {
            let places = response.data[0];

            // Add marker in the map
            for (let i in places) {

                // Add circles area
                L.circle([places[i].lat, places[i].lng], {
                    radius: places[i].rayon * 1000,
                    fill: false,
                    color: '#2196F3'
                }).addTo(parnterSettingMap);

                // Polyline for center map
                latLngPolyline.push([places[i].lat, places[i].lng])
            }

            let polyline = L.polyline(latLngPolyline, {color: 'rgba(255,255,255,0'}).addTo(parnterSettingMap);

            // Zoom the map to the polyline
            parnterSettingMap.fitBounds(polyline.getBounds());

            // Delete center polyline
            polyline.remove();

        });
    }, 500);
}

function majPartnerSettings() {
    location.href = '/partenaire-escalade/carte-des-grimpeurs';
}
