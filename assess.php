<!DOCTYPE html>

<?php
  require_once('connect.php');
?>

<html>
<head>
  <title>SPK Seleksi SDM</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/flat-blue.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body class="flat-blue">
    <div class="app-container">
        <div class="content-container row">
            <nav class="navbar-fixed-top navbar-default">
                <div class="container-fluid">
                    <h1 class="apptitle">Sistem Pendukung Keputusan Seleksi SDM</h1>
                </div>
            </nav>
        </div>
        <div class="container-fluid">
            <div class="contentwrapper" id="contentwrapper">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="tab"><a href="index.php">Dashboard</a></li>
                    <li role="presentation" class="tab"><a href="tailoring.php">Penyesuaian Kriteria</a></li>
                    <li role="presentation" class="active tab"><a href="assessment.php">Penilaian Kandidat</a></li>
                </ul>
                <div class="col-md-6 daftar-kriteria" id="daftar-kriteria">
                    <div class="col-md-4">
                        <h3 class="center">KRITERIA</h3>
                       
                    </div>
                    <div class="col-md-8">
                        <div class="btn-group" role="group" aria-label="..." style="margin-top=15px">
                            <div class="btn-group" role="group" style="margin-top=10px">
                                <button type="button" class="btn btn-default btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Daftar Kriteria
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">KR0001</a></li>
                                    <li><a href="#">KR0002</a></li>
                                    <li><a href="#">KR0003</a></li>
                                    <li><a href="#">KR0004</a></li>
                                    <li><a href="#">KR0005</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 daftar-kandidat" id="daftar-kandidat">
                    <div class="col-md-4">
                        <h3 class="center">DATA KANDIDAT</h3>

                    </div>
                    <div class="col-md-8">
                        <div class="btn-group" role="group" aria-label="..." style="margin-top=15px">
                            <div class="btn-group" role="group" style="margin-top=10px">
                                <button type="button" class="btn btn-default btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Daftar Kandidat
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">KD0001</a></li>
                                    <li><a href="#">KD0002</a></li>
                                    <li><a href="#">KD0003</a></li>
                                    <li><a href="#">KD0004</a></li>
                                    <li><a href="#">KD0005</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $("#daftar-kandidat").height($("#contentwrapper").height() - $(".nav").height() - 20);
</script>
</html>