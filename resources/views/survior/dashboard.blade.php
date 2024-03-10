@extends('layouts.survior.master')

@section('title', 'Dashboard')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <style>
        #chartdiv {
            width: 100%;
        }

        .data_kecamatan {
            width: 100%;
            height: 400px;

        }
    </style>
@endpush
@section('content')
    @yield('breadcrumb-list')
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
                        <p>Semua</p><a class="btn-arrow arrow-primary" href="javascript:void(0)"></a>
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
                            <h5>Pendidikan</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="pendidikan" style="width: 100% ;height: 400px;">
                        </div>
                    </div>
                </div>
            </div>


        </div>
        {{-- @include('maps/map') --}}
    </div>
    <!-- Container-fluid Ends-->
    @push('scripts')
        <script src="{{ asset('assets/js/chart/chartist/chartist.js') }}"></script>
        <script src="{{ asset('assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>


        <script src="{{ asset('assets/js/chart/amchart/core.js') }}"></script>
        <script src="{{ asset('assets/js/chart/amchart/charts.js') }}"></script>
        <script src="{{ asset('assets/js/chart/amchart/animated.js') }}"></script>


        <script>
            $(document).ready(function() {
                $.ajax({
                    url: 'json_anak',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // status anak
                        // Mendapatkan id pendata dari sesi
                        const id_pendata = `{{ Session::get('id_survior') }}`;

                        // Melakukan filter data anak berdasarkan id pendata
                        const pendata = data['anak'].filter((anak) => anak.id_survior == id_pendata);

                        // Mendapatkan tanggal hari ini
                        const today = new Date();

                        // Filter anak-anak yang kurang dari 19 tahun dari pendata yang sudah difilter
                        const anak_dibawah_19_tahun = pendata.filter((anak) => {
                            const tahunLahir = new Date(anak.tgl_lahir);
                            const tahunLahirPlus19 = new Date(tahunLahir.getFullYear() + 19,
                                tahunLahir.getMonth(), tahunLahir.getDate());
                            return tahunLahirPlus19 >
                                today; // Filter anak yang masih di bawah 19 tahun
                        });

                        // Filter anak yatim, anak piatu, dan yatim piatu
                        const anak_yatim = anak_dibawah_19_tahun.filter(status_anak => status_anak
                            .status_anak == 1);
                        const anak_piatu = anak_dibawah_19_tahun.filter(status_anak => status_anak
                            .status_anak == 2);
                        const yatim_piatu = anak_dibawah_19_tahun.filter(status_anak => status_anak
                            .status_anak == 3);

                        const jumlah_yatim = anak_yatim.length;
                        const jumlah_piatu = anak_piatu.length;
                        const jumlah_yatim_piatu = yatim_piatu.length;

                        // Jenis kelamin
                        const laki_laki = anak_dibawah_19_tahun.filter(jenis_kelamin => jenis_kelamin
                            .jenis_kelamin == 1);
                        const perempuan = anak_dibawah_19_tahun.filter(jenis_kelamin => jenis_kelamin
                            .jenis_kelamin == 0);
                        const jumlah_lk = laki_laki.length;
                        const jumlah_pr = perempuan.length;

                        // Pendidikan
                        const paud_tk = anak_dibawah_19_tahun.filter(id_pendidikan => id_pendidikan
                            .id_pendidikan == 1);
                        const belum_sekolah = anak_dibawah_19_tahun.filter(id_pendidikan => id_pendidikan
                            .id_pendidikan == 2);
                        const sdmi_sederajat = anak_dibawah_19_tahun.filter(id_pendidikan => id_pendidikan
                            .id_pendidikan == 3);
                        const belum_tamat_sdmi_sederajat = anak_dibawah_19_tahun.filter(id_pendidikan =>
                            id_pendidikan.id_pendidikan == 4);
                        const tamat_sdmi_sederajat = anak_dibawah_19_tahun.filter(id_pendidikan =>
                            id_pendidikan.id_pendidikan == 5);
                        const sltp_sederajat = anak_dibawah_19_tahun.filter(id_pendidikan => id_pendidikan
                            .id_pendidikan == 6);
                        const tamat_sltp_sederajat = anak_dibawah_19_tahun.filter(id_pendidikan =>
                            id_pendidikan.id_pendidikan == 7);
                        const slta_sederajat = anak_dibawah_19_tahun.filter(id_pendidikan => id_pendidikan
                            .id_pendidikan == 8);
                        const tamat_slta = anak_dibawah_19_tahun.filter(id_pendidikan => id_pendidikan
                            .id_pendidikan == 9);

                        const jumlah_paud_tk = paud_tk.length;
                        const jumlah_belum_sekolah = belum_sekolah.length;
                        const jumlah_sdmi_sederajat = sdmi_sederajat.length;
                        const jumlah_belum_tamat_sdmi_sederajat = belum_tamat_sdmi_sederajat.length;
                        const jumlah_tamat_sdmi_sederajat = tamat_sdmi_sederajat.length;
                        const jumlah_sltp_sederajat = sltp_sederajat.length;
                        const jumlah_tamat_sltp_sederajat = tamat_sltp_sederajat.length;
                        const jumlah_slta_sederajat = slta_sederajat.length;
                        const jumlah_tamat_slta = tamat_slta.length;

                        $("#paud_tk").append(jumlah_paud_tk);
                        $("#belum_sekolah").append(jumlah_belum_sekolah);
                        $("#sdmi_sederajat").append(jumlah_sdmi_sederajat);
                        $("#belum_tamat_sdmi_sederajat").append(jumlah_belum_tamat_sdmi_sederajat);
                        $("#tamat_sdmi_sederajat").append(jumlah_tamat_sdmi_sederajat);
                        $("#sltp_sederajat").append(jumlah_sltp_sederajat);
                        $("#tamat_sltp_sederajat").append(jumlah_tamat_sltp_sederajat);
                        $("#slta_sederajat").append(jumlah_slta_sederajat);
                        $("#tamat_slta").append(jumlah_tamat_slta);

                        $("#anak_yatim").append(jumlah_yatim);
                        $("#anak_piatu").append(jumlah_piatu);
                        $("#yatim_piatu").append(jumlah_yatim_piatu);
                        $("#semua").append(anak_dibawah_19_tahun.length);



                        // Themes begin
                        am4core.useTheme(am4themes_animated);
                        // Lanjutkan dengan kode untuk menggunakan tema dan membuat grafik

                        // Themes end

                        // grafik status Anak
                        // Create chart instance
                        // Membuat grafik Pie untuk status anak
                        var chartStatusAnak = am4core.create("status_anak", am4charts.PieChart);

                        // Menambahkan data
                        chartStatusAnak.data = [{
                            "status": "Yatim",
                            "jumlah": jumlah_yatim
                        }, {
                            "status": "Piatu",
                            "jumlah": jumlah_piatu
                        }, {
                            "status": "Yatim Piatu",
                            "jumlah": jumlah_yatim_piatu
                        }];

                        // Konfigurasi series
                        var pieSeriesStatusAnak = chartStatusAnak.series.push(new am4charts.PieSeries());
                        pieSeriesStatusAnak.dataFields.value = "jumlah";
                        pieSeriesStatusAnak.dataFields.category = "status";
                        pieSeriesStatusAnak.innerRadius = am4core.percent(50);
                        pieSeriesStatusAnak.ticks.template.disabled = true;
                        pieSeriesStatusAnak.labels.template.disabled = true;

                        // Set label text to display real values instead of percentages
                        // pieSeriesStatusAnak.labels.template.text = "{value} orang";
                        // Menambahkan legenda
                        chartStatusAnak.legend = new am4charts.Legend();
                        chartStatusAnak.legend.position = "right";

                        // Mengatur tata letak ulang legenda ketika ada perubahan pada grafik
                        pieSeriesStatusAnak.slices.template.events.on("validated", function(event) {
                            var gradient = event.target.fillModifier.gradient
                            gradient.rotation = event.target.middleAngle + 90;

                            var gradient2 = event.target.strokeModifier.gradient
                            gradient2.rotation = event.target.middleAngle + 90;
                        });


                        // Membuat grafik Pie untuk jenis kelamin
                        var chartJenisKelamin = am4core.create("jenis_kelamin", am4charts.PieChart);

                        // Menambahkan data
                        chartJenisKelamin.data = [{
                            "jenis_kelamin": "Laki-Laki",
                            "jumlah": jumlah_lk
                        }, {
                            "jenis_kelamin": "Perempuan",
                            "jumlah": jumlah_pr
                        }];

                        // Konfigurasi series
                        var pieSeriesJenisKelamin = chartJenisKelamin.series.push(new am4charts
                            .PieSeries());
                        pieSeriesJenisKelamin.dataFields.value = "jumlah";
                        pieSeriesJenisKelamin.dataFields.category = "jenis_kelamin";
                        pieSeriesJenisKelamin.innerRadius = am4core.percent(50);
                        pieSeriesJenisKelamin.ticks.template.disabled = true;
                        pieSeriesJenisKelamin.labels.template.disabled = true;

                        // Menambahkan legenda
                        chartJenisKelamin.legend = new am4charts.Legend();
                        chartJenisKelamin.legend.position = "right";

                        // Mengatur tata letak ulang legenda ketika ada perubahan pada grafik
                        pieSeriesJenisKelamin.slices.template.events.on("validated", function(event) {
                            var gradient = event.target.fillModifier.gradient
                            gradient.rotation = event.target.middleAngle + 90;

                            var gradient2 = event.target.strokeModifier.gradient
                            gradient2.rotation = event.target.middleAngle + 90;
                        });

                        // Membuat grafik Pie untuk pendidikan
                        var chartPendidikan = am4core.create("pendidikan", am4charts.PieChart);

                        // Menambahkan data
                        chartPendidikan.data = [{
                            "pendidikan": "PAUD/TK",
                            "jumlah": jumlah_paud_tk
                        }, {
                            "pendidikan": "Belum Sekolah",
                            "jumlah": jumlah_belum_sekolah
                        }, {
                            "pendidikan": "SD/MI Sederajat",
                            "jumlah": jumlah_sdmi_sederajat
                        }, {
                            "pendidikan": "Belum Tamat SD/MI Sederajat",
                            "jumlah": jumlah_belum_tamat_sdmi_sederajat
                        }, {
                            "pendidikan": "Tamat SD/MI Sederajat",
                            "jumlah": jumlah_tamat_sdmi_sederajat
                        }, {
                            "pendidikan": "SLTP Sederajat",
                            "jumlah": jumlah_sltp_sederajat
                        }, {
                            "pendidikan": "Tamat SLTP Sederajat",
                            "jumlah": jumlah_tamat_sltp_sederajat
                        }, {
                            "pendidikan": "SLTA Sederajat",
                            "jumlah": jumlah_slta_sederajat
                        }, {
                            "pendidikan": "Tamat SLTA",
                            "jumlah": jumlah_tamat_slta
                        }];

                        // Konfigurasi series
                        var pieSeriesPendidikan = chartPendidikan.series.push(new am4charts.PieSeries());
                        pieSeriesPendidikan.dataFields.value = "jumlah";
                        pieSeriesPendidikan.dataFields.category = "pendidikan";
                        pieSeriesPendidikan.innerRadius = am4core.percent(50);
                        pieSeriesPendidikan.ticks.template.disabled = true;
                        pieSeriesPendidikan.labels.template.disabled = true;

                        // Set label text to display real values instead of percentages
                        pieSeriesPendidikan.labels.template.text = "{value} orang";

                        // Menambahkan legenda
                        chartPendidikan.legend = new am4charts.Legend();
                        chartPendidikan.legend.position = "right";

                        // Mengatur tata letak ulang legenda ketika ada perubahan pada grafik
                        pieSeriesPendidikan.slices.template.events.on("validated", function(event) {
                            var gradient = event.target.fillModifier.gradient
                            gradient.rotation = event.target.middleAngle + 90;

                            var gradient2 = event.target.strokeModifier.gradient
                            gradient2.rotation = event.target.middleAngle + 90;
                        });





                    }
                });

            })
        </script>
    @endpush
@endsection
