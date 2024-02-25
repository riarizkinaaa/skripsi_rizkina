

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
    <div class="col-md-6">
      <div class="card">
          <div class="card-header">
              <div class="header-top d-sm-flex justify-content-between align-items-center">
                  <h5>Pendidikan</h5>
              </div>
          </div>
          <div class="card-body">
              <div id="pendidikan" 
              style="width: 100% ;height: 400px;">
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


<script>
  $(document).ready(function() {
    $.ajax({
      url: 'json_anak',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        // status anak
        const id_pendata = `<?php echo e(Session::get('id_survior')); ?>`
        // console.log(id_pendata)
        const pendata = data['anak'].filter((id_survior) => id_survior.id_survior == id_pendata);
        // console.log(pendata)
        const anak_yatim = pendata.filter((status_anak) => status_anak.status_anak == 1);
        const anak_piatu = pendata.filter((status_anak) => status_anak.status_anak == 2);
        const yatim_piatu = pendata.filter((status_anak) => status_anak.status_anak == 3);

        const jumlah_yatim = anak_yatim.length;
        const jumlah_piatu = anak_piatu.length;
        const jumlah_yatim_piatu = yatim_piatu.length;
        // jenis kelamin
        const laki_laki = pendata.filter((jenis_kelamin) => jenis_kelamin.jenis_kelamin == 1);
        const perempuan = pendata.filter((jenis_kelamin) => jenis_kelamin.jenis_kelamin == 0);
        const jumlah_lk = laki_laki.length;
        const jumlah_pr = perempuan.length;

        // pendidikan
        const paud_tk = pendata.filter((id_pendidikan)=>id_pendidikan.id_pendidikan ==1);
        const belum_sekolah = pendata.filter((id_pendidikan)=>id_pendidikan.id_pendidikan ==2);
        const sdmi_sederajat = pendata.filter((id_pendidikan)=>id_pendidikan.id_pendidikan ==3);
        const belum_tamat_sdmi_sederajat = pendata.filter((id_pendidikan)=>id_pendidikan.id_pendidikan ==4);
        const tamat_sdmi_sederajat = pendata.filter((id_pendidikan)=>id_pendidikan.id_pendidikan ==5);
        const sltp_sederajat = pendata.filter((id_pendidikan)=>id_pendidikan.id_pendidikan ==6);
        const tamat_sltp_sederajat = pendata.filter((id_pendidikan)=>id_pendidikan.id_pendidikan ==7);
        const slta_sederajat = pendata.filter((id_pendidikan)=>id_pendidikan.id_pendidikan ==8);
        const tamat_slta = pendata.filter((id_pendidikan)=>id_pendidikan.id_pendidikan ==9);

        const jumlah_paud_tk = paud_tk.length; 
        const jumlah_belum_sekolah = belum_sekolah.length;
        const jumlah_sdmi_sederajat = sdmi_sederajat.length; 
        const jumlah_belum_tamat_sdmi_sederajat = belum_tamat_sdmi_sederajat.length; 
        const jumlah_tamat_sdmi_sederajat = tamat_sdmi_sederajat.length; 
        const jumlah_sltp_sederajat = sltp_sederajat.length;
        const jumlah_tamat_sltp_sederajat = tamat_sltp_sederajat.length; 
        const jumlah_slta_sederajat = slta_sederajat.length;
        const jumlah_tamat_slta = tamat_slta.length; 

        $("#paud_tk").append(paud_tk.length + " Orang")
        $("#belum_sekolah").append(belum_sekolah.length + " Orang")
        $("#sdmi_sederajat").append(sdmi_sederajat.length + " Orang")
        $("#belum_tamat_sdmi_sederajat").append(belum_tamat_sdmi_sederajat.length + " Orang")
        $("#tamat_sdmi_sederajat").append(tamat_sdmi_sederajat.length + " Orang")
        $("#sltp_sederajat").append(sltp_sederajat.length + " Orang")
        $("#tamat_sltp_sederajat").append(tamat_sltp_sederajat.length + " Orang")
        $("#slta_sederajat").append(slta_sederajat.length + " Orang")
        $("#tamat_slta").append(tamat_slta.length + " Orang")
        // $("#semua").append(pendata.length + " Orang")
        // $("#jumlah_paud_tk").append(jumlah_paud_tk.toFixed(2) + " %")
        // $("#jumlah_belum_sekolah").append(jumlah_belum_sekolah.toFixed(2) + " %")
        // $("#jumlah_sdmi_sederajat").append(jumlah_sdmi_sederajat.toFixed(2) + " %")
        // $("#jumlah_belum_tamat_sdmi_sederajat").append(jumlah_belum_tamat_sdmi_sederajat.toFixed(2) + " %")
        // $("#jumlah_tamat_sdmi_sederajat").append(jumlah_tamat_sdmi_sederajat.toFixed(2) + " %")
        // $("#_jumlah_sltp_sederajat").append(_jumlah_sltp_sederajat.toFixed(2) + " %")
        // $("#jumlah_tamat_sltp_sederajat").append(jumlah_tamat_sltp_sederajat.toFixed(2) + " %")
        // $("#tamat_slta_sederajat").append(tamat_slta_sederajat.toFixed(2) + " %")
        // $("#jumlah_tamat_slta").append(jumlah_tamat_slta.toFixed(2) + " %")


        // const kecamtan = data.filter((kecamtan) => kecamtan.id_kecamatan == id_kecamatan);
        $("#anak_yatim").append(anak_yatim.length + " Orang")
        $("#anak_piatu").append(anak_piatu.length + " Orang")
        $("#yatim_piatu").append(yatim_piatu.length + " Orang")
        $("#semua").append(pendata.length + " Orang")
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

        // grafik jenis_kelamin
var chartJenisKelamin = am4core.create("jenis_kelamin", am4charts.PieChart);

// Add data
chartJenisKelamin.data = [{
  "jenis_kelamin": "Laki Laki",
  "jumlah": jumlah_lk
}, {
  "jenis_kelamin": "Perempuan",
  "jumlah": jumlah_pr
}];

// Add and configure Series
var pieSeriesJenisKelamin = chartJenisKelamin.series.push(new am4charts.PieSeries());
pieSeriesJenisKelamin.dataFields.value = "jumlah";
pieSeriesJenisKelamin.dataFields.category = "jenis_kelamin";
pieSeriesJenisKelamin.innerRadius = am4core.percent(50);
pieSeriesJenisKelamin.ticks.template.disabled = true;
pieSeriesJenisKelamin.labels.template.disabled = true;

var rgmJenisKelamin = new am4core.LinearGradientModifier();
rgmJenisKelamin.brightnesses.push(0, -0.4);
pieSeriesJenisKelamin.slices.template.fillModifier = rgmJenisKelamin;

var rgm2JenisKelamin = new am4core.LinearGradientModifier();
rgm2JenisKelamin.brightnesses.push(0, -0.4);

pieSeriesJenisKelamin.slices.template.strokeModifier = rgm2JenisKelamin;
pieSeriesJenisKelamin.slices.template.strokeOpacity = 1;
pieSeriesJenisKelamin.slices.template.strokeWidth = 1;

chartJenisKelamin.legend = new am4charts.Legend();
chartJenisKelamin.legend.position = "right";

pieSeriesJenisKelamin.slices.template.events.on("validated", function(event) {
  var gradient = event.target.fillModifier.gradient
  gradient.rotation = event.target.middleAngle + 90;

  var gradient2 = event.target.strokeModifier.gradient
  gradient2.rotation = event.target.middleAngle + 90;
});

// grafik pendidikan
var chartPendidikan = am4core.create("pendidikan", am4charts.PieChart);

// Add data
// Add data
chartPendidikan.data = [
    { "pendidikan": "paud tk", "jumlah": jumlah_paud_tk },
    { "pendidikan": "belum sekolah", "jumlah": jumlah_belum_sekolah },
    { "pendidikan": "sd/mi sederajat", "jumlah": jumlah_sdmi_sederajat },
    { "pendidikan": "belum tamat sd/mi sederajat", "jumlah": jumlah_belum_tamat_sdmi_sederajat },
    { "pendidikan": "tamat sd/mi sederajat", "jumlah": jumlah_tamat_sdmi_sederajat },
    { "pendidikan": "sltp sederajat", "jumlah": jumlah_sltp_sederajat },
    { "pendidikan": "tamat sltp sederajat", "jumlah": jumlah_tamat_sltp_sederajat },
    { "pendidikan": "slta sederajat", "jumlah": jumlah_slta_sederajat },
    { "pendidikan": "tamat slta", "jumlah": jumlah_tamat_slta }
];


// Add and configure Series
var pieSeriesPendidikan = chartPendidikan.series.push(new am4charts.PieSeries());
pieSeriesPendidikan.dataFields.value = "jumlah";
pieSeriesPendidikan.dataFields.category = "pendidikan";
pieSeriesPendidikan.innerRadius = am4core.percent(50);
pieSeriesPendidikan.ticks.template.disabled = true;
pieSeriesPendidikan.labels.template.disabled = true;

var rgmPendidikan = new am4core.LinearGradientModifier();
rgmPendidikan.brightnesses.push(0, -0.4);
pieSeriesPendidikan.slices.template.fillModifier = rgmPendidikan;

var rgm2Pendidikan = new am4core.LinearGradientModifier();
rgm2Pendidikan.brightnesses.push(0, -0.4);

pieSeriesPendidikan.slices.template.strokeModifier = rgm2Pendidikan;
pieSeriesPendidikan.slices.template.strokeOpacity = 1;
pieSeriesPendidikan.slices.template.strokeWidth = 1;

chartPendidikan.legend = new am4charts.Legend();
chartPendidikan.legend.position = "right";

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

<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.survior.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Music\skripsi\pmks-anak-yatim\resources\views/survior/dashboard.blade.php ENDPATH**/ ?>