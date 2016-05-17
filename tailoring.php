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
            <div class="contentwrapper">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="tab"><a href="index.php">Dashboard</a></li>
                    <li role="presentation" class="active tab"><a href="tailoring.php">Penyesuaian Kriteria</a></li>
                    <li role="presentation" class="tab"><a href="assessment.php">Penilaian Kandidat</a></li>
                </ul>
                <div>
                    <h3 style="text-align: center"> Masukkan kriteria evaluasi:</h3>
                    
                    <?php
                      // if(!isset($_SESSION))
                      //   session_start();

                      // if(isset($_SESSION['msg']) && $_SESSION['msg'] != ""){
                      //   echo '<div class="btn-success col-md-12">';
                      //   echo $_SESSION['msg'];
                      //   echo '</div>';
                      //   $_SESSION['msg'] = "";
                      // }
                    ?>

                    <br>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <form class="form" role="form" action="tailoring.php" method="POST">
                          <div class="input-group">
                            <span class="input-group-addon">Posisi Pekerjaan</span>
                            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="nama pekerjaan"> 
                          </div>
                          <br>
                          <div class="input-group">
                            <span class="input-group-addon">Deskripsi Pekerjaan</span>
                            <textarea type="text" class="form-control" id="keterangan_jabatan" name="keterangan_jabatan" placeholder="deskripsi pekerjaan"></textarea>
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
                            <br>
                            <p style="text-align: center">atau</p>
                        </form>
                        <form action="tailor-criteria.php" class="form select-tailor" style="text-align:center" method="GET">
                          <td>
                            <?php
                              $sql="SELECT id_jabatan, nama_jabatan FROM posisi_pekerjaan";
                              $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                            ?>
                            Posisi Pekerjaan      :
                            <select name="posisi" id="posisi">
                              <option value = 0>--- pilih posisi ---</option>
                                <?php
                                  while ($row = mysqli_fetch_array($res)) {
                                    echo '<option value="'.$row['id_jabatan'].'">'.$row['nama_jabatan'].'</option>';
                                  }
                                ?>                            
                            </select><!-- 
                          </form> -->
                          </td>
                          <br><br>
                          <td>
                            <!-- <form action="tailoring1.php" method="POST" class="form select-tailor" style="text-align:center"> -->
                            <button type="submit" name="edit" value="kriteria" class="btn btn-warning btn-block">Edit Posisi Pekerjaan yang Sudah Tersimpan</button>
                            <input type="hidden" name="tipe" value="kriteria">
                          </td>
                        </form>
                        <br><br>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    </div>

    <?php
      if(isset($_POST['nama_jabatan'])){
        $sql1="SELECT id_jabatan FROM posisi_pekerjaan ORDER BY id_jabatan DESC LIMIT 1";
        $res1=mysqli_query($connection, $sql1) or die (mysqli_error($connection));
        if ($res1->num_rows < 1){
          $id_jabatan = 1;          

        } else {
          $id_jabatan = $res1->fetch_assoc()["id_jabatan"] + 1;
        }
        $nama_jabatan = $_POST['nama_jabatan'];
        $keterangan_jabatan = $_POST['keterangan_jabatan'];
        $kriteria1= $_POST['kriteria1'];
        $kriteria2= $_POST['kriteria2'];
        $kriteria3= $_POST['kriteria3'];
        $kriteria4= $_POST['kriteria4'];
        $kriteria5= $_POST['kriteria5'];
        $kriteria6= $_POST['kriteria6'];
        $kriteria7= $_POST['kriteria7'];
        $kriteria8= $_POST['kriteria8'];
        $kriteria9= $_POST['kriteria9'];
        $kriteria10= $_POST['kriteria10'];

        //menyimpan row tabel posisi pekerjaan
        $sql2="INSERT into `posisi_pekerjaan` (id_jabatan, nama_jabatan, keterangan_jabatan, nama_kriteria1, nama_kriteria2, nama_kriteria3, nama_kriteria4, nama_kriteria5, nama_kriteria6, nama_kriteria7, nama_kriteria8, nama_kriteria9, nama_kriteria10) VALUES ('$id_jabatan', '$nama_jabatan', '$keterangan_jabatan', '$kriteria1', '$kriteria2', '$kriteria3','$kriteria4', '$kriteria5', '$kriteria6', '$kriteria7', '$kriteria8', '$kriteria9', '$kriteria10')";
        $res2=mysqli_query($connection, $sql2) or die (mysqli_error($connection));

        //menyimpan row tabel untuk perbandingan bobot'
        $sql3="INSERT into `perbandingan_bobot` (id_jabatan) VALUES ('$id_jabatan')";
        $res3=mysqli_query($connection, $sql3) or die (mysqli_error($connection));
        $_SESSION['msg'] = "Kriteria untuk posisi pekerjaan ".$nama_jabatan." berhasil ditambahkan";

        //menyimpan row tabel untuk perbandingan skor
        for ($i = 1; $i < 11; $i++){
          $k = 'kriteria'.$i;
          $kriteria = $$k;
          $nama = 'nama_kriteria'.$i;
          if ($kriteria != ""){
            $sql5="INSERT into `perbandingan_skor` (id_jabatan, nama_kriteria) VALUES ('$id_jabatan', '$nama')";
            $res5=mysqli_query($connection, $sql5) or die (mysqli_error($connection));
          }
        }

        if ($id_jabatan != 0){
          echo '<script>';
          echo 'window.location= "tailor-weight.php?posisi='.$id_jabatan.'";';
          echo '</script>';
        } else {
          echo '<script>';
          echo 'window.location= "tailoring.php";';
          echo '</script>';
        }
      }
    ?>

</body>
</html>