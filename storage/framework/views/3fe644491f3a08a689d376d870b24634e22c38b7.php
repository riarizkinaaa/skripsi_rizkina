<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="<?php echo e(asset('assets/images/logo/icon-logo.png')); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/logo/icon-logo.png')); ?>" type="image/x-icon">
    <title>PMKS - Anak Yatim Piatu</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/css/fontawesome.css')); ?>">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/icofont.css')); ?>">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/themify.css')); ?>">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/flag-icon.css')); ?>">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/feather-icon.css')); ?>">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/animate.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/owlcarousel.css')); ?>">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/bootstrap.css')); ?>">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link id="color" rel="stylesheet" href="<?php echo e(asset('assets/css/color-1.css')); ?>" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/responsive.css')); ?>">
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
</head>

<body class="landing-wrraper">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper landing-page">
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- header start-->
            <header class="landing-header">
                <div class="custom-container">
                    <div class="row">
                        <div class="col-12">
                            <nav class="navbar navbar-light p-0" id="navbar-example2"><a class="navbar-brand" href="javascript:void(0)"> <img class="img-fluid" src="<?php echo e(asset('assets/images/logo/logo.png')); ?>" alt=""></a>
                                <ul class="landing-menu nav nav-pills">
                                    <li class="nav-item menu-back">back<i class="fa fa-angle-right"></i></li>
                                    <li class="nav-item"><a class="nav-link" href="">Branda</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#demo">Tentang</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#core-feature">Statistik</a></li>
                                </ul>
                                <div class="buy-block"><a class="btn-landing" href="<?php echo e(route('login')); ?>">Masuk</a>
                                    <div class="toggle-menu"><i class="fa fa-bars"></i></div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
            <!-- header end-->
            <!--home section start-->
            <section class="landing-home section-pb-space" id="home"><img class="img-fluid bg-img-cover" src="<?php echo e(asset('assets/images/landing/landing-home/home-bg2.jpg')); ?>" alt="">
                <div class="custom-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="landing-home-contain">
                                <div>
                                    <div class="landing-logo"><img class="img-fluid" src="<?php echo e(asset('assets/images/logo/icon-logo.png')); ?>" alt=""></div>
                                    <h2>PMKS <span> Anak Yatim Piatu</span></h2>
                                    <p>Sebuah platform teknologi inovatif yang bertujuan untuk mengumpulkan, menyimpan, dan mengelola data yang berkaitan dengan anak-anak yang telah kehilangan satu atau kedua orang tua (yatim piatu) secara efisien dan terorganisir.</p><a class="btn-landing btn-lg" href="">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!--home section end-->
            <!--demo section start-->
            <section class="demo-section section-py-space" id="demo">
                <div class="title">
                    <h2>Tentang</h2>
                </div>
                <div class="custom-container">
                    <div class="row demo-block demo-imgs justify-content-center">
                        <div class="col-lg-8 col-sm-10 ">
                            <div class="demo-box fs-5">
                                <p class="fs-5 text-center">Aplikasi Pendataan Anak Yatim Piatu adalah sebuah platform teknologi inovatif yang bertujuan untuk mengumpulkan, menyimpan, dan mengelola data yang berkaitan dengan anak-anak yang telah kehilangan satu atau kedua orang tua (yatim piatu) secara efisien dan terorganisir. Aplikasi ini dirancang untuk memberikan dukungan kepada lembaga, organisasi, dan pihak terkait dalam menjalankan program-program sosial, pendidikan, dan kesejahteraan yang spesifik untuk anak-anak yang berada dalam kondisi yatim piatu.
                                </p>
                                <p class="fs-5 text-center">
                                    Berikut ini adalah beberapa data yang dimasukkan dalam Sistem Pendataan Anak Yatim Piatu: <br>
                                    1. Data Identitas <br>
                                    2. Data Keluarg <br>
                                    3. Pendidikan dan Keterampilan
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--demo section end-->
            <section class="core-feature section-py-space bg-white" id="core-feature">
                <div class="title">
                    <h2>Statistik</h2>
                </div>
                <div class="custom-container">
                    <div class="row feature-block">

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
                                    <p>Anak Yatim Piatu</p><a class="btn-arrow arrow-primary" href="javascript:void(0)" id="jumlah_yatim_piatu"> </a>
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
                                    <p>Semua</p><a class="btn-arrow arrow-primary" href="javascript:void(0)"><i class="toprightarrow-primary fa fa-arrow-up me-2"></i>100% </a>
                                    <div class="parrten">

                                    </div>
                                </div>
                            </div>
                        </div>

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
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="data_kecamatan">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!--Core Feature end-->

            <!--footer start-->

            <div class="sub-footer">
                <div class="custom-container">
                    <div class="row">
                        <div class="col-md-6 col-sm-2">
                            <div class="footer-contain"><img class="img-fluid" src="{{asset('assets/images/logo/logo.png" alt=""></div>
                        </div>
                        <div class="col-md-6 col-sm-10">
                            <div class="footer-contain">
                                <p class="mb-0">Copyright <?= date('Y') ?> © Tim Dev Diskominfo Kab Loteng. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--footer end-->
        </div>
    </div>
    <!-- latest jquery-->
    <!-- latest jquery-->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap/popper.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <script src="assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="assets/js/owlcarousel/owl-custom.js"></script>
    <script src="assets/js/landing_sticky.js"></script>
    <script src="assets/js/landing.js"></script>
    <script src="assets/js/jarallax_libs/libs.min.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <script src="assets/js/chart/chartist/chartist.js"></script>
    <script src="assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
    <script src="assets/js/chart/amchart/core.js"></script>
    <script src="assets/js/chart/amchart/charts.js"></script>
    <script src="assets/js/chart/amchart/animated.js"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'auth/alllanak',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // console.log(data)
                    // status anak
                    const anak_yatim = data['anak'].filter((status_anak) => status_anak.status_anak == 1);
                    const anak_piatu = data['anak'].filter((status_anak) => status_anak.status_anak == 2);
                    const yatim_piatu = data['anak'].filter((status_anak) => status_anak.status_anak == 3);

                    const jumlah_yatim = anak_yatim.length / data['anak'].length * 100;
                    const jumlah_piatu = anak_piatu.length / data['anak'].length * 100;
                    const jumlah_yatim_piatu = yatim_piatu.length / data['anak'].length * 100;
                    // jenis kelamin
                    const laki_laki = data['anak'].filter((jenis_kelamin) => jenis_kelamin.jenis_kelamin == 1);
                    const perempuan = data['anak'].filter((jenis_kelamin) => jenis_kelamin.jenis_kelamin == 0);
                    const jumlah_lk = laki_laki.length / data['anak'].length * 100;
                    const jumlah_pr = perempuan.length / data['anak'].length * 100;


                    // const kecamtan = data.filter((kecamtan) => kecamtan.id_kecamatan == id_kecamatan);
                    $("#anak_yatim").append(anak_yatim.length + " Orang")
                    $("#anak_piatu").append(anak_piatu.length + " Orang")
                    $("#yatim_piatu").append(yatim_piatu.length + " Orang")
                    $("#semua").append(data['anak'].length + " Orang")
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
                    var chart = am4core.create("data_kecamatan", am4charts.XYChart);
                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
                    // var objek = {}
                    var datakec = []
                    var data_max = []
                    for (let i = 0; i < data['kecamatan'].length; i++) {
                        const kecamatan = data['anak'].filter((kecamatan) => kecamatan.id_kecamatan == data['kecamatan'][i]['id_kecamatan']);
                        let kec = {
                            kecamatan: data['kecamatan'][i]['nama_kecamatan'],
                            jumlah_anak: kecamatan.length
                        }
                        datakec.push(kec)
                        data_max.push(kecamatan.length)
                    }
                    // console.log(datakec)
                    // console.log(data_max)
                    chart.data = datakec
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

                    /*
                    // this is exactly the same, but with events
                    axisBreak.events.on("over", function() {
                        axisBreak.animate(
                        [{ property: "breakSize", to: 1 }, { property: "opacity", to: 0.1 }],
                        1500,
                        am4core.ease.sinOut
                        );
                    });
                    axisBreak.events.on("out", function() {
                        axisBreak.animate(
                        [{ property: "breakSize", to: 0.005 }, { property: "opacity", to: 1 }],
                        1000,
                        am4core.ease.quadOut
                        );
                    });*/

                    var series = chart.series.push(new am4charts.ColumnSeries());
                    series.dataFields.categoryX = "kecamatan";
                    series.dataFields.valueY = "jumlah_anak";
                    series.columns.template.tooltipText = "{valueY.value}";
                    series.columns.template.tooltipY = 0;
                    series.columns.template.strokeOpacity = 0;

                    // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
                    series.columns.template.adapter.add("fill", function(fill, target) {
                        return chart.colors.getIndex(target.dataItem.index);
                    });


                }
            });

        })
    </script>
</body>

</html><?php /**PATH C:\Users\ASUS\Music\skripsi\pmks-anak-yatim\resources\views/home.blade.php ENDPATH**/ ?>