<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard Kenangan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="/assets/dist/css/skins/skin-black.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition skin-black sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>K</b>NA</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>KENANGAN </b></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="/login" class="dropdown-toggle">
                <!-- The user image in the navbar-->
                <img src="/logo/pemko.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span><strong>MASUK</strong></span>
              </a>

            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="/logo/pemko.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Dashboard</p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Kenangan</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">NAVIGATION</li>
          <!-- Optionally, you can add icons to the links -->
          <li class="active"><a href="/login"><i class="fa fa-sign-in"></i> <span>Masuk</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">


        <div class="row">
          <div class="col-lg-6">
            <div class="col-md-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner text-center">
                  <h3>50<sup style="font-size: 20px">%</sup></h3>

                  <h4>REALISASI KEUANGAN</h4>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner text-center">
                  <h3>75<sup style="font-size: 20px">%</sup></h3>

                  <h4>REALISASI FISIK</h4>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div id="chartContainer" style="height: 320px; width: 100%;"></div>
              <br />
              <div id="chartContainer3" style="height: 320px; width: 100%;"></div>
            </div>
          </div>

          <div class="col-lg-6">

            <div id="chartContainer2" style="height: 320px; width: 100%;"></div>
            <br />
            <div class="box">
              <div class="box-body">

                <table class="table table-bordered">
                  <tr style="font-size: 20px;text-align:center">
                    <td colspan=2>Target Penyerapan Anggaran</td>
                  </tr>
                  <tr style="text-align:center">
                    <td>Triwulan I</td>
                    <td>25 %</td>
                  </tr>
                  <tr style="text-align:center">
                    <td>Triwulan II</td>
                    <td>50 %</td>
                  </tr>
                  <tr style="text-align:center">
                    <td>Triwulan III</td>
                    <td>75 %</td>
                  </tr>
                  <tr style="text-align:center">
                    <td>Triwulan VI</td>
                    <td>100 %</td>
                  </tr>
                </table>

                <br />
                <br />
                <br />
                <!-- Progress bars -->
                <div class="clearfix">
                  <span class="pull-left">Realisasi Fisik</span>
                  <small class="pull-right">75%</small>
                </div>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-red" style="width: 75%;"></div>
                </div>

                <div class="clearfix">
                  <span class="pull-left">Realisasi Keuangan</span>
                  <small class="pull-right">50%</small>
                </div>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-blue" style="width: 50%;"></div>
                </div>

              </div>
            </div>

          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="col-md-12">
              <br />
              <div class="box">
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr style="background-color: antiquewhite">
                      <td>No</td>
                      <td>Kode</td>
                      <td>SKPD</td>
                      <td>Keuangan</td>
                      <td>Fisik</td>
                    </tr>
                    @foreach ($skpd as $key => $item)
                    <tr>
                      <td>{{$key + 1}}</td>
                      <td>{{$item->kode_skpd}}</td>
                      <td>{{$item->nama}}</td>
                      <td>50 %</td>
                      <td>75 %</td>
                    </tr>
                    @endforeach
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

      <!-- Main content -->
      <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="pull-right hidden-xs">
        Pembangunan
      </div>
      <!-- Default to the left -->
      <strong>Development By Diskominfotik 2024</strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
          <h3 class="control-sidebar-heading">Recent Activity</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:;">
                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                  <p>Will be 23 on April 24th</p>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

          <h3 class="control-sidebar-heading">Tasks Progress</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:;">
                <h4 class="control-sidebar-subheading">
                  Custom Template Design
                  <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
          <form method="post">
            <h3 class="control-sidebar-heading">General Settings</h3>

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Report panel usage
                <input type="checkbox" class="pull-right" checked>
              </label>

              <p>
                Some information about this general settings option
              </p>
            </div>
            <!-- /.form-group -->
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->
  <script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/assets/dist/js/adminlte.min.js"></script>

  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
  <script>
    window.onload = function () {
    
    var chart = new CanvasJS.Chart("chartContainer", {
        title: {
            text: "Realisasi Fisik Dan Keuangan 2025"
        },
        axisX: {
            interval: 1,
            intervalType: "month",
            valueFormatString: "MMM"
        },
        toolTip: {
            shared: true
        },
        legend: {
            cursor: "pointer",
            verticalAlign: "bottom",
            horizontalAlign: "center",
            dockInsidePlotArea: true,
            itemclick: toogleDataSeries
        },
        data: [{
            type:"line",
            name: "Keuangan",
            showInLegend: true,
            markerSize: 0,
            yValueFormatString: "Rp,#,###k",
            dataPoints: [		
                { x: new Date(2014, 00, 01), y: 850 },
                { x: new Date(2014, 01, 01), y: 889 },
                { x: new Date(2014, 02, 01), y: 890 },
                { x: new Date(2014, 03, 01), y: 899 },
                { x: new Date(2014, 04, 01), y: 903 },
                { x: new Date(2014, 05, 01), y: 925 },
                { x: new Date(2014, 06, 01), y: 899 },
                { x: new Date(2014, 07, 01), y: 875 },
                { x: new Date(2014, 08, 01), y: 927 },
                { x: new Date(2014, 09, 01), y: 949 },
                { x: new Date(2014, 10, 01), y: 946 },
                { x: new Date(2014, 11, 01), y: 927 },
            ]
        },
        {
            type: "line",
            name: "Fisik",
            showInLegend: true,
            markerSize: 0,
            yValueFormatString: "Rp,#,###k",
            dataPoints: [
                { x: new Date(2014, 00, 01), y: 1200 },
                { x: new Date(2014, 01, 01), y: 1200 },
                { x: new Date(2014, 02, 01), y: 1200 },
                { x: new Date(2014, 03, 01), y: 1180 },
                { x: new Date(2014, 04, 01), y: 1250 },
                { x: new Date(2014, 05, 01), y: 1270 },
                { x: new Date(2014, 06, 01), y: 1300 },
                { x: new Date(2014, 07, 01), y: 1300 },
                { x: new Date(2014, 08, 01), y: 1358 },
                { x: new Date(2014, 09, 01), y: 1410 },
                { x: new Date(2014, 10, 01), y: 1480 },
                { x: new Date(2014, 11, 01), y: 1500 }
            ]
        }]
    });
    chart.render();

    var chart2 = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        title:{
            text: "Periode November 2025"
        },
        
        data: [{        
            type: "column",  
            indexLabel: "{y}",
            legendMarkerColor: "grey",
            dataPoints: [      
                { y: 3322266878, label: "Pagu" },
                { y: 3322266755,  label: "Rencana" },
                { y: 3322266709,  label: "Realisasi" },
            ]
        }]
    });
    chart2.render();

        var chart3 = new CanvasJS.Chart("chartContainer3", {
        animationEnabled: true,
        title:{
            text: "Kategori Capaian SKPD Triwulan I"
        },
        legend:{
            cursor: "pointer",
            itemclick: explodePie
        },
        data: [{
            type: "pie",
            showInLegend: true,
            toolTipContent: "{name}: <strong>{y} SKPD </strong>",
            indexLabel: "{name} - {y} SKPD ",
            dataPoints: [
                { y: 6, name: "SANGAT BAIK"},
                { y: 20, name: "BAIK" },
                { y: 5, name: "KURANG" },
                { y: 3, name: "CUKUP" }
            ]
        }]
    });
    chart3.render();

    function explodePie (e) {
        if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
        } else {
            e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
        }
        e.chart.render();

    }

    function toogleDataSeries(e){
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else{
            e.dataSeries.visible = true;
        }
        chart.render();
    }
    
    }
  </script>

</body>


</html>