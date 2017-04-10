let map,
    marker_0000, marker_1000, marker_0100, marker_0010, marker_0001, marker_1111,
    marker_1100, marker_0110, marker_0011, marker_1001, marker_0101, marker_1010,
    marker_1110, marker_1101, marker_1011, marker_0111;

function loadMap() {

    map = L.map('map',{ zoomControl : false}).setView([46.927527, 2.871905], 5);

    //Marker simple
    marker_0000 = L.icon({iconUrl: '/img/marker-0000.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_1111 = L.icon({iconUrl: '/img/marker-1111.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_1000 = L.icon({iconUrl: '/img/marker-1000.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_0100 = L.icon({iconUrl: '/img/marker-0100.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_0010 = L.icon({iconUrl: '/img/marker-0010.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_0001 = L.icon({iconUrl: '/img/marker-0001.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});

    //Marker double
    marker_1100 = L.icon({iconUrl: '/img/marker-1100.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_0110 = L.icon({iconUrl: '/img/marker-0110.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_0011 = L.icon({iconUrl: '/img/marker-0011.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_1001 = L.icon({iconUrl: '/img/marker-1001.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_0101 = L.icon({iconUrl: '/img/marker-0101.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_1010 = L.icon({iconUrl: '/img/marker-1010.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});

    //marker triple
    marker_1110 = L.icon({iconUrl: '/img/marker-1110.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_1101 = L.icon({iconUrl: '/img/marker-1101.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_1011 = L.icon({iconUrl: '/img/marker-1011.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_0111 = L.icon({iconUrl: '/img/marker-0111.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});

    L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/outdoors-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib2JseWsiLCJhIjoiY2oxMGl1MDJvMDAzbzJycGd1MWl6NDBpYyJ9.CXlzqHwoaZ0LlxWjuaj7ag', { attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);
    L.control.zoom({position : 'bottomright'}).addTo(map);

}