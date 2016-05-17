<!DOCTYPE html>

<?php
  require_once('connect.php');
?>
<?php
  if(isset($_GET['posisi']) && isset($_POST['action']) && ($_POST['action'] == "weight-edit")){    
    $id = $_GET['posisi'];
    $sql="SELECT * FROM posisi_pekerjaan WHERE id_jabatan='$id'";
    $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
    $hasil = $res->fetch_assoc();

    $kr = [];
    //x dan y adalah indeks nomor kriteria, bukan matriks yg ditampilkan
    for ($x=1; $x<11; $x++){
      for ($y=1; $y<11; $y++)
      if ($hasil['nama_kriteria'.$x] != "" && $hasil['nama_kriteria'.$y] != "" && ($x < $y)){
        $kriteria_val = 'k'.$x.'_'.$y.'';
        array_push($kr, $kriteria_val);
      } 
    }

    $array_bobot = [];
    $kriteria = 0;
    for ($i = 1; $i < 11; $i++){
      if ($hasil['nama_kriteria'.$i] != ""){
        array_push($array_bobot, $hasil['bobot_kriteria'.$i]);
        $kriteria++;
      }
    }

    //simpan sementara bobot akhir
    $index_bobot = [];
    for ($i = 1; $i < 11; $i++){
      if ($hasil['nama_kriteria'.$i] != ""){
        array_push($index_bobot, 'bobot_kriteria'.$i);
      }
    }

    $arrayofindex = []; //semua nilai matriks (yang ditampilkan), baik yang disimpan ke db maupun engga
    // x dan y adalah indeks matriks
    for ($x=1; $x<=$kriteria; $x++){
      for ($y=1; $y<=$kriteria; $y++){
        if ($x == $y){
          $val = '1';
        } else if ($x < $y){
          $val = $_POST['k'.$x.'_'.$y.''];
        } else {
          $val0 = $_POST['k'.$y.'_'.$x.''];
          if ($val0 != 0){
            $val = 1/$val0;
          } else {
            $val = '0';
          }
        }
        array_push($arrayofindex, $val);
      }
    }

    $arrayofcolumn = []; //jumlah nilai kolom

    for ($in = 0; $in < $kriteria; $in++){
      $total_col = 0;
      $arrayindex = $in;
      for ($index = 0; $index < $kriteria; $index++){
        $total_col = $total_col + $arrayofindex[$arrayindex];
        $arrayindex = $arrayindex + $kriteria;
      }
      array_push($arrayofcolumn, $total_col);
    }

    //menghitung rata2 baris/bobot akhir
    $arrayofnorm = []; //array hasil normalisasi
    $arrayofrow = []; //array rata2 tiap baris
    $iterasi = 0;
    for ($indexnorm = 0; $indexnorm < $kriteria; $indexnorm++){

      $eigen = 0;
      for ($indexcol = 0; $indexcol < $kriteria; $indexcol++){
        $cellnorm = $arrayofindex[$iterasi] / $arrayofcolumn[$indexcol];
        array_push($arrayofnorm, $cellnorm);
        $iterasi++;
        $eigen = $eigen + $cellnorm;
      }
      $eigenrow = $eigen/$kriteria;
      array_push($arrayofrow, $eigenrow);
    }

    //simpan bobot akhir
    for ($in = 0; $in < $kriteria; $in++){
      $sql1="UPDATE posisi_pekerjaan SET $index_bobot[$in] = '$arrayofrow[$in]' WHERE id_jabatan = '$id'";
      $res1=mysqli_query($connection, $sql1) or die (mysqli_error($connection));
      $iterasi++;
    }

    //simpan perbandingan
    $iterasi = 0;
    for ($row=1; $row<= $kriteria; $row++){
      for ($col=1; $col<= $kriteria; $col++){
        if ($row < $col){
          $val = $_POST['k'.$row.'_'.$col.''];
          $sql="UPDATE perbandingan_bobot SET $kr[$iterasi] = '$val' WHERE id_jabatan = '$id'";
          $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
          $iterasi++;
        }
      } 
    }

    echo '<script>';
    echo 'window.location= "assessment.php?posisi='.$id.'";';
    echo '</script>';
  } 

  else if (isset($_POST['action']) && ($_POST['action'] == "revert")){
    $id = $_GET['posisi'];
    $sql="SELECT * FROM posisi_pekerjaan WHERE id_jabatan='$id'";
    $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
    $hasil = $res->fetch_assoc();

    $kriteria = 0;
    for ($i = 1; $i < 11; $i++){
      if ($hasil['nama_kriteria'.$i] != ""){
        $kriteria++;
      }
    }

    $kr = [];
    //x dan y adalah indeks nomor kriteria, bukan matriks yg ditampilkan
    for ($x=1; $x<11; $x++){
      for ($y=1; $y<11; $y++)
      if ($hasil['nama_kriteria'.$x] != "" && $hasil['nama_kriteria'.$y] != "" && ($x < $y)){
        $kriteria_val = 'k'.$x.'_'.$y.'';
        array_push($kr, $kriteria_val);
      } 
    }

    //revert
    $iterasi_rev = 0;
    for ($n = 1; $n <= $kriteria; $n++){
      for ($m = 1; $m <= $kriteria; $m++){
        if ($n < $m){  
          $val = $_POST[$n.'_'.$m];
          $sql="UPDATE perbandingan_bobot SET $kr[$iterasi_rev] = '$val' WHERE id_jabatan = '$id'";
          $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
          $iterasi_rev++;
        }
      }
    }
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
                <?php
                  if((isset($_GET['posisi'])) && ($_GET['posisi'] != "0")) {
                    $id = $_GET['posisi'];
                    $sql="SELECT nama_jabatan FROM posisi_pekerjaan WHERE id_jabatan='$id'";
                    $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                    $hasil = $res->fetch_assoc();
                    echo'<h3 style="text-align: center"> Edit bobot kriteria evaluasi posisi pekerjaan '.$hasil['nama_jabatan'].'  :</h3>';
                  }
                ?>
                <br>
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <form class="form" role="form" action="tailor-weight.php?posisi=<?php echo $_GET['posisi']; ?>" method="POST">
                    <table class="table table-bordered fixed" style="text-align: center">
                      <?php
                        if((isset($_GET['posisi'])) && ($_GET['posisi'] != "0")) {
                          $id = $_GET['posisi'];
                          $sql="SELECT * FROM posisi_pekerjaan, perbandingan_bobot WHERE posisi_pekerjaan.id_jabatan=perbandingan_bobot.id_jabatan AND posisi_pekerjaan.id_jabatan='$id'";
                          $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                          $hasil = $res->fetch_assoc();
                          echo'<tr>';
                            echo'<td width ="120"></td>';
                          $kriteria = 0;
                          $nama_kriteria = [];
                          for ($i = 1; $i < 11; $i++){
                            if ($hasil['nama_kriteria'.$i] != ""){
                              echo'<td width ="120">'.$hasil['nama_kriteria'.$i].'</td>';
                              array_push($nama_kriteria, $hasil['nama_kriteria'.$i]);
                              $kriteria++;
                            }
                          }
                          echo'</tr>';

                          $indexofkr = []; //array yg berisi indeks perbandingan kriteria yang terisi (sesuai database)
                          // n dan m adalah nomor kriteria di database
                          $kr = []; //array value tiap indeks sesuai database
                          for ($x=1; $x<11; $x++){
                            for ($y=1; $y<11; $y++){
                              if ($hasil['nama_kriteria'.$x] != "" && $hasil['nama_kriteria'.$y] != "" && ($x < $y)){
                                $kriteria_val = 'k'.$x.'_'.$y.'';
                                array_push($kr, $hasil[$kriteria_val]);
                                array_push($indexofkr, $kriteria_val);
                              } else if ($hasil['nama_kriteria'.$x] != "" && $hasil['nama_kriteria'.$y] != "" && ($x == $y)){
                                $kriteria_val = 'k'.$x.'_'.$y.'';
                                array_push($kr, '1');
                                array_push($indexofkr, $kriteria_val);
                              } else if ($hasil['nama_kriteria'.$x] != "" && $hasil['nama_kriteria'.$y] != "" && ($x > $y)){
                                $kr_val = 'k'.$x.'_'.$y.'';
                                $kriteria_val = 'k'.$y.'_'.$x.'';
                                if ($hasil[$kriteria_val] != 0){
                                  $kriteria_val2= 1/$hasil[$kriteria_val];
                                  array_push($kr, $kriteria_val2);
                                } else {
                                  array_push($kr, '');
                                }
                                array_push($indexofkr, $kr_val);
                              }
                            }
                          }

                          if (isset($_POST['action']) && $_POST['action'] == "consistency"){
                            $arrayofindex = []; //semua nilai matriks (yang ditampilkan), baik yang disimpan ke db maupun engga
                            // x dan y adalah indeks matriks
                            for ($x=1; $x<=count($nama_kriteria); $x++){
                              for ($y=1; $y<=count($nama_kriteria); $y++){
                                $kriteria = 'k'.$x.'_'.$y.'';
                                if ($x == $y){
                                  $val = '1';
                                } else if ($x < $y){
                                  $val = $_POST['k'.$x.'_'.$y.''];
                                } else {
                                  $val0 = $_POST['k'.$y.'_'.$x.''];
                                  if ($val0 != 0){
                                    $val = 1/$val0;
                                  } else {
                                    $val = '0';
                                  }
                                }
                                array_push($arrayofindex, $val);
                              } 
                            }

                            $iterasi = 0;
                            for ($n = 1; $n <= count($nama_kriteria); $n++){
                              if ($nama_kriteria[$n-1] != ""){
                                echo '<tr height = "30">';
                                echo'<td>'.$nama_kriteria[$n-1].'</td>';
                                for($m = 1; $m <= count($nama_kriteria); $m++){
                                  if ($nama_kriteria[$n-1] != ""){
                                    if ($m > $n) {                                      
                                      echo'<td><input type="text" class="form-control" style="text-align: center" id="k'.$n.'_'.$m.'" name="k'.$n.'_'.$m.'" value = "'.$arrayofindex[$iterasi].'"></td>';
                                      echo'<input type="hidden" class="form-control" style="text-align: center" id="'.$n.'_'.$m.'" name="'.$n.'_'.$m.'" value = "'.$kr[$iterasi].'">';
                                    } 
                                    else {
                                      echo'<td>'.$arrayofindex[$iterasi].'</td>';
                                    }
                                  }
                                  $iterasi++;
                                }
                              }
                            }
                          echo'</tr>';
                          }

                          else { //n dan m adalah indeks matriks yg muncul
                            $iterasi = 0;
                            for ($n = 1; $n <= count($nama_kriteria); $n++){
                              echo '<tr height = "30">';
                              echo'<td>'.$nama_kriteria[$n-1].'</td>';
                              for($m = 1; $m <= count($nama_kriteria); $m++){
                                $index_val = 'k'.$n.'_'.$m;
                                if ($m > $n) {
                                  echo'<td><input type="text" class="form-control" style="text-align: center" id="k'.$n.'_'.$m.'" name="k'.$n.'_'.$m.'" value = "'.$kr[$iterasi].'"></td>';
                                  echo'<input type="hidden" class="form-control" style="text-align: center" id="'.$n.'_'.$m.'" name="'.$n.'_'.$m.'" value = "'.$kr[$iterasi].'">';
                                } 
                                else {
                                  echo'<td>'.$kr[$iterasi].'</td>';
                                }
                                $iterasi++;
                              }
                            }
                          echo'</tr>';
                          }
                        }
                      

                      // <!-- untuk menghitung bobot akhir -->
                        if(isset($_GET['posisi']) && isset($_POST['action'])){
                          $id = $_GET['posisi'];
                          $sql="SELECT * FROM posisi_pekerjaan WHERE id_jabatan='$id'";
                          $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                          $hasil = $res->fetch_assoc();
                          
                          $jum_kriteria = 0;
                          for ($i=1; $i<11; $i++){
                            if ($hasil['nama_kriteria'.$i] != ""){
                              $jum_kriteria++;
                            }
                          }

                          $arrayofindex = []; //semua nilai matriks (yang ditampilkan), baik yang disimpan ke db maupun engga
                          // x dan y adalah indeks matriks
                          for ($x=1; $x<=$jum_kriteria; $x++){
                            for ($y=1; $y<=$jum_kriteria; $y++){
                              $kriteria = 'k'.$x.'_'.$y.'';
                              if ($x == $y){
                                $val = '1';
                              } else if ($x < $y){
                                $val = $_POST['k'.$x.'_'.$y.''];
                              } else {
                                $val0 = $_POST['k'.$y.'_'.$x.''];
                                if ($val0 != 0){
                                  $val = 1/$val0;
                                } else {
                                  $val = '0';
                                }
                              }
                              array_push($arrayofindex, $val);
                            } 
                          }

                          $arrayofcolumn = []; //jumlah nilai kolom
                          for ($in = 0; $in < $jum_kriteria; $in++){
                            $total_col = 0;
                            $arrayindex = $in;
                            for ($index = 0; $index < $jum_kriteria; $index++){
                              $total_col = $total_col + $arrayofindex[$arrayindex];
                              $arrayindex = $arrayindex + $jum_kriteria;
                            }
                            array_push($arrayofcolumn, $total_col);
                          }

                          //menghitung rata2 baris/bobot akhir
                          $arrayofnorm = []; //array hasil normalisasi
                          $arrayofrow = []; //array rata2 tiap baris
                          $iterasi = 0;
                          $loop = 0;
                          for ($indexnorm = 0; $indexnorm < $jum_kriteria; $indexnorm++){
                            $eigen = 0;
                            for ($indexcol = 0; $indexcol < $jum_kriteria; $indexcol++){
                              $cellnorm = $arrayofindex[$iterasi] / $arrayofcolumn[$indexcol];
                              array_push($arrayofnorm, $cellnorm);
                              $iterasi++;
                              $eigen = $eigen + $cellnorm;
                            }
                            $eigenrow = $eigen/$jum_kriteria;
                            array_push($arrayofrow, $eigenrow);
                            $loop++;
                          }
                        }
                      ?>  
                    </table>
                    <br>
                    <?php
                    if ($kriteria <= 10){
                      echo'<div class="col-md-12">
                        <div class="col-md-6">
                          <a class="btn btn-warning btn-block" href="tailor-criteria.php?posisi='.$_GET['posisi'].'&edit=kriteria">EDIT KRITERIA</a>
                        </div>
                        <div class="col-md-6">
                          <button type="submit" name="action" value="consistency" class="btn btn-warning btn-block">CEK KONSISTENSI</button>
                        </div>
                      <div>';
                    } else{
                      echo'<div class="col-md-3"></div>
                      <div class="col-md-6">
                          <a class="btn btn-warning btn-block" href="tailor-criteria.php?posisi='.$_GET['posisi'].'&edit=kriteria">EDIT KRITERIA</a>
                      </div>
                      <div class="col-md-3"></div>';
                    }
                    ?>
                      <!-- menghitung eigen faktor -->
                      <!-- untuk menghitung bobot akhir -->
                      <?php
                        if(isset($_GET['posisi']) && isset($_POST['action']) && ($_POST['action'] == "consistency")){
                          $id = $_GET['posisi'];
                          $sql="SELECT * FROM posisi_pekerjaan WHERE id_jabatan='$id'";
                          $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                          $hasil = $res->fetch_assoc();
                          
                          $jum_kriteria = 0;
                          $array_nama = [];
                          for ($i=1; $i<11; $i++){
                            if ($hasil['nama_kriteria'.$i] != ""){
                              $jum_kriteria++;
                              array_push($array_nama, $hasil['nama_kriteria'.$i]);
                            }
                          }

                          $arrayofindex = []; //semua nilai matriks (yang ditampilkan), baik yang disimpan ke db maupun engga
                          // x dan y adalah indeks matriks
                          for ($x=1; $x<=$jum_kriteria; $x++){
                            for ($y=1; $y<=$jum_kriteria; $y++){
                              $kriteria = 'k'.$x.'_'.$y.'';
                              if ($x == $y){
                                $val = '1';
                              } else if ($x < $y){
                                $val = $_POST['k'.$x.'_'.$y.''];
                              } else {
                                $val0 = $_POST['k'.$y.'_'.$x.''];
                                if ($val0 != 0){
                                  $val = 1/$val0;
                                } else {
                                  $val = '0';
                                }
                              }
                              array_push($arrayofindex, $val);
                            } 
                          }

                          $indexofkr = []; //array yg berisi indeks perbandingan kriteria yang terisi (sesuai database)
                          // n dan m adalah nomor kriteria di database
                          for ($m=1; $m<11; $m++){
                            for ($n=1; $n<11; $n++){
                              if($hasil['nama_kriteria'.$n] != "" && $hasil['nama_kriteria'.$m] != "" ){
                                $kr = 'k'.$m.'_'.$n.'';     //kriteria yang terisi di db --> perbandngan yg terisi
                                array_push($indexofkr, $kr);
                              }
                            } 
                          }

                          $arrayofcolumn = []; //jumlah nilai kolom
                          for ($in = 0; $in < $jum_kriteria; $in++){
                            $total_col = 0;
                            $arrayindex = $in;
                            for ($index = 0; $index < $jum_kriteria; $index++){
                              $total_col = $total_col + $arrayofindex[$arrayindex];
                              $arrayindex = $arrayindex + $jum_kriteria;
                            }
                            array_push($arrayofcolumn, $total_col);
                          }

                          //menghitung rata2 baris/bobot akhir
                          $arrayofnorm = []; //array hasil normalisasi
                          $arrayofrow = []; //array rata2 tiap baris
                          $iterasi = 0;
                          for ($indexnorm = 0; $indexnorm < $jum_kriteria; $indexnorm++){
                            $eigen = 0;
                            for ($indexcol = 0; $indexcol < $jum_kriteria; $indexcol++){
                              $cellnorm = $arrayofindex[$iterasi] / $arrayofcolumn[$indexcol];
                              array_push($arrayofnorm, $cellnorm);
                              $iterasi++;
                              $eigen = $eigen + $cellnorm;
                            }
                            $eigenrow = $eigen/$jum_kriteria;
                            array_push($arrayofrow, $eigenrow);
                          }

                          $eigen_factor = 0;
                          for ($indexeigen = 0; $indexeigen < $jum_kriteria; $indexeigen++){
                            $eigen_factor = $eigen_factor + ($arrayofrow[$indexeigen] * $arrayofcolumn[$indexeigen]);
                          }

                          // menghitung rasio konsistensi
                          $consistency_index = ($eigen_factor - $jum_kriteria)/($jum_kriteria - 1);
                         
                          // random index
                          switch ($jum_kriteria) {
                            case "2":
                              $RI = '0';
                              break;
                            case "3":
                              $RI = '0.58';
                              break;
                            case "4":
                              $RI = '0.90';
                              break;
                            case "5":
                              $RI = '1.12';
                              break; 
                            case "6":
                              $RI = '1.24';
                              break;
                            case "7":
                              $RI = '1.32';
                              break;
                            case "8":
                              $RI = '1.41';
                              break;
                            case "9":
                              $RI = '1.45';
                              break;
                            case "10":
                              $RI = '1.51';
                              break;
                          }

                          $consistency_ratio = $consistency_index/$RI;
                          // print ($consistency_ratio);
                          if ($consistency_ratio < 0.1){
                            $rasio = '(Perbandingan Konsisten)';
                          } else if ($consistency_ratio == 0.1){
                            $rasio = '(Perbandingan Sedikit Tidak Konsisten)';
                          } else {
                            $rasio = '(Perbandingan Tidak Konsisten)';
                          }
                          echo '<br><br><br><div class="col-md-12" style= "text-align:center">';
                          echo 'CONSISTENCY RATIO = '.$consistency_ratio.'';
                          echo '<br>'.$rasio.'<br><br>';
                          for($in = 0; $in < $jum_kriteria; $in++) {
                             echo 'Bobot akhir '.$array_nama[$in].' : '.$arrayofrow[$in];
                             echo '<br>';
                           }
                          echo'<br></div>';
                        }
                      ?>
                    </div>
                    </div>
                    <br><br><br>
                    <div class="col-md-12">
                      <div class="col-md-3"></div>
                      <div class="col-md-6">
                          <button type="submit" name="action" value="revert" class="btn btn-danger btn-block">REVERT</button>
                          <br>
                      </div>
                      <div class="col-md-3"></div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-3"></div>
                      <div class="col-md-6">
                          <button type="submit" name="action" value="weight-edit" class="btn btn-success btn-block">SUBMIT</button>
                          <br><br>
                      </div>
                      <div class="col-md-3"></div>
                    </div>
                    <br><br><br>
                  </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
  </div>
</body>
</html>