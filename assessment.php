<!DOCTYPE html>

<?php
  require_once('connect.php');
?>
<?php
  if ((isset($_GET['edit'])) && (isset($_GET['posisi'])) && ($_GET['edit'] == "kriteria")){
    $id_jabatan = $_GET['posisi'];
    echo '<script>';
    echo 'window.location= "tailor-criteria.php?posisi='.$id_jabatan.'&edit=kriteria";';
    echo '</script>';
  } else if ((isset($_GET['edit'])) && (isset($_GET['posisi'])) && ($_GET['edit'] == "assess")){
    $id_jabatan = $_GET['posisi'];
  }
?>

<?php
    if(isset($_GET['posisi']) && isset($_GET['action']) && ($_GET['action'] == "score-edit")){  
        $id_jabatan = $_GET['posisi'];
        $kriteria = $_GET['kriteria'];

        $jum_kandidat = 0;
        $sql="SELECT * FROM melamar, kandidat WHERE melamar.id_jabatan = '$id_jabatan' AND kandidat.id_kandidat = melamar.id_kandidat";
        $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
        $array_kandidat = [];
        $array_id_kandidat =[];
        $jum_kandidat = 0;
        while ($row = mysqli_fetch_array($res)){
            array_push($array_kandidat, $row['nama_kandidat']);
            array_push($array_id_kandidat, $row['id_kandidat']);
            $jum_kandidat++;
        }

        for ($i = 1; $i <= $jum_kandidat; $i++){
            for ($j = 1; $j <= $jum_kandidat; $j++){
                if ($i < $j){
                    $value = $_GET['kandidat'.$i.'_'.$j];
                    $key = 'kandidat'.$i.'_'.$j;
                    $sql1="UPDATE perbandingan_skor SET $key = '$value' WHERE id_jabatan = '$id_jabatan' AND nama_kriteria = '$kriteria'";
                    $res1=mysqli_query($connection, $sql1) or die (mysqli_error($connection));
                }
            }
        }

        $arrayofcomparison = []; //semua nilai matriks (yang ditampilkan), baik yang disimpan ke db maupun engga
        // x dan y adalah indeks matriks
        for ($x=1; $x<=$jum_kandidat; $x++){
            for ($y=1; $y<=$jum_kandidat; $y++){
              $skor = 'kandidat'.$x.'_'.$y.'';
              if ($x == $y){
                $val = '1';
              } else if ($x < $y){
                $val = $_GET['kandidat'.$x.'_'.$y.''];
              } else {
                $val0 = $_GET['kandidat'.$y.'_'.$x.''];
                if ($val0 != 0){
                  $val = 1/$val0;
                } else {
                  $val = '0';
                }
              }
              array_push($arrayofcomparison, $val);
            } 
        }

        $arrayofcolumn = []; //jumlah masing2 kolom
          for ($in = 0; $in < $jum_kandidat; $in++){
            $total_col = 0;
            $arrayindex = $in;
            for ($index = 0; $index < $jum_kandidat; $index++){
              $total_col = $total_col + $arrayofcomparison[$arrayindex];
              $arrayindex = $arrayindex + $jum_kandidat;
            }
            array_push($arrayofcolumn, $total_col);
        }

        //menghitung rata2 baris/skor akhir
        $arrayofnorm = []; //array hasil normalisasi
        $arrayofrow = []; //array rata2 tiap baris
        $iterasi = 0;
        for ($indexnorm = 0; $indexnorm < $jum_kandidat; $indexnorm++){
            $eigen = 0;
            for ($indexcol = 0; $indexcol < $jum_kandidat; $indexcol++){
              $cellnorm = $arrayofcomparison[$iterasi] / $arrayofcolumn[$indexcol];
              array_push($arrayofnorm, $cellnorm);
              $iterasi++;
              $eigen = $eigen + $cellnorm;
            }
            $eigenrow = $eigen/$jum_kandidat;
            array_push($arrayofrow, $eigenrow);
        }

        $sql="SELECT * from posisi_pekerjaan WHERE id_jabatan = '$id_jabatan'";
        $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
        $rslt = $res->fetch_assoc();
        for ($i = 1; $i < 11; $i++){
            if ($rslt['nama_kriteria'.$i] != "" && ($_GET['kriteria'] == 'nama_kriteria'.$i)){
                $kriteria = 'skor_kriteria'.$i;
            }
        }

        for ($iterasi = 0; $iterasi < $jum_kandidat; $iterasi++){
            $id = $array_id_kandidat[$iterasi];
            $sql2 = "UPDATE melamar SET $kriteria= '$arrayofrow[$iterasi]' WHERE id_kandidat = '$id' AND id_jabatan = '$id_jabatan'";
            $res2=mysqli_query($connection, $sql2) or die (mysqli_error($connection));
        }
    }
    
    else if (isset($_GET['action']) && ($_GET['action'] == "revert")){
        $id_jabatan = $_GET['posisi'];
        $kriteria = $_GET['kriteria'];

        $jum_kandidat = 0;
        $sql="SELECT * FROM melamar WHERE id_jabatan = '$id_jabatan'";
        $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
        while ($row = mysqli_fetch_array($res)){
            $jum_kandidat++;
        }

        for ($i = 1; $i <= $jum_kandidat; $i++){
            for ($j = $i+1; $j <= $jum_kandidat; $j++){
                $value = $_GET[$i.'_'.$j];
                    $key = 'kandidat'.$i.'_'.$j;
                    $sql1="UPDATE perbandingan_skor SET $key = '$value' WHERE id_jabatan = '$id_jabatan' AND nama_kriteria = '$kriteria'";
                    $res1=mysqli_query($connection, $sql1) or die (mysqli_error($connection));
            }
        }
    }

    else if (isset($_GET['posisi']) && isset($_GET['action']) && ($_GET['action'] == "score-edit-direct")){
        $id = $_GET['posisi'];
        $sql="SELECT melamar.id_kandidat FROM melamar, kandidat WHERE melamar.id_jabatan = '$id' AND kandidat.id_kandidat = melamar.id_kandidat";
        $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
        $array_kandidatID = [];
        $jum_kandidat = 0;
        while ($row = mysqli_fetch_array($res)){
            array_push($array_kandidatID, $row['id_kandidat']);
            $jum_kandidat++;
        }

        $sql="SELECT * from posisi_pekerjaan WHERE id_jabatan = '$id'";
        $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
        $rslt = $res->fetch_assoc();
        $array_kriteria = [];
        $index_kriteria = [];
        $jum_kriteria = 0;
        for ($i = 1; $i < 11; $i++){
            if ($rslt['nama_kriteria'.$i] != ""){
                array_push($array_kriteria, $rslt['nama_kriteria'.$i]);
                array_push($index_kriteria, $i);
                $jum_kriteria++;                                            
            }
        }

        for ($kandidat = 0; $kandidat < $jum_kandidat; $kandidat++){
            for ($kriteria = 0; $kriteria < $jum_kriteria; $kriteria++){
                $value = $_GET[$kandidat.'_'.$kriteria];
                $index = $index_kriteria[$kriteria]; //ini nomor kriteria
                $key = 'skor_kriteria'.$index.'';
                $sql1="UPDATE melamar SET $key = '$value' WHERE id_jabatan = '$id' AND id_kandidat = '$array_kandidatID[$kandidat]'";
                $res1=mysqli_query($connection, $sql1) or die (mysqli_error($connection));
            }       
        }
    }

    else if (isset($_GET['posisi']) && isset($_GET['action']) && ($_GET['action'] == "revert-direct")){
        $id = $_GET['posisi'];
        $sql="SELECT melamar.id_kandidat FROM melamar, kandidat WHERE melamar.id_jabatan = '$id' AND kandidat.id_kandidat = melamar.id_kandidat";
        $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
        $array_kandidatID = [];
        $jum_kandidat = 0;
        while ($row = mysqli_fetch_array($res)){
            array_push($array_kandidatID, $row['id_kandidat']);
            $jum_kandidat++;
        }

        $sql="SELECT * from posisi_pekerjaan WHERE id_jabatan = '$id'";
        $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
        $rslt = $res->fetch_assoc();
        $array_kriteria = [];
        $index_kriteria = [];
        $jum_kriteria = 0;
        for ($i = 1; $i < 11; $i++){
            if ($rslt['nama_kriteria'.$i] != ""){
                array_push($array_kriteria, $rslt['nama_kriteria'.$i]);
                array_push($index_kriteria, $i);
                $jum_kriteria++;                                            
            }
        }

        for ($kandidat = 0; $kandidat < $jum_kandidat; $kandidat++){
            for ($kriteria = 0; $kriteria < $jum_kriteria; $kriteria++){
                $value = $_GET['temp'.$kandidat.'_'.$kriteria];
                $index = $index_kriteria[$kriteria]; //ini nomor kriteria
                $key = 'skor_kriteria'.$index.'';
                $sql1="UPDATE melamar SET $key = '$value' WHERE id_jabatan = '$id' AND id_kandidat = '$array_kandidatID[$kandidat]'";
                $res1=mysqli_query($connection, $sql1) or die (mysqli_error($connection));
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
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
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
                <div class="">
                    <!-- <div class="col-md-9"></div>
                    <div class="col-md-3"> -->
                        <!-- <div class="col-md-6"></div>
                        <div class="col-md-6"> -->
                    <div class="col-md-8" style="font-size: 20px; margin-top: 20px">
                        <?php
                            if (isset($_GET['posisi']) && $_GET['posisi'] != 0){
                                $id = $_GET['posisi'];
                                $sql="SELECT nama_jabatan FROM posisi_pekerjaan WHERE id_jabatan='$id'";
                                $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                $hasil = $res->fetch_assoc();
                                echo'Penilaian Kandidat untuk Posisi Pekerjaan '.$hasil['nama_jabatan'].'';
                            }   
                        ?>
                    </div>
                    <div class="col-md-4" style="margin-top: 12px">
                        <form action="assessment.php" class="form-inline" role="form" style="text-align:center" method="GET">
                            <div class="input-group col-md-4" style="float: right; z-index:99">
                                <span class="input-group-addon">Posisi Pekerjaan</span>
                                <input type="hidden" class="form-control" id="posisi" name="posisi"> 
                                <?php
                                  $sql="SELECT id_jabatan, nama_jabatan FROM posisi_pekerjaan";
                                  $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                ?>
                                <div class="input-group-btn">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="tombolposisi">
                                            <span id="posisi"  style="font-size: 16px">---pilih posisi---</span>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php
                                                while ($row = mysqli_fetch_array($res)) {
                                                    echo'<li><a href="javascript:setposisi('.$row['id_jabatan'].',\''.$row['nama_jabatan'].'\')">'.$row['nama_jabatan'].'</a></li>';
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                    <button type="submit" class="btn btn-success" style="font-size: 16px"><span class="glyphicon glyphicon-search"></span> Search</button>
                                    <a class="btn btn-primary" style="font-size: 16px" href="index.php?posisi=<?php echo $_GET['posisi']; ?>">Tampilkan Dashboard</a>

                                    <!-- <button type="submit" name="edit" value="kriteria" class="btn btn-warning" style="font-size: 16px">Edit Kriteria</button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br><br><br>
                <div class="col-md-6 daftar-kriteria" id="daftar-kriteria" style="text-align: right">
                    <div>
                        <form action="assessment.php" class="form-inline" role="form" style="font-size:19px" method="GET">
                            <div class="input-group">
                                <span class="input-group-addon">Perbandingan Skor</span>
                                <input type="hidden" class="form-control" id="kriteria" name="kriteria"> 
                                <?php
                                  $sql="SELECT id_jabatan, nama_jabatan FROM posisi_pekerjaan";
                                  $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                ?>
                              
                                <div class="input-group-btn">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="tombolkriteria">
                                            <span id="kriteria"  style="font-size: 16px"> --pilih kriteria-- </span>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php
                                                if (isset($_GET['posisi'])){
                                                    $id = $_GET['posisi'];
                                                    // echo'<input type="hidden" class="form-control" id="posisi" name="posisi" value="'.$id.'">'; 
                                                    // ambil daftar kriteria untuk posisi jabatan tertentu
                                                    
                                                    $sql="SELECT * FROM posisi_pekerjaan WHERE id_jabatan = '$id'";
                                                    $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                                    $hasil = $res->fetch_assoc();
                                                    for ($i = 1; $i < 11; $i++){
                                                        if ($hasil['nama_kriteria'.$i] != ""){
                                                            echo'<li><a href="javascript:setkriteria(\'nama_kriteria'.$i.'\',\''.$hasil['nama_kriteria'.$i].'\')">'.$hasil['nama_kriteria'.$i].'</a></li>';
                                                        }
                                                    }
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                    <button type="submit" name="action" value="assess-kandidat" class="btn btn-warning" style="font-size: 16px">Beri Penilaian</button>
                                    <button type="submit" name="action" value="direct-scoring" class="btn btn-success" style="font-size: 16px">Nilai Tanpa Perbandingan</button>
                                    <input type="hidden" name="posisi" value="<?php echo $_GET['posisi']; ?>">
                                    <input type="hidden" name="kandidat" value="<?php echo $_GET['kandidat']; ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <form action="assessment.php" class="form-inline" role="form" method="GET">
                            <?php
                              if (isset($_GET['kriteria']) && isset($_GET['posisi']) && ($_GET['kriteria']) != ""){
                                //untuk ambil data kandidat yang melamar --> header tabel
                                echo'<div class="scroll">';
                                echo'<br>';
                                $id = $_GET['posisi'];
                                $sql="SELECT nama_kandidat FROM melamar, kandidat WHERE melamar.id_jabatan = '$id' AND kandidat.id_kandidat = melamar.id_kandidat";
                                $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                $array_kandidat = [];
                                $jum_kandidat = 0;
                                while ($row = mysqli_fetch_array($res)){
                                    array_push($array_kandidat, $row['nama_kandidat']);
                                    $jum_kandidat++;
                                }
                                // print_r($array_kandidat);
                                echo'<table class="table table-bordered" style="text-align: center; font-size: 14px">';
                                echo'<tr>';
                                echo'<td></td>';
                                for($i = 0; $i < $jum_kandidat; $i++){
                                    $kandidat = $array_kandidat[$i];
                                    echo'<td>'.$kandidat.'</td>';  
                                }
                                echo'</tr>';

                                //untuk ambil perbandingan antar kandidat setiap kriteria
                                $kr = $_GET['kriteria']; //nama indeks kolom, misal nama_kriteria1
                                $sql1="SELECT * FROM perbandingan_skor WHERE perbandingan_skor.nama_kriteria = '$kr' AND perbandingan_skor.id_jabatan = '$id'";
                                
                                $res1=mysqli_query($connection, $sql1) or die (mysqli_error($connection));
                                $hasil = $res1->fetch_assoc();
                                
                                $array_temporary = [];
                                for ($x=1; $x<=$jum_kandidat; $x++){
                                    for ($y=1; $y<=$jum_kandidat; $y++){
                                        if ($x < $y){
                                            $skor_val = 'kandidat'.$x.'_'.$y.'';
                                            array_push($array_temporary, $hasil[$skor_val]);
                                        }
                                    }
                                }

                                if (isset($_GET['action']) && $_GET['action'] == "consistency"){
                                    $arrayofcomparison = []; //semua nilai matriks (yang ditampilkan), baik yang disimpan ke db maupun engga
                                        // x dan y adalah indeks matriks
                                    for ($x=1; $x<=$jum_kandidat; $x++){
                                        for ($y=1; $y<=$jum_kandidat; $y++){
                                          $skor = 'kandidat'.$x.'_'.$y.'';
                                          if ($x == $y){
                                            $val = '1';
                                          } else if ($x < $y){
                                            $val = $_GET['kandidat'.$x.'_'.$y.''];
                                          } else {
                                            $val0 = $_GET['kandidat'.$y.'_'.$x.''];
                                            if ($val0 != 0){
                                              $val = 1/$val0;
                                            } else {
                                              $val = '0';
                                            }
                                          }
                                          array_push($arrayofcomparison, $val);
                                        } 
                                    }

                                    $array_temporary_all = [];
                                    for ($x=1; $x<=$jum_kandidat; $x++){
                                        for ($y=1; $y<=$jum_kandidat; $y++){
                                          if ($x < $y){
                                            $skor_val = 'kandidat'.$x.'_'.$y.'';
                                            array_push($array_temporary_all, $hasil[$skor_val]);
                                          } else if ($x == $y){
                                            $skor_val = 'kandidat'.$x.'_'.$y.'';
                                            array_push($array_temporary_all, '1');
                                          } else {
                                            $skor_val = 'kandidat'.$y.'_'.$x.'';
                                            if ($hasil[$skor_val] != 0){
                                              $skor_val2= 1/$hasil[$skor_val];
                                              array_push($array_temporary_all, $skor_val2);
                                            } else {
                                              array_push($array_temporary_all, '');
                                            }
                                          }
                                        }
                                    }

                                    $iterasi = 0;
                                    for($i = 1; $i <= $jum_kandidat; $i++){
                                        $nama_kandidat = $array_kandidat[$i-1];
                                        echo'<tr>'; 
                                        echo'<td>'.$nama_kandidat.'</td>'; 
                                        for($j = 1; $j <= $jum_kandidat; $j++){
                                            if ($i < $j){
                                                echo'<td><input type="text" class="form-control" style="text-align: center; width: 70px;" id="kandidat'.$i.'_'.$j.'" name="kandidat'.$i.'_'.$j.'" value = "'.number_format($arrayofcomparison[$iterasi],2).'"></td>'; 
                                                echo'<input type="hidden" class="form-control" style="text-align: center" id="'.$i.'_'.$j.'" name="'.$i.'_'.$j.'" value = "'.$array_temporary_all[$iterasi].'">';
                                            } else {
                                                echo'<td>'.$arrayofcomparison[$iterasi].'</td>';
                                            }
                                            $iterasi++;
                                        }
                                    }
                                  echo'</tr>';
                                }
                                else {
                                    $iterasi = 0;
                                    for($i = 1; $i <= $jum_kandidat; $i++){
                                        $kandidat = $array_kandidat[$i-1];
                                        echo'<tr>'; 
                                        echo'<td>'.$kandidat.'</td>'; 
                                        for($j = 1; $j <= $jum_kandidat; $j++){
                                            if ($i < $j){
                                                echo'<input type="hidden" class="form-control" style="text-align: center" id="'.$i.'_'.$j.'" name="'.$i.'_'.$j.'" value = "'.$array_temporary[$iterasi].'">';
                                                $iterasi++;
                                                if ($hasil['kandidat'.$i.'_'.$j] != 0){
                                                    echo'<td><input type="text" class="form-control" style="text-align: center; width: 70px;" id="kandidat'.$i.'_'.$j.'" name="kandidat'.$i.'_'.$j.'" value = "'.number_format($hasil['kandidat'.$i.'_'.$j],2).'"></td>'; 
                                                } else  {
                                                    echo'<td><input type="text" class="form-control" style="text-align: center; width: 70px;" id="kandidat'.$i.'_'.$j.'" name="kandidat'.$i.'_'.$j.'" value = ""></td>';
                                                }
                                            } else if ($i == $j){
                                                echo'<td>1</td>';
                                            } else {
                                                if ($hasil['kandidat'.$j.'_'.$i] != 0){
                                                    $value = 1/$hasil['kandidat'.$j.'_'.$i];
                                                    echo'<td>'.number_format($value,2).'</td>';
                                                } else {
                                                    echo'<td></td>';
                                                }
                                            }
                                        }
                                    }
                                    echo'</tr>';

                                    //untuk ambil perbandingan antar kandidat setiap kriteria
                                    $kr = $_GET['kriteria']; //nama indeks kolom, misal nama_kriteria1
                                    $sql1="SELECT * FROM perbandingan_skor WHERE perbandingan_skor.nama_kriteria = '$kr' AND perbandingan_skor.id_jabatan = '$id'";
                                    $res1=mysqli_query($connection, $sql1) or die (mysqli_error($connection));
                                }
                                echo'</table>';
                                echo'</div>';
                              }
                            ?>
                            <?php
                                if (isset($_GET['posisi']) && isset($_GET['kriteria']) && (!isset($_GET['action']) || ((isset($_GET['action']) && ($_GET['action'] != "direct-scoring"))))){
                                    $jum_kandidat = 0;
                                    $id_jabatan = $_GET['posisi'];
                                    $sql="SELECT * FROM melamar WHERE id_jabatan = '$id_jabatan'";
                                    $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                    while ($row = mysqli_fetch_array($res)){
                                        $jum_kandidat++;
                                    }
                                    if ($jum_kandidat <= 11){
                                        echo'<br>
                                        <div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <button type="submit" name="action" value="consistency" class="btn btn-warning btn-block">CEK KONSISTENSI</button>';
                                                $posisi = $_GET['posisi'];
                                                echo'<input type="hidden" name="posisi" value="'.$posisi.'">';    
                                                $kriteria = $_GET['kriteria'];
                                                echo'<input type="hidden" name="kriteria" value="'.$kriteria.'">';
                                                $kandidat = $_GET['kandidat'];
                                                echo'<input type="hidden" name="kandidat" value="'.$kandidat.'">
                                                <br>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>';
                                        if(isset($_GET['posisi']) && isset($_GET['action']) && ($_GET['action'] == "consistency")){
                                            $totalmatrix = 0;
                                            for ($row=1; $row<=$jum_kandidat; $row++){
                                                for ($col=$row+1; $col<=$jum_kandidat; $col++){
                                                    $totalmatrix ++;
                                                }
                                            }

                                            $matrix = 0;
                                            for ($row=1; $row<=$jum_kandidat; $row++){
                                                for ($col=$row+1; $col<=$jum_kandidat; $col++){
                                                    if (($_GET['kandidat'.$row.'_'.$col.'']) != '0'){
                                                        $matrix ++;
                                                    }
                                                }
                                            }

                                            if ($matrix == $totalmatrix){
                                                $arrayofcomparison = []; //semua nilai matriks (yang ditampilkan), baik yang disimpan ke db maupun engga
                                                // x dan y adalah indeks matriks
                                                for ($x=1; $x<=$jum_kandidat; $x++){
                                                    for ($y=1; $y<=$jum_kandidat; $y++){
                                                      $skor = 'kandidat'.$x.'_'.$y.'';
                                                      if ($x == $y){
                                                        $val = 1;
                                                      } else if ($x < $y){
                                                        $val = $_GET['kandidat'.$x.'_'.$y.''];                                               
                                                      } else {
                                                        $val0 = $_GET['kandidat'.$y.'_'.$x.''];
                                                        if ($val0 != 0){
                                                          $val = 1/$val0;
                                                        } else {
                                                          $val = 0;
                                                        }
                                                      }
                                                      array_push($arrayofcomparison, $val);
                                                    } 
                                                }

                                                $arrayofcolumn = []; //jumlah masing2 kolom
                                                  for ($in = 0; $in < $jum_kandidat; $in++){
                                                    $total_col = 0;
                                                    $arrayindex = $in;
                                                    for ($index = 0; $index < $jum_kandidat; $index++){
                                                      $total_col = $total_col + $arrayofcomparison[$arrayindex];
                                                      $arrayindex = $arrayindex + $jum_kandidat;
                                                    }
                                                    array_push($arrayofcolumn, $total_col);
                                                }

                                                //menghitung rata2 baris/skor akhir
                                                $arrayofnorm = []; //array hasil normalisasi
                                                $arrayofrow = []; //array rata2 tiap baris
                                                $iterasi = 0;
                                                for ($indexnorm = 0; $indexnorm < $jum_kandidat; $indexnorm++){
                                                    $eigen = 0;
                                                    for ($indexcol = 0; $indexcol < $jum_kandidat; $indexcol++){
                                                      $cellnorm = $arrayofcomparison[$iterasi] / $arrayofcolumn[$indexcol];
                                                      array_push($arrayofnorm, $cellnorm);
                                                      $iterasi++;
                                                      $eigen = $eigen + $cellnorm;
                                                    }
                                                    $eigenrow = $eigen/$jum_kandidat;
                                                    array_push($arrayofrow, $eigenrow);
                                                }

                                                // menghitung rasio konsistensi
                                                $eigen_factor = 0;
                                                for ($indexeigen = 0; $indexeigen < $jum_kandidat; $indexeigen++){
                                                    $eigen_factor = $eigen_factor + ($arrayofrow[$indexeigen] * $arrayofcolumn[$indexeigen]);
                                                }

                                                $consistency_index = ($eigen_factor - $jum_kandidat)/($jum_kandidat - 1);
                                             
                                                // random index                                     
                                                switch ($jum_kandidat) {
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

                                                echo '<br><br><div class="col-md-12" style= "text-align:center">';
                                                echo 'CONSISTENCY RATIO = '.$consistency_ratio.'';
                                                echo '<br>'.$rasio.'<br><br>';
                                                echo'</div>';
                                                echo'<div style="text-align: center">';
                                                for($in = 0; $in < $jum_kandidat; $in++) {
                                                    echo 'Skor akhir '.$array_kandidat[$in].' : '.$arrayofrow[$in];
                                                    echo '<br>';
                                                }
                                                echo'</div>';
                                            }
                                        }
                                    }
                                    echo'<br>';
                                    echo'<div>
                                        <div class="col-md-6">
                                            <button type="submit" name="action" value="revert" class="btn btn-danger btn-block">REVERT</button>';
                                            $posisi = $_GET['posisi'];
                                            echo'<input type="hidden" name="posisi" value="'.$posisi.'">';    
                                            $kriteria = $_GET['kriteria'];
                                            echo'<input type="hidden" name="kriteria" value="'.$kriteria.'">';
                                            $kandidat = $_GET['kandidat'];
                                            echo'<input type="hidden" name="kandidat" value="'.$kandidat.'">
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" name="action" value="score-edit" class="btn btn-success btn-block">SUBMIT</button>';
                                            $posisi = $_GET['posisi'];
                                            echo'<input type="hidden" name="posisi" value="'.$posisi.'">';    
                                            $kriteria = $_GET['kriteria'];
                                            echo'<input type="hidden" name="kriteria" value="'.$kriteria.'">';
                                            $kandidat = $_GET['kandidat'];
                                            echo'<input type="hidden" name="kandidat" value="'.$kandidat.'">
                                        </div>
                                    </div>';
                                }
                            ?>  
                        </form>
                        <form action="assessment.php" class="form-inline" role="form" method="GET">
                            <?php
                                if (isset($_GET['posisi']) && isset($_GET['action']) && (($_GET['action'] == 'direct-scoring') || ($_GET['action'] == 'score-edit-direct') || ($_GET['action'] == 'revert-direct'))){
                                    $id = $_GET['posisi'];
                                    $sql="SELECT nama_kandidat, melamar.id_kandidat FROM melamar, kandidat WHERE melamar.id_jabatan = '$id' AND kandidat.id_kandidat = melamar.id_kandidat";
                                    $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                    $array_kandidat = [];
                                    $array_kandidatID = [];
                                    $jum_kandidat = 0;
                                    while ($row = mysqli_fetch_array($res)){
                                        array_push($array_kandidat, $row['nama_kandidat']);
                                        array_push($array_kandidatID, $row['id_kandidat']);
                                        $jum_kandidat++;
                                    }

                                    $sql="SELECT * from posisi_pekerjaan WHERE id_jabatan = '$id'";
                                    $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                    $rslt = $res->fetch_assoc();
                                    $array_kriteria = [];
                                    $index_kriteria = [];
                                    $jum_kriteria = 0;
                                    for ($i = 1; $i < 11; $i++){
                                        if ($rslt['nama_kriteria'.$i] != ""){
                                            array_push($array_kriteria, $rslt['nama_kriteria'.$i]);
                                            array_push($index_kriteria, $i);
                                            $jum_kriteria++;                                            
                                        }
                                    }

                                    echo'<br>';
                                    echo'<table class="table table-bordered" style="text-align: center; font-size: 14px">';
                                    echo'<tr>';
                                    echo'<td><b>Nama Kandidat</b></td>';
                                    for ($kriteria = 0; $kriteria < $jum_kriteria; $kriteria++){
                                        echo'<td><b>'.$array_kriteria[$kriteria].'</b></td>';
                                    }
                                    echo'</tr>';
                                    // kd = no urut kandidat dalam array, kr = no urut kriteria dalam array
                                    
                                    for ($kandidat = 0; $kandidat < $jum_kandidat; $kandidat++){
                                        $sql="SELECT * from melamar WHERE id_jabatan = '$id' AND id_kandidat = '$array_kandidatID[$kandidat]'";
                                        $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                        $rslt = $res->fetch_assoc();

                                        $array_temporary = [];
                                        for ($x = 0; $x < $jum_kriteria; $x++){
                                            $i = $index_kriteria[$x];
                                            $skor_val = 'skor_kriteria'.$i.'';
                                            array_push($array_temporary, $rslt[$skor_val]);    
                                        }

                                        echo'<tr>';
                                        echo'<td>'.$array_kandidat[$kandidat].'</td>';
                                        for ($kriteria = 0; $kriteria < $jum_kriteria; $kriteria++){
                                            echo'<td>';
                                            $index = $index_kriteria[$kriteria];
                                            $x = 'skor_kriteria'.$index.'';
                                            echo'<input type="text" class="form-control" style="text-align: center; width: 70px" id="'.$kandidat.'_'.$kriteria.'" name="'.$kandidat.'_'.$kriteria.'" value = "'.$rslt[$x].'">';
                                            echo'<input type="hidden" class="form-control" style="text-align: center; width: 70px" id="temp'.$kandidat.'_'.$kriteria.'" name="temp'.$kandidat.'_'.$kriteria.'" value = "'.$array_temporary[$kriteria].'">
                                            </td>';
                                        }
                                    }
                                    echo'</table>';
                                }
                            ?>
                            <?php
                                if (isset($_GET['posisi']) && isset($_GET['action']) && (($_GET['action'] == 'direct-scoring') || ($_GET['action'] == 'score-edit-direct') || ($_GET['action'] == 'revert-direct'))){
                                    echo'<br>';
                                    echo'<div>
                                        <div class="col-md-6">
                                            <button type="submit" name="action" value="revert-direct" class="btn btn-danger btn-block">REVERT</button>';
                                            $posisi = $_GET['posisi'];
                                            echo'<input type="hidden" name="posisi" value="'.$posisi.'">';  
                                            $kandidat = $_GET['kandidat'];
                                            echo'<input type="hidden" name="kandidat" value="'.$kandidat.'">
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" name="action" value="score-edit-direct" class="btn btn-success btn-block">SUBMIT</button>';
                                            $posisi = $_GET['posisi'];
                                            echo'<input type="hidden" name="posisi" value="'.$posisi.'">';    
                                            $kandidat = $_GET['kandidat'];
                                            echo'<input type="hidden" name="kandidat" value="'.$kandidat.'">
                                        </div>
                                    </div>';
                                
                                }
                            ?>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 daftar-kandidat" id="daftar-kandidat" style="text-align: right">
                    <form action="assessment.php" class="form-inline" role="form" style="font-size:19px" method="GET">
                        <div class="input-group">
                            <span class="input-group-addon">Data Kandidat</span>
                            <input type="hidden" class="form-control" id="kandidat" name="kandidat"> 
                            <?php
                              $sql="SELECT id_jabatan, nama_jabatan FROM posisi_pekerjaan";
                              $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                            ?>
                          
                            <div class="input-group-btn">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="tombolkandidat">
                                        <span id="kandidat"  style="font-size: 16px"> --pilih kandidat-- </span>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php
                                            if (isset($_GET['posisi'])){
                                                $id = $_GET['posisi'];
                                                // echo'<input type="hidden" class="form-control" id="posisi" name="posisi" value="'.$id.'">'; 
                                                // ambil daftar kriteria untuk posisi jabatan tertentu
                                                
                                                $sql="SELECT * FROM posisi_pekerjaan, melamar, kandidat WHERE posisi_pekerjaan.id_jabatan = melamar.id_jabatan AND melamar.id_kandidat = kandidat.id_kandidat AND melamar.id_jabatan = '$id'";
                                                $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                                while ($row = mysqli_fetch_array($res)) {
                                                    echo'<li><a href="javascript:setkandidat('.$row['id_kandidat'].',\''.$row['nama_kandidat'].'\')">'.$row['nama_kandidat'].'</a></li>';
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                                <button type="submit" name="action" value="access-data" class="btn btn-warning" style="font-size: 16px">Lihat Data</button>
                                <input type="hidden" name="posisi" value="<?php echo $_GET['posisi']; ?>">
                                <?php
                                    if (isset($_GET['kriteria'])){
                                        $kriteria = $_GET['kriteria'];
                                        echo'<input type="hidden" name="kriteria" value="'.$kriteria.'">';
                                    }
                                ?>
                            </div>
                        </div>
                    </form>                
                    <?php
                        if (isset ($_GET['kandidat']) && ($_GET['kandidat'] > 0)){
                            $kandidat = $_GET['kandidat'];
                            $sql="SELECT * FROM kandidat WHERE id_kandidat = '$kandidat'";
                            $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                            $rslt = $res->fetch_assoc();
                            echo'<br>';
                            echo'<div>';
                            echo'<table class="table table-hover" style="text-align: left">
                            <tr>
                                <td width="180">Nama</td>
                                <td>'.$rslt['nama_kandidat'].'</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>'.$rslt['alamat'].'</td>
                            </tr>
                            <tr>
                                <td>TTL</td>';
                                if ($rslt['tanggal_lahir'] != 0000-00-00){
                                    echo'<td>'.$rslt['tempat_lahir'].', '.$rslt['tanggal_lahir'].'</td>';
                                } else {
                                    echo'<td></td>';
                                }
                            echo'</tr>';
                            echo'<tr>
                                <td>Pendidikan</td>
                                <td>'.$rslt['pendidikan'].'</td>
                            </tr>
                            <tr>
                                <td>IPK</td>';
                                if ($rslt['ipk'] != 0){
                                    echo'<td>'.$rslt['ipk'].'</td>';
                                } else {
                                    echo'<td></td>';
                                }
                            echo'</tr>
                            <tr>
                                <td>Pengalaman Organisasi</td>
                                <td>'.$rslt['pengalaman_organisasi'].'</td>
                            </tr>
                            <tr>
                                <td>Pengalaman Kerja</td>
                                <td>'.$rslt['pengalaman_kerja'].'</td>
                            </tr>
                            <tr>
                                <td>Sertifikasi Pelatihan</td>
                                <td>'.$rslt['pelatihan_sertifikasi'].'</td>
                            </tr>';
                            if ($rslt['tes_awal'] != ""){
                                echo'<tr>
                                    <td>Hasil Tes Dasar</td>
                                    <td>'.$rslt['tes_awal'].'</td>
                                </tr>';
                            }
                            if ($rslt['psikotest'] != ""){
                                echo'<tr>
                                    <td>Hasil Psikotest</td>
                                    <td>'.$rslt['psikotest'].'</td>
                                </tr>';
                            }
                            if ($rslt['tes_simulasi'] != ""){
                                echo'<tr>
                                    <td>Hasil Tes Simulasi</td>
                                    <td>'.$rslt['tes_simulasi'].'</td>
                                </tr>';
                            }
                            if ($rslt['wawancara'] != ""){
                                echo'<tr>
                                    <td>Hasil Wawancara</td>
                                    <td>'.$rslt['wawancara'].'</td>
                                </tr>';
                            }
                            echo'<tr>
                                <td>Email</td>
                                <td>'.$rslt['email'].'</td>
                            </tr>                                
                            <tr>
                                <td>No. Telepon</td>
                                <td>'.$rslt['telepon'].'</td>
                            </tr>
                            <form action="../crawler/retrievedata.php" class="form-inline" role="form" method="GET">
                            <tr>
                                <td>Username Twitter</td>
                                <td>'.$rslt['username_twitter'].'';
                                if ($rslt['username_twitter'] != ""){
                                    echo'<button style="float:right" type="submit" name="username" value="'.$rslt['username_twitter'].'" class="btn-warning" style="font-size: 16px">Analisis Data</button>';
                                    echo'<input type="hidden" name="redir" value="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'">';

                                    $kandidat = $_GET['kandidat'];
                                    echo'<input type="hidden" name="kandidat" value="'.$kandidat.'">';

                                }                                     
                                echo'</td>
                            </tr>
                            </form>';
                            if ($rslt['extraversion'] != 0){
                                echo'<tr>
                                    <td><i>Extraversion</i></td>
                                    <td>'.$rslt['extraversion'].'</td>
                                </tr>
                                <tr>
                                    <td><i>Agreeableness</i></td>
                                    <td>'.$rslt['agreeableness'].'</td>
                                </tr>
                                <tr>
                                    <td><i>Conscientiousness</i></td>
                                    <td>'.$rslt['conscientiousness'].'</td>
                                </tr>
                                <tr>
                                    <td><i>Neuroticism</i></td>
                                    <td>'.$rslt['neuroticism'].'</td>
                                </tr>
                                <tr>
                                    <td><i>Openness to Experience</i></td>
                                    <td>'.$rslt['openness'].'</td>
                                </tr>';
                                $totaltweet = $rslt['jumlah_sentimen_pos'] + $rslt['jumlah_sentimen_neg'] + $rslt['jumlah_sentimen_net'];
                                echo'<tr>
                                    <td><i>Positive Sentiment</i></td>
                                    <td>'.$rslt['jumlah_sentimen_pos'].' dari total '.$totaltweet.' tweet</td>
                                </tr>
                                <tr>
                                    <td><i>Neutral Sentiment</i></td>
                                    <td>'.$rslt['jumlah_sentimen_net'].' dari total '.$totaltweet.' tweet</td>
                                </tr>
                                <tr>
                                    <td><i>Negative Sentiment</i></td>
                                    <td>'.$rslt['jumlah_sentimen_neg'].' dari total '.$totaltweet.' tweet</td>
                                </tr>';
                            }
                            echo'</table>';
                            echo'</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $("#daftar-kandidat").height($("#contentwrapper").height() - $(".nav").height() - 20);

    function setposisi(posisi, text){
        $("#posisi").val(posisi);
        $("#tombolposisi").html('<span id="posisi"  style="font-size: 16px">'+text+'</span><span class="caret"></span>');
    }
    function setkriteria(kriteria, text){
        $("#kriteria").val(kriteria);
        $("#tombolkriteria").html('<span id="kriteria"  style="font-size: 16px">'+text+'</span><span class="caret"></span>');
    }
    function setkandidat(kandidat, text){
        $("#kandidat").val(kandidat);
        $("#tombolkandidat").html('<span id="kandidat"  style="font-size: 16px">'+text+'</span><span class="caret"></span>');
    }
</script>
<script type="text/javascript" src="../crawler/js/jquery-1.9.0.js"></script>
<script type="text/javascript" src="../crawler/js/home.js"></script>
</html>