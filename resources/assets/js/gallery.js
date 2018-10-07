(function () {
    var body = document.getElementsByTagName('body'),
        galleryImage = document.getElementById('gallery-image'),
        photoLinks = document.querySelectorAll('[data-photo-url]');

    body[0].addEventListener('keypress', galleryKeyPress);
    galleryImage.addEventListener('click', galleryZoom);

    for(var i = 0 ; i < photoLinks.length ; i++) {
        photoLinks[i].addEventListener('click', goToPhoto);
    }

    galleryMap();
})();

function galleryZoom() {
    var image  = document.getElementById('gallery-image');

    if(image.classList.contains('adjusted')) {
        image.classList.remove('adjusted');
        image.classList.add('full-size');
    } else {
        image.classList.remove('full-size');
        image.classList.add('adjusted');
    }
}

function galleryKeyPress(event) {
    var link;

    if(event.key === 'ArrowLeft') {
        link = document.getElementById('previous-photo');
    }

    if(event.key === 'ArrowRight') {
        link = document.getElementById('next-photo');
    }

    if(event.key === 'ArrowLeft' || event.key === 'ArrowRight') {
        if(link !== 'undefined' && link !== null) {
            loadGallery(true);
            document.location.replace(link.getAttribute('data-photo-url'));
        }
    }

    if(event.key === 'i') {
        $('.button-collapse').first().sideNav('show');
    }

    if(event.key === 'c') {
        $('.button-collapse').last().sideNav('show');
    }

    if(event.key === ' ') {
        galleryZoom();
    }
}

function goToPhoto() {
    var url = this.getAttribute('data-photo-url');
    loadGallery(true);
    document.location.replace(url);
}

function loadGallery(load) {
    var loader = document.getElementById('preloader-gallery'),
        closeButton = document.getElementById('close-gallery');

    if(load) {
        loader.style.display = 'block';
        closeButton.style.display = 'none';
    } else {
        loader.style.display = 'none';
        closeButton.style.display = 'block';
    }
}

function closeGallery() {
    history.back();
}

function galleryMap() {
    var lat = parseFloat(document.getElementById('photo-lat').value),
        lng = parseFloat(document.getElementById('photo-lng').value),
        zoom = 10;

    var map = L.map('gallery-map',{ zoomControl : false, center:[lat, lng], zoom : zoom, layers: [carte]});
    L.marker(
        [lat,lng],
        {
            icon: marker_10000,
            interactive: false
        }
    ).addTo(map);
}