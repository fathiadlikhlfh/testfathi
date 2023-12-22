const map = L.map('map').setView([-6.920824578557899, 107.63903303282905], 10.5);
  
const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

const marker = L.marker([-6.920824578557899, 107.63903303282905]).addTo(map)
  .bindPopup('<b>Hello fathi!</b><br />I am a popup.');


const popup = L.popup()
  .setLatLng([-6.920824578557899, 107.63903303282905])
  .setContent('I am a standalone popup.');

function onMapClick(e) {
  popup
    .setLatLng(e.latlng)
    .setContent(`You clicked the map at ${e.latlng.toString()}`)
    .openOn(map);
}

map.on('click', onMapClick);

L.geolet({
  position: "bottomleft",
}).addTo(map);