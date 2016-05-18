<!DOCTYPE html>

<?php
  require_once('connect.php');
?>
<?php
  if(isset($_POST['id_pekerjaan'])){
    $id_jabatan = $_POST['id_pekerjaan'];
    $nama = $_POST['nama_pekerjaan'];
    $ket = $_POST['keterangan_pekerjaan'];
    $kriteria1 = $_POST['kriteria1'];
    $kriteria2 = $_POST['kriteria2'];
    $kriteria3 = $_POST['kriteria3'];
    $kriteria4 = $_POST['kriteria4'];
    $kriteria5 = $_POST['kriteria5'];
    $kriteria6 = $_POST['kriteria6'];
    $kriteria7 = $_POST['kriteria7'];
    $kriteria8 = $_POST['kriteria8'];
    $kriteria9 = $_POST['kriteria9'];
    $kriteria10 = $_POST['kriteria10'];
    $sql="UPDATE posisi_pekerjaan SET nama_jabatan='$nama', keterangan_jabatan='$ket', nama_kriteria1='$kriteria1', nama_kriteria2='$kriteria2',
    nama_kriteria3='$kriteria3', nama_kriteria4='$kriteria4', nama_kriteria5='$kriteria5', nama_kriteria6='$kriteria6', nama_kriteria7='$kriteria7', nama_kriteria8='$kriteria8',
    nama_kriteria9='$kriteria9', nama_kriteria10='$kriteria10' 
    WHERE id_jabatan = '$id_jabatan'";
    $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));

    for ($i = 1 ; $i < 11; $i++){
      $kriteria = 'kriteria'.$i;
      // $nama_kriteria = $$kriteria;
      $bobot_kriteria = 'bobot_kriteria'.$i;
      if ($$kriteria == ''){
        $sql="UPDATE posisi_pekerjaan SET $bobot_kriteria='0'
        WHERE id_jabatan = '$id_jabatan'";
        $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
      }
    }

    //menambahkan row baru pada tabel perbandingan_skor jika terdapat kriteria baru
    $sql1="SELECT nama_kriteria FROM perbandingan_skor WHERE id_jabatan='$id_jabatan'";
    $res1=mysqli_query($connection, $sql1) or die (mysqli_error($connection));
    
    $arrayofkriteria = [];
    while ($hasil = mysqli_fetch_array($res1)){
      array_push($arrayofkriteria, $hasil['nama_kriteria']);
    }
    for ($i = 1; $i < 11; $i++){
      $boolean = 0; //false 
      $k = 'kriteria'.$i;
      $kriteria = $$k;
      $nama = 'nama_kriteria'.$i;
      if ($kriteria != ""){
        foreach ($arrayofkriteria as $key => $value){
          if ($value == $nama){
            $boolean++;
          }
        }
        if ($boolean == 0){ //tidak ada yang sama -> belum terdapat di database
          $sql2="INSERT into `perbandingan_skor` (id_jabatan, nama_kriteria) VALUES ('$id_jabatan', '$nama')";
          $res2=mysqli_query($connection, $sql2) or die (mysqli_error($connection));
        }
      }
    }

    //menghapus row dari tabel perbandingan_skor yang dihapus saat edit kriteria
    foreach ($arrayofkriteria as $key => $value){
      for ($i = 1; $i < 11; $i++){
        $k = 'kriteria'.$i;
        $kriteria = $$k;
        $nama = 'nama_kriteria'.$i;
        if ($value == $nama){
          if ($kriteria == ""){
            $sql3="DELETE from `perbandingan_skor` WHERE (id_jabatan='$id_jabatan' AND nama_kriteria = '$value')";
            $res3=mysqli_query($connection, $sql3) or die (mysqli_error($connection));
          }
        }
      }
    }

    $_SESSION['msg'] = "Kriteria untuk ".$nama." berhasil diedit";
    echo '<script>';
    echo 'window.location= "tailor-weight.php?posisi='.$id_jabatan.'";';
    echo '</script>';
  } 
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
                <h3 style="text-align: center"> Edit kriteria evaluasi:</h3>
                
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
                  <?php
                    if((isset($_GET['edit'])) && (isset($_GET['posisi'])) && ($_GET['edit'] == "kriteria")) {
                      $id = $_GET['posisi'];
                      if(isset($id)){
                        $query = mysqli_query($connection, "SELECT * FROM posisi_pekerjaan WHERE id_jabatan = '$id'");
                        $rslt = mysqli_fetch_assoc($query);
                      }
                    }
                  ?>
                  <form class="form" role="form" action= "tailor-criteria.php" method="POST">
                    <div class="input-group">
                      <span class="input-group-addon">ID Posisi Pekerjaan</span>
                      <input type="type" class="form-control" id="id_pekerjaan" name="id_pekerjaan" value = <?php echo $id; ?>>
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Posisi Pekerjaan</span>
                      <input type="text" class="form-control" id="nama_pekerjaan" name="nama_pekerjaan" value = "<?php echo $rslt['nama_jabatan']; ?>">
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Deskripsi Pekerjaan</span>
                      <textarea type="text" class="form-control" id="keterangan_pekerjaan" name="keterangan_pekerjaan"><?php echo $rslt['keterangan_jabatan']; ?></textarea>
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 1</span>
                      <input type="text" class="form-control" id="kriteria1" name="kriteria1" value = "<?php echo $rslt['nama_kriteria1']; ?>">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 2</span>
                      <input type="text" class="form-control" id="kriteria2" name="kriteria2" value = "<?php echo $rslt['nama_kriteria2']; ?>">   
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 3</span>
                      <input type="text" class="form-control" id="kriteria3" name="kriteria3" value = "<?php echo $rslt['nama_kriteria3']; ?>">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 4</span>
                      <input type="text" class="form-control" id="kriteria4" name="kriteria4" value = "<?php echo $rslt['nama_kriteria4']; ?>">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 5</span>
                      <input type="text" class="form-control" id="kriteria5" name="kriteria5" value = "<?php echo $rslt['nama_kriteria5']; ?>">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 6</span>
                      <input type="text" class="form-control" id="kriteria6" name="kriteria6" value = "<?php echo $rslt['nama_kriteria6']; ?>">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 7</span>
                      <input type="text" class="form-control" id="kriteria7" name="kriteria7" value = "<?php echo $rslt['nama_kriteria7']; ?>">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 8</span>
                      <input type="text" class="form-control" id="kriteria8" name="kriteria8" value = "<?php echo $rslt['nama_kriteria8']; ?>">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 9</span>
                      <input type="text" class="form-control" id="kriteria9" name="kriteria9" value = "<?php echo $rslt['nama_kriteria9']; ?>">  
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon">Kriteria 10</span>
                      <input type="text" class="form-control" id="kriteria10" name="kriteria10" value = "<?php echo $rslt['nama_kriteria10']; ?>">  
                    </div>
                    <br><br>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <a class="btn btn-warning btn-block" href="tailoring.php">BACK</a>
                      </div>
                      <div class="col-md-6">
                        <button type="submit" name="action" value="edit" class="btn btn-success btn-block">NEXT</button>
                      </div>
                    </div>
                    <br><br><br>
                  </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
</div>

    
</body>
</html>