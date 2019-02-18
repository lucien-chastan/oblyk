var collectionStatus = false;

(function () {
    var body = document.getElementsByTagName('body'),
        galleryImage = document.getElementById('gallery-image'),
        photoLinks = document.querySelectorAll('[data-photo-url]');

    body[0].addEventListener('keypress', galleryKeyPress);
    galleryImage.addEventListener('click', galleryZoom);

    for (var i = 0; i < photoLinks.length; i++) {
        photoLinks[i].addEventListener('click', goToPhoto);
    }

    galleryMap();

    swipedetect(document.getElementById('slider-gallery'), function (swipedir) {
        if (swipedir === 'left') swipePhoto('right');
        if (swipedir === 'right') swipePhoto('left');
    });
})();

function galleryZoom() {
    var image = document.getElementById('gallery-image'),
        zoomButton = document.getElementById('zoom-button');

    if (image.classList.contains('adjusted')) {
        image.classList.remove('adjusted');
        image.classList.add('full-size');
        zoomButton.textContent = 'zoom_out';
    } else {
        image.classList.remove('full-size');
        image.classList.add('adjusted');
        zoomButton.textContent = 'zoom_in';
    }
}

function galleryKeyPress(event) {
    if (event.keyCode === 37) swipePhoto('left');
    if (event.keyCode === 39) swipePhoto('right');
    if (event.keyCode === 40 && !collectionStatus) openCollection();
    if (event.keyCode === 38 && collectionStatus) openCollection();
    if (event.key === 'i') $('.button-collapse').first().sideNav('show');
}

function swipePhoto(direction) {
    var link;

    if (direction === 'left') link = document.getElementById('previous-photo');
    if (direction === 'right') link = document.getElementById('next-photo');

    if (link !== 'undefined' && link !== null) {
        loadGallery(true);
        document.location.replace(link.getAttribute('data-photo-url'));
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

    if (load) {
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

    var map = L.map('gallery-map', {zoomControl: false, center: [lat, lng], zoom: zoom, layers: [carte]});
    L.marker(
        [lat, lng],
        {
            icon: marker_10000,
            interactive: false
        }
    ).addTo(map);
}

function openCollection() {
    var slider = document.getElementById('image-gallery-area'),
        collection = document.getElementById('collection-gallery'),
        button = document.getElementById('collection-button');

    if (!collectionStatus) {
        slider.style.display = 'none';
        collection.style.display = 'block';
        button.textContent = 'photo';
        button.style.top = '5px';
    } else {
        slider.style.display = 'block';
        collection.style.display = 'none';
        button.textContent = 'collections';
        button.style.top = '75px';
    }

    collectionStatus = !collectionStatus;
}
