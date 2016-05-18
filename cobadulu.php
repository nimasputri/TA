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


      
       <!--  <div class="contentwrapper">
            <ul class="nav nav-tabs">
                <li role="presentation" class="tab"><a href="index.php">Beranda</a></li>
                <li role="presentation" class="active tab"><a href="tailoring1.php">Penyesuaian Kriteria</a></li>
                <li role="presentation" class="tab"><a href="assessment.php">Penilaian Kandidat</a></li>
                <li role="presentation" class="tab"><a href="dashboard.php">Dashboard</a></li>
            </ul>
            <div>
                <h3 style="text-align: center"> Masukkan kriteria evaluasi:</h3>
                
                <?php
                  // if(!isset($_SESSION))
                  //   session_start();

                  // if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){
                  //   echo '<div class="alert alert-success">';
                  //   echo $_SESSION['msg'];
                  //   echo '</div>';
                  //   $_SESSION['msg'] = "";
                  // }
                ?>

                <br>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <?php if(isset($_POST['edit'])) {
                   
                    $id = $_POST['id_jabatan'];
                    $posisi_pekerjaan = mysqli_query($connection, "SELECT * FROM posisi_pekerjaan WHERE $id = '$id_jabatan'");
                    $posisi_pekerjaan = mysqli_fetch_assoc($posisi_pekerjaan);
                  ?>
                  <form class="form" role="form" action="tailoring1.php" method="POST">
                    <div class="input-group">
                      <span class="input-group-addon">Posisi Pekerjaan</span>
                      <input type="text" class="form-control" id="nama_pekerjaan" name="nama_pekerjaan" value = "<?php echo $posisi_pekerjaan['nama_jabatan']; ?>">
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Deskripsi Pekerjaan</span>
                      <textarea type="text" class="form-control" id="keterangan_pekerjaan" name="keterangan_pekerjaan" placeholder="deskripsi pekerjaan"></textarea>
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 1</span>
                      <input type="text" class="form-control" id="kriteria1" name="kriteria1">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 2</span>
                      <input type="text" class="form-control" id="kriteria2" name="kriteria2">   
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 3</span>
                      <input type="text" class="form-control" id="kriteria3" name="kriteria3">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 4</span>
                      <input type="text" class="form-control" id="kriteria4" name="kriteria4">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 5</span>
                      <input type="text" class="form-control" id="kriteria5" name="kriteria5">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 6</span>
                      <input type="text" class="form-control" id="kriteria6" name="kriteria6">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 7</span>
                      <input type="text" class="form-control" id="kriteria7" name="kriteria7">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 8</span>
                      <input type="text" class="form-control" id="kriteria8" name="kriteria8">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 9</span>
                      <input type="text" class="form-control" id="kriteria9" name="kriteria9">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 10</span>
                      <input type="text" class="form-control" id="kriteria10" name="kriteria10">  
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success btn-block">NEXT</button>
                    <a class="btn btn-warning btn-block" href="tailoring2.php">Edit Posisi Pekerjaan yang Sudah Tersimpan</a>
                  </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div> -->




    </div>
</div>

    
</body>
</html>