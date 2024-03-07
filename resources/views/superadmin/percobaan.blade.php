<script type="text/javascript">
    // console.log(data)
    // -8.6184881,116.2663229
    const map = L.map('map').setView([-8.6184881, 116.2663229], 10);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // control that shows state info on hover
    const info = L.control();

    info.onAdd = function(map) {
        this._div = L.DomUtil.create('div', 'info');
        this.update();
        return this._div;
    };

    info.update = function(props) {
        const contents = props ? < b > $ {
            props.NAMOBJ
        } < /b><br / > $ {
            props.density
        }
        Orang: 'Arahkan kursor ke salah satu Kecamatan';
        this._div.innerHTML = < h4 > Jumlah Anak Yatim Piatu di Kab Lombok Tengah < /h4>${contents};
    };

    info.addTo(map);


    // get color depending on population density value
    function getColor(d) {
        return d > 1000 ? '#800026' :
            d > 500 ? '#BD0026' :
            d > 200 ? '#E31A1C' :
            d > 100 ? '#FC4E2A' :
            d > 50 ? '#FD8D3C' :
            d > 20 ? '#FEB24C' :
            d > 10 ? '#FED976' : '#FFEDA0';
    }

    function style(feature) {
        return {
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7,
            fillColor: getColor(feature.properties.density)
        };
    }

    function highlightFeature(e) {
        const layer = e.target;

        layer.setStyle({
            weight: 5,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.7
        });

        layer.bringToFront();

        info.update(layer.feature.properties);
    }

    /* global statesData */

    batu_keliang_utara['features'][0]['properties']['density'] = 100
    batukliang['features'][0]['properties']['density'] = 1000
    kopang['features'][0]['properties']['density'] = 750
    praya_tengah['features'][0]['properties']['density'] = 70
    praya_timur['features'][0]['properties']['density'] = 800
    praya_barat['features'][0]['properties']['density'] = 200
    praya_barat_daya['features'][0]['properties']['density'] = 600
    praya['features'][0]['properties']['density'] = 500
    peringgarata['features'][0]['properties']['density'] = 250
    jonggat['features'][0]['properties']['density'] = 352
    pujut['features'][0]['properties']['density'] = 760
    janapria['features'][0]['properties']['density'] = 200

    const dataGeoJSON = [{
            nama: "Batu Keliang Utara",
            geojson: batu_keliang_utara,
        },
        {
            nama: "Batukliang",
            geojson: batukliang,
        },
        {
            nama: "Kopang",
            geojson: kopang,
        },
        {
            nama: "Praya Tengah",
            geojson: praya_tengah,
        },
        {
            nama: "Praya Timur",
            geojson: praya_timur,
        },
        {
            nama: "Praya Barat",
            geojson: praya_barat,
        },
        {
            nama: "Praya Barat Daya",
            geojson: praya_barat_daya,
        },
        {
            nama: "Praya",
            geojson: praya,
        },
        {
            nama: "Peringgarata",
            geojson: peringgarata,
        },
        {
            nama: "Jonggat",
            geojson: jonggat,
        },
        {
            nama: "Pujut",
            geojson: pujut,
        },
        {
            nama: "Janapria",
            geojson: janapria,
        },
    ];
    for (let i = 0; i < dataGeoJSON.length; i++) {
        const namaKecamatan = dataGeoJSON[i].nama;
        const geojsonKecamatan = dataGeoJSON[i].geojson;
        // Buat layer GeoJSON untuk setiap iterasi
        const layerKecamatan = L.geoJson(geojsonKecamatan, {
            style,
            onEachFeature,
        }).addTo(map);

    }

    function resetHighlight(e) {
        geojson.resetStyle(e.target);
        info.update();
    }

    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
    }

    function onEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature
        });
    }




    const legend = L.control({
        position: 'bottomright'
    });

    legend.onAdd = function(map) {

        const div = L.DomUtil.create('div', 'info legend');
        const grades = [0, 10, 20, 50, 100, 200, 500, 1000];
        const labels = [];
        let from, to;

        for (let i = 0; i < grades.length; i++) {
            from = grades[i];
            to = grades[i + 1];

            labels.push(`<i style="background:${getColor(from + 1)}"></i> ${from}${to ? &ndash;${to} : '+'}`);
        }

        div.innerHTML = labels.join('<br>');
        return div;
    };

    legend.addTo(map);
</script>
