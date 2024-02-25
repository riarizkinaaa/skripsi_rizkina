var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

var streets = L.tileLayer(mbUrl, {
    id: 'mapbox.streets',
    attribution: mbAttr
});
var peta = L.map('mapku', {
    center: [-8.5732202, 116.1033006],
    zoom: 10.25,
    layers: [streets]
});


//json batas wilayah kecamatan

var bk = L.geoJSON([batu_keliang], {
    style: function (featur) {
        return featur.properties && featur.properties.style;
    }
}).addTo(peta);

var bku = L.geoJSON([batu_keliang_utara], {
    style: function (featur) {
        return featur.properties && featur.properties.style;
    }
}).addTo(peta);

var jnp = L.geoJSON([janapria], {
    style: function (featur) {
        return featur.properties && featur.properties.style;
    }
}).addTo(peta);

var jng = L.geoJSON([jonggat], {
    style: function (featur) {
        return featur.properties && featur.properties.style;
    }
}).addTo(peta);

var kpg = L.geoJSON([kopang], {
    style: function (featur) {
        return featur.properties && featur.properties.style;
    }
}).addTo(peta);

var pry = L.geoJSON([praya], {
    style: function (featur) {
        return featur.properties && featur.properties.style;
    }
}).addTo(peta);

var prateng = L.geoJSON([praya_tengah], {
    style: function (featur) {
        return featur.properties && featur.properties.style;
    }
}).addTo(peta);

var prabada = L.geoJSON([praya_barat_daya], {
    style: function (featur) {
        return featur.properties && featur.properties.style;
    }
}).addTo(peta);

var praba = L.geoJSON([praya_barat], {
    style: function (featur) {
        return featur.properties && featur.properties.style;
    }
}).addTo(peta);

var pratim = L.geoJSON([praya_timur], {
    style: function (featur) {
        return featur.properties && featur.properties.style;
    }
}).addTo(peta);

var prg = L.geoJSON([peringgarata], {
    style: function (featur) {
        return featur.properties && featur.properties.style;
    }
}).addTo(peta);

var pjt = L.geoJSON([pujut], {
    style: function (featur) {
        return featur.properties && featur.properties.style;
    }
}).addTo(peta);
L.geoJSON([btskab], {
    style: function (feature) {
        return feature.properties && feature.properties.style;
    }
}).addTo(peta);