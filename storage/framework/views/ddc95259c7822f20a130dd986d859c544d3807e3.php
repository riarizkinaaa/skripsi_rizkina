<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/animate.css')); ?>">
    <style>
        #chartdiv {
            width: 100%;
        }

        .data_kecamatan {
            width: 100%;
            height: 400px;

        }
    </style>
    <style>
        .leaflet-container {
            height: 400px;
            width: 600px;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
    <style>
        #map {
            width: 870px;
            height: 500px;
        }

        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }

        .legend {
            text-align: left;
            line-height: 18px;
            color: #555;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldContent('breadcrumb-list'); ?>
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-xl-3 col-md-3 col-sm-6 box-col-3 des-xl-25 rate-sec">
                <div class="card income-card card-primary">
                    <div class="card-body text-center">
                        <div class="round-box">
                            <i data-feather="user"></i>
                        </div>
                        <h5 id="anak_yatim"></h5>
                        <p>Anak Yatim</p><a class="btn-arrow arrow-primary" href="javascript:void(0)" id="jumlah_yatim"></a>

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-6 box-col-3 des-xl-25 rate-sec">
                <div class="card income-card card-primary">
                    <div class="card-body text-center">
                        <div class="round-box">
                            <i data-feather="user-minus"></i>
                        </div>
                        <h5 id="anak_piatu"></h5>
                        <p>Anak Piatu</p><a class="btn-arrow arrow-primary" href="javascript:void(0)" id="jumlah_piatu"></a>
                        <div class="parrten">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-6 box-col-3 des-xl-25 rate-sec">
                <div class="card income-card card-primary">
                    <div class="card-body text-center">
                        <div class="round-box">
                            <i data-feather="user-plus"></i>
                        </div>
                        <h5 id="yatim_piatu"></h5>
                        <p>Anak Yatim Piatu</p><a class="btn-arrow arrow-primary" href="javascript:void(0)"
                            id="jumlah_yatim_piatu"> </a>
                        <div class="parrten">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-6 box-col-3 des-xl-25 rate-sec">
                <div class="card income-card card-primary">
                    <div class="card-body text-center">
                        <div class="round-box">
                            <i data-feather="users"></i>
                        </div>
                        <h5 id="semua"></h5>
                        <p>Semua</p><a class="btn-arrow arrow-primary" href="javascript:void(0)"><i
                                class="toprightarrow-primary fa fa-arrow-up me-2"></i>100% </a>
                        <div class="parrten">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Total Anak Yatim Piatu</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="status_anak"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Jenis Kelamin</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="jenis_kelamin">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Data Kecamtan</h5>
                            <div class="col-md-2">
                                <select id="tahun" class="form-select">
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <!-- Tambahkan opsi tahun lainnya jika diperlukan -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="data_kecamatan">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-top d-sm-flex justify-content-between align-items-center">
                            <h5>Peta </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id='map'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Container-fluid Ends-->
    <?php $__env->startPush('scripts'); ?>
        <script src="<?php echo e(asset('assets/js/chart/chartist/chartist.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')); ?>"></script>


        <script src="<?php echo e(asset('assets/js/chart/amchart/core.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/chart/amchart/charts.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/chart/amchart/animated.js')); ?>"></script>
        
        <script type="text/javascript" src="<?php echo e(asset('assets/js/leaflet/batu_keliang_utara.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('assets/semuafile/batu_keliang.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('assets/semuafile/praya_tengah.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('assets/semuafile/kopang.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('assets/semuafile/janapria.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('assets/semuafile/jonggat.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('assets/semuafile/peringgarata.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('assets/semuafile/praya_barat_daya.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('assets/semuafile/praya_barat.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('assets/semuafile/pujut.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('assets/semuafile/praya.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('assets/semuafile/praya_timur.js')); ?>"></script>

        <script type="text/javascript">
            const map = L.map('map').setView([-8.5546668, 116.025997], 10);

            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            const info = L.control();

            info.onAdd = function(map) {
                this._div = L.DomUtil.create('div', 'info');
                this.update();
                return this._div;
            };
            info.update = function(props) {
                let contents = 'Hover over a state';
                if (props && props.NAMOBJ) {
                    const jumlahAnak = props.jumlah_anak_yatim || 0;
                    contents =
                        `<h4>Jumlah Anak Yatim di Kabupaten Lombok Tengah </h4><b>Kecamatan:</b> ${props.NAMOBJ}<br /><b>Jumlah Anak:</b> ${jumlahAnak}<br />`;
                }
                this._div.innerHTML = contents;
            };

            fetch('/ank')
                .then(response => response.json())
                .then(data => {
                    bku.eachLayer(layer => {
                        const properties = layer.feature.properties;
                        const jumlah_anak = data[properties.NAMOBJ] || 0;
                        properties.jumlah_anak_yatim = jumlah_anak;
                    });
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });

            info.addTo(map);

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
                    fillColor: getColor(feature.properties.jumlah_anak_yatim)
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

            function resetHighlight(e) {
                const layer = e.target;
                layer.setStyle({
                    weight: 2,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 0.7,
                    fillColor: getColor(layer.feature.properties.jumlah_anak_yatim)
                });
                info.update();
            }

            function zoomToFeature(e) {
                map.fitBounds(e.target.getBounds());
            }

            function onEachFeature(feature, layer) {
                layer.on({
                    mouseover: highlightFeature,
                    mouseout: resetHighlight,
                    click: function(e) {
                        info.update({
                            name: feature.properties.NAMOBJ
                        });
                    }
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

                    labels.push(`<i style="background:${getColor(from + 1)}"></i> ${from}${to ? `&ndash;${to}` : '+'}`);
                }

                div.innerHTML = labels.join('<br>');
                return div;
            };

            legend.addTo(map);

            // Load GeoJSON data for each kecamatan

            const bku = L.geoJson(batu_keliang_utara, {
                style,
                onEachFeature
            }).addTo(map);
            const prateng = L.geoJson(praya_tengah, {
                style,
                onEachFeature
            }).addTo(map);
            const kpg = L.geoJson(kopang, {
                style,
                onEachFeature
            }).addTo(map);
            const jnp = L.geoJson(janapria, {
                style,
                onEachFeature
            }).addTo(map);
            const prgt = L.geoJson(peringgarata, {
                style,
                onEachFeature
            }).addTo(map);
            const jgt = L.geoJson(jonggat, {
                style,
                onEachFeature
            }).addTo(map);
            const pbd = L.geoJson(praya_barat_daya, {
                style,
                onEachFeature
            }).addTo(map);
            const pry = L.geoJson(praya, {
                style,
                onEachFeature
            }).addTo(map);
            const pujt = L.geoJson(pujut, {
                style,
                onEachFeature
            }).addTo(map);
            const prt = L.geoJson(praya_timur, {
                style,
                onEachFeature
            }).addTo(map);
            const prb = L.geoJson(praya_barat, {
                style,
                onEachFeature
            }).addTo(map);
            const batkliang = L.geoJson(batu_keliang, {
                style,
                onEachFeature
            }).addTo(map);
        </script>


        <script>
            $(document).ready(function() {
                $.ajax({
                    url: 'all_anak',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // status anak
                        const today = new Date();
                        const anak_dibawah_19_tahun = data['anak'].filter(anak => {
                            const tahunLahir = new Date(anak.tgl_lahir);
                            const tahunLahirPlus19 = new Date(tahunLahir.getFullYear() + 19,
                                tahunLahir.getMonth(), tahunLahir.getDate());
                            return tahunLahirPlus19 >
                            today; // Filter anak yang masih di bawah 19 tahun
                        });

                        const anak_yatim = anak_dibawah_19_tahun.filter(anak => anak.status_anak == 1);
                        const anak_piatu = anak_dibawah_19_tahun.filter(anak => anak.status_anak == 2);
                        const yatim_piatu = anak_dibawah_19_tahun.filter(anak => anak.status_anak == 3);

                        const jumlah_yatim = anak_yatim.length / anak_dibawah_19_tahun.length * 100;
                        const jumlah_piatu = anak_piatu.length / anak_dibawah_19_tahun.length * 100;
                        const jumlah_yatim_piatu = yatim_piatu.length / anak_dibawah_19_tahun.length * 100;

                        const laki_laki = anak_dibawah_19_tahun.filter(anak => anak.jenis_kelamin == 1);
                        const perempuan = anak_dibawah_19_tahun.filter(anak => anak.jenis_kelamin == 0);
                        const jumlah_lk = laki_laki.length / anak_dibawah_19_tahun.length * 100;
                        const jumlah_pr = perempuan.length / anak_dibawah_19_tahun.length * 100;

                        $("#anak_yatim").append(anak_yatim.length + " Orang")
                        $("#anak_piatu").append(anak_piatu.length + " Orang")
                        $("#yatim_piatu").append(yatim_piatu.length + " Orang")
                        $("#semua").append(anak_dibawah_19_tahun.length + " Orang")
                        $("#jumlah_yatim").append(jumlah_yatim.toFixed(2) + " %")
                        $("#jumlah_piatu").append(jumlah_piatu.toFixed(2) + " %")
                        $("#jumlah_yatim_piatu").append(jumlah_yatim_piatu.toFixed(2) + " %")

                        // console.log(jumlah_yatim);
                        // console.log(jumlah_piatu);
                        // console.log(jumlah_yatim_piatu);

                        // Themes begin
                        am4core.useTheme(am4themes_animated);
                        // Themes end

                        // grafik status Anak
                        // Create chart instance
                        var chart = am4core.create("status_anak", am4charts.PieChart);

                        // Add data
                        chart.data = [{
                            "country": "Yatim",
                            "litres": jumlah_yatim
                        }, {
                            "country": "Piatu",
                            "litres": jumlah_piatu
                        }, {
                            "country": "Yatim Piatu",
                            "litres": jumlah_yatim_piatu
                        }];

                        // Add and configure Series
                        var pieSeries = chart.series.push(new am4charts.PieSeries());
                        pieSeries.dataFields.value = "litres";
                        pieSeries.dataFields.category = "country";
                        pieSeries.innerRadius = am4core.percent(50);
                        pieSeries.ticks.template.disabled = true;
                        pieSeries.labels.template.disabled = true;

                        var rgm = new am4core.LinearGradientModifier();
                        rgm.brightnesses.push(0, -0.4);
                        pieSeries.slices.template.fillModifier = rgm;

                        var rgm2 = new am4core.LinearGradientModifier();
                        rgm2.brightnesses.push(0, -0.4);

                        pieSeries.slices.template.strokeModifier = rgm2;
                        pieSeries.slices.template.strokeOpacity = 1;
                        pieSeries.slices.template.strokeWidth = 1;


                        chart.legend = new am4charts.Legend();
                        chart.legend.position = "right";

                        pieSeries.slices.template.events.on("validated", function(event) {
                            var gradient = event.target.fillModifier.gradient
                            gradient.rotation = event.target.middleAngle + 90;

                            var gradient2 = event.target.strokeModifier.gradient
                            gradient2.rotation = event.target.middleAngle + 90;
                        })


                        // grafik jenis_kelamin

                        var chart = am4core.create("jenis_kelamin", am4charts.PieChart);

                        // Add data
                        chart.data = [{
                            "jenis_kelamin": "Laki Laki",
                            "jumlah": jumlah_lk
                        }, {
                            "jenis_kelamin": "Perempuan",
                            "jumlah": jumlah_pr
                        }];

                        // Add and configure Series
                        var pieSeries = chart.series.push(new am4charts.PieSeries());
                        pieSeries.dataFields.value = "jumlah";
                        pieSeries.dataFields.category = "jenis_kelamin";
                        pieSeries.innerRadius = am4core.percent(50);
                        pieSeries.ticks.template.disabled = true;
                        pieSeries.labels.template.disabled = true;

                        var rgm = new am4core.LinearGradientModifier();
                        rgm.brightnesses.push(0, -0.4);
                        pieSeries.slices.template.fillModifier = rgm;

                        var rgm2 = new am4core.LinearGradientModifier();
                        rgm2.brightnesses.push(0, -0.4);

                        pieSeries.slices.template.strokeModifier = rgm2;
                        pieSeries.slices.template.strokeOpacity = 1;
                        pieSeries.slices.template.strokeWidth = 1;


                        chart.legend = new am4charts.Legend();
                        chart.legend.position = "right";

                        pieSeries.slices.template.events.on("validated", function(event) {
                            var gradient = event.target.fillModifier.gradient
                            gradient.rotation = event.target.middleAngle + 90;

                            var gradient2 = event.target.strokeModifier.gradient
                            gradient2.rotation = event.target.middleAngle + 90;
                        })


                        // data kecamatan
                        // Fungsi untuk membangun grafik
                        function buildChart(data, tahunYangDipilih, batasUsia) {
                            var chart = am4core.create("data_kecamatan", am4charts.XYChart);
                            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
                            var datakec = [];
                            var data_max = [];
                            console.log(tahunYangDipilih);

                            // Filter data anak berdasarkan tahun yang dipilih
                            var dataAnakFiltered = data['anak'].filter(anak => {
                                const tahunLahir = new Date(anak.tgl_lahir).getFullYear();
                                const usia = tahunYangDipilih - tahunLahir;
                                return usia < batasUsia;
                            });

                            // Output dataAnakFiltered ke konsol
                            console.log("Data anak yang dipilih:", dataAnakFiltered);

                            for (let i = 0; i < data['kecamatan'].length; i++) {
                                const kecamatan = dataAnakFiltered.filter(anak => anak.id_kecamatan == data[
                                    'kecamatan'][i]['id_kecamatan']);
                                let kec = {
                                    kecamatan: data['kecamatan'][i]['nama_kecamatan'],
                                    jumlah_anak: kecamatan.length
                                };
                                datakec.push(kec);
                                data_max.push(kecamatan.length);
                            }

                            chart.data = datakec;
                            var max = Math.max.apply(null, data_max);

                            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                            categoryAxis.renderer.grid.template.location = 0;
                            categoryAxis.dataFields.category = "kecamatan";
                            categoryAxis.renderer.minGridDistance = 20;
                            categoryAxis.renderer.inside = false;
                            categoryAxis.start = 0;
                            categoryAxis.fontSize = 12;
                            categoryAxis.renderer.grid.template.disabled = true;
                            var label = categoryAxis.renderer.labels.template;
                            label.wrap = false;
                            label.maxWidth = 160;
                            label.tooltipText = "{kecamatan}";

                            categoryAxis.events.on("sizechanged", function(ev) {
                                var axis = ev.target;
                                var cellWidth = axis.pixelWidth / (axis.endIndex - axis.startIndex);
                                if (cellWidth < axis.renderer.labels.template.maxWidth) {
                                    axis.renderer.labels.template.rotation = -75;
                                    axis.renderer.labels.template.horizontalCenter = "right";
                                    axis.renderer.labels.template.verticalCenter = "middle";
                                } else {
                                    axis.renderer.labels.template.rotation = 0;
                                    axis.renderer.labels.template.horizontalCenter = "middle";
                                    axis.renderer.labels.template.verticalCenter = "top";
                                }
                            });

                            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                            valueAxis.min = 0;
                            valueAxis.max = max + 100;
                            valueAxis.strictMinMax = true;
                            valueAxis.renderer.minGridDistance = 20;

                            var series = chart.series.push(new am4charts.ColumnSeries());
                            series.dataFields.categoryX = "kecamatan";
                            series.dataFields.valueY = "jumlah_anak";
                            series.columns.template.tooltipText = "{valueY.value}";
                            series.columns.template.tooltipY = 0;
                            series.columns.template.strokeOpacity = 0;

                            series.columns.template.adapter.add("fill", function(fill, target) {
                                return chart.colors.getIndex(target.dataItem.index);
                            });
                        }

                        // Inisialisasi grafik dengan tahun 2024 saat halaman dimuat
                        var tahunYangDipilih = 2024;
                        var batasUsia = 19;
                        buildChart(data, tahunYangDipilih, batasUsia);

                        // Tambahkan event listener untuk menangani perubahan pada elemen select
                        document.getElementById('tahun').addEventListener('change', function() {
                            tahunYangDipilih = parseInt(this
                            .value); // Ambil nilai tahun yang dipilih dari elemen select dan ubah ke tipe integer
                            console.log("Tahun yang dipilih:",
                            tahunYangDipilih); // Cek apakah event listener dipicu dengan benar
                            // Panggil kembali fungsi untuk membangun grafik dengan tahun yang baru dipilih
                            buildChart(data, tahunYangDipilih, batasUsia);
                        });



                    }
                });

            })
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Downloads\pmks_pengembangan_2-master\resources\views/superadmin/dashboard.blade.php ENDPATH**/ ?>