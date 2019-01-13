var indoorPaintedCharts = [];

function getIndoorCharts() {
    let indoorCanvas = document.getElementsByClassName('route-indoor-crosses-canvas');

    setTimeout(function () {
        for (let i = 0; i < indoorCanvas.length; i++) {
            let route = indoorCanvas[i].getAttribute('data-route'),
                element = indoorCanvas[i];
            if (indoorPaintedCharts[element.id] !== true) indoorCrossesChart(route, element);
        }
    }, 300);
}

function indoorCrossesChart(route, element) {
    axios.post(route).then(function (response) {
        indoorPaintedCharts[element.id] = true;
        new Chart(
            element.getContext('2d'),
            response.data
        );
    });
}