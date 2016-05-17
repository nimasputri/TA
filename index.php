<!DOCTYPE html>

<?php
  require_once('connect.php');
?>

<html>
<head>
  <title>SPK Seleksi SDM</title>
  <link rel="stylesheet" type="text/css" href="css/flat-blue.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
  <script src="js/morris.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
  <script src="lib/example.js"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <link rel="stylesheet" href="lib/example.css">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
  <link rel="stylesheet" href="css/morris.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
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
                    <li role="presentation" class="active tab"><a href="index.php">Dashboard</a></li>
                    <li role="presentation" class="tab"><a href="tailoring.php">Penyesuaian Kriteria</a></li>
                    <li role="presentation" class="tab"><a href="assessment.php">Penilaian Kandidat</a></li>
                </ul>
                <div class="tab-content">
                  <div id="beranda" class="tab-pane active" role="tabpanel">
                    <?php
                      if (isset($_GET['posisi']) && ($_GET['posisi'] != 0)){
                        $id_jabatan = $_GET['posisi'];
                        $sql="SELECT * FROM melamar, kandidat WHERE melamar.id_jabatan = '$id_jabatan' AND melamar.id_kandidat = kandidat.id_kandidat";
                        $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                        $sql2="SELECT * FROM posisi_pekerjaan WHERE id_jabatan = '$id_jabatan'";
                        $res2=mysqli_query($connection, $sql2) or die (mysqli_error($connection));
                        $rslt = $res2->fetch_assoc();
                        echo"<br><div class='col-md-12'>
                          <div class='col-md-6'></div>
                          <div class='col-md-6'>";
                            echo'<form action="index.php" class="form-inline" role="form" style="text-align:center" method="GET">
                              <div class="input-group col-md-4" style="float: right; z-index:99">
                                <span class="input-group-addon">Posisi Pekerjaan</span>
                                <input type="hidden" class="form-control" id="posisi" name="posisi">'; 
                                $sql="SELECT id_jabatan, nama_jabatan FROM posisi_pekerjaan";
                                $res3=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                echo'<div class="input-group-btn">
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="tombolposisi">
                                      <span id="posisi"  style="font-size: 16px">---pilih posisi---</span>
                                      <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">';
                                      while ($row2 = mysqli_fetch_array($res3)) {
                                        echo'<li><a href="javascript:setposisi('.$row2['id_jabatan'].',\''.$row2['nama_jabatan'].'\')">'.$row2['nama_jabatan'].'</a></li>';
                                      }
                                    echo'</ul>
                                  </div>
                                  <button type="submit" class="btn btn-success" style="font-size: 16px">Tampilkan Dashboard</button>
                                </div>
                              </div>
                            </form>
                          </div><br>
                        </div>';
                        echo'<br><br><div class="col-md-12">';
                          echo'<div class="col-md-7">
                            <div class="panel panel-default" style="height: 320px">
                              <div class="panel-heading">Total Perolehan Skor '.$rslt['nama_jabatan'].'</div>
                              <div class="panel-body">';
                                // <h2 style="text-align: center">TOTAL PEROLEHAN SKOR '.$rslt['nama_jabatan'].'</h2>';
                                echo"<div id='graph1' style='height: 250px; width: 700px'></div>
                                <pre style='display:none' id='code1' class='prettyprint linenums morris-chart'>
                                // Use Morris.Bar \n
                                  Morris.Bar({ \n
                                    element: 'graph1', \n
                                    data: [ \n";
                                    $jum_kriteria_isi = 0;
                                    $array_kriteria = [];
                                    $array_bobot = [];
                                    for($i = 1; $i < 11; $i++){
                                      if ($rslt['bobot_kriteria'.$i] > 0.0){
                                        $jum_kriteria_isi++;
                                        array_push($array_kriteria, $rslt['nama_kriteria'.$i]);
                                        array_push($array_bobot, $rslt['bobot_kriteria'.$i]);
                                      }
                                    }
                              
                                    //untuk ambil data dan masukin ke array sementara
                                    $array_kandidat = [];
                                    $array_id_kandidat = [];
                                    $jumlah_kandidat = 0;
                                    $array_subtotal = [];
                                    while ($row = mysqli_fetch_array($res)){
                                      // print_r($row);
                                      $total = 0;                              
                                      array_push($array_subtotal, $row['nama_kandidat']);
                                      array_push($array_id_kandidat, $row['id_kandidat']);
                                      for ($i = 1; $i <= 10; $i++){
                                        $subtotal = $rslt['bobot_kriteria'.$i] * $row['skor_kriteria'.$i]; 
                                        $total = $total + $subtotal;
                                        array_push($array_subtotal, $subtotal);
                                      }
                                      $array_kandidat[$row['nama_kandidat']] = $total;
                                      $jumlah_kandidat++;
                                    }
                                    //array kandidat untuk disort
                                    $array_kandidat_sort = [];
                                    foreach ($array_kandidat as $key => $val){
                                      $array_kandidat_sort[$key] = $val;
                                    }
                                    // print_r($array_subtotal);

                                    // print_r($array_total);

                                    // print_r($array_kandidat);
                                    //sorting kandidat berdasar skornya
                                    arsort($array_kandidat_sort);
                                    // print_r($array_kandidat_sort);

                                    foreach($array_kandidat_sort as $key => $value){
                                      // print($key.'_');
                                      // print($val);
                                      echo"{x: '".split(' ',$key)[0]."', ";
                                      for ($i = 0; $i < $jumlah_kandidat*11; $i++){
                                        if(strcmp($key, $array_subtotal[$i]) == 0){
                                          // echo "k".$i.": ".$subtotal.",";
                                          $index = $i;
                                          $x = 1;
                                          for ($j = $index+1; $j <= $index+10; $j++){
                                            echo "k".$x.": ".$array_subtotal[$j].",";
                                            $x++;
                                          }
                                        }
                                      }
                                      echo "}, \n";
                                    }

                                    echo"],
                                    xkey: 'x',";
                                    echo "ykeys: [";
                                    for($i=1; $i<=10; $i++){
                                      if ($rslt['bobot_kriteria'.$i] > 0.0){
                                        echo "'k".$i."',";
                                      }                              
                                    }
                                    echo "],";
                                    echo "labels: [";
                                    for($i=0; $i<$jum_kriteria_isi; $i++){
                                      echo "'".$array_kriteria[$i]."',";
                                    }
                                    echo "],";
                                    echo "xLabelAngle: 40,";
                                    echo "stacked: true
                                  });
                                </pre>
                              </div>
                            </div> 
                          </div>
                          <div class='col-md-5'>
                            <div class='panel panel-default'>
                              <div class='panel-heading' style='height: 320px'>
                                Skor Tiap Kriteria
                                <div class='pull-right'>
                                  <form action='index.php' class='form-inline' role='form' style='font-size:19px' method='GET'>
                                    <div class='input-group col-md-4' style='float: right; z-index:98'>
                                      <input type='hidden' class='form-control' id='kriteria' name='kriteria' >
                                      <div class='input-group-btn'>
                                      <div class='btn-group'>
                                        <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' id='tombolkriteria'>
                                          <span id='kriteria'> --pilih kriteria-- </span>
                                          <span class='caret'></span>
                                        </button>
                                        <ul class='dropdown-menu'>";
                                          $sql="SELECT * FROM posisi_pekerjaan WHERE id_jabatan = '$id_jabatan'";
                                          $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                          $hasil = $res->fetch_assoc();
                                          for ($i = 1; $i < 11; $i++){
                                            if ($hasil['nama_kriteria'.$i] != ""){
                                              echo'<li><a href="javascript:setkriteria(\''.$i.'\',\''.$hasil['nama_kriteria'.$i].'\')">'.$hasil['nama_kriteria'.$i].'</a></li>';
                                            }
                                          }  
                                        echo"</ul>
                                      </div>
                                      <button type='submit' class='btn btn-warning'>Lihat Data</button>"; 
                                      ?>       
                                      <input type="hidden" name="posisi" value="<?php echo $_GET['posisi']; ?>">
                                      <input type="hidden" name="kandidat" value="<?php echo $_GET['kandidat']; ?>">
                                      <?php                        
                                    echo"</div>
                                  </form>
                                </div>
                              </div>
                              <div class='panel-body'>";
                                echo"<br><div id='graph2' style='height: 200px;'></div>
                                <pre style='display:none' id='code2' class='prettyprint linenums morris-chart'>
                                // Use Morris.Bar \n
                                  Morris.Bar({ \n
                                    element: 'graph2', \n
                                    data: [";
                                      // print_r($array_kandidat);
                                      // print_r($array_subtotal);
                                      if (isset($_GET['kriteria'])){
                                        $nomor_kriteria = $_GET['kriteria']; // indeks kriteria di db
                                      }
                                      else {
                                        $nomor_kriteria = 1;
                                      }
                                      //array sorting
                                      $array_kriteria_skor_sort = [];
                                      // print_r($array_kriteria_skor_sort);
                                      // print_r($array_kandidat);
                                      for ($i = 0; $i < $jumlah_kandidat*11; $i++){
                                        foreach ($array_kandidat as $key => $val){
                                          if (strcmp($key, $array_subtotal[$i]) == 0){
                                            $array_kriteria_skor_sort[$key] = $array_subtotal[$i+$nomor_kriteria];
                                          }
                                        }                                        
                                      }

                                      arsort($array_kriteria_skor_sort);

                                      foreach($array_kriteria_skor_sort as $key => $value){
                                        echo"{x: '".split(' ',$key)[0]."', ";
                                        echo "y: ".$value.",";
                                        echo "}, \n";
                                      }
                                    echo"],
                                      xkey: 'x',
                                      ykeys: 'y',
                                      labels: 'Y',
                                      barColors: function (row, series, type) {
                                        if (type === 'bar') {
                                          var red = Math.ceil(26 * row.y / this.ymax);
                                          var green = Math.ceil(188 * row.y / this.ymax);
                                          var blue = Math.ceil(156 * row.y / this.ymax);
                                          return 'rgb(' + red + ',' + green + ', ' + blue + ')';
                                        }
                                        else {
                                          return '#000';
                                        }
                                      },
                                      xLabelAngle: 40
                                    }).on('click', function(i, row){
                                      console.log(i, row);
                                    });
                                </pre>
                              </div>
                            </div> 
                          </div>
                        </div>
                        <div class='col-md-12'>
                          <div class='panel panel-default'>
                            <div class='panel-heading'  style='height: 450px'>
                              Data Kandidat
                              <div class='pull-right'>
                                <form action='index.php' class='form-inline' role='form' style='font-size:19px' method='GET'>
                                  <div class='input-group col-md-4' style='float: right; z-index:150'>
                                  <input type='hidden' class='form-control' id='kandidat' name='kandidat' >
                                  <div class='input-group-btn'>
                                    <div class='btn-group'>
                                      <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' id='tombolkandidat'>
                                        <span id='kandidat'> --pilih kandidat-- </span>
                                        <span class='caret'></span>
                                      </button>
                                        <ul class='dropdown-menu'>";
                                          if (isset($_GET['posisi'])){
                                            $id = $_GET['posisi'];
                                            // echo'<input type="hidden" class="form-control" id="posisi" name="posisi" value="'.$id.'">'; 
                                            // ambil daftar kandidat untuk posisi jabatan tertentu
                                            $sql="SELECT * FROM melamar, kandidat WHERE melamar.id_jabatan = '$id_jabatan' AND melamar.id_kandidat = kandidat.id_kandidat";
                                            $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                            while ($row = mysqli_fetch_array($res)){
                                              echo'<li><a href="javascript:setkandidat('.$row['id_kandidat'].',\''.$row['nama_kandidat'].'\')">'.$row['nama_kandidat'].'</a></li>';
                                            }
                                          }
                                        echo"</ul>
                                    </div>
                                    <button type='submit' class='btn btn-warning'>Lihat Data</button>"; 
                                    ?>       
                                    <input type="hidden" name="posisi" value="<?php echo $_GET['posisi']; ?>">
                                    <input type="hidden" name="kriteria" value="<?php echo $_GET['kriteria']; ?>">
                                    <?php                        
                                  echo"</div>
                                </form>
                              </div>
                            </div>
                            <div class='panel-body'>";
                              echo"<br>
                              <div class='col-md-6'>
                                <div id='graph3' style='height: 300px; width: 500px'></div>
                                <pre style='display:none' id='code3' class='prettyprint linenums morris-chart'>
                                // Use Morris.Bar \n
                                  Morris.Bar({ \n
                                    element: 'graph3', \n
                                    data: [";
                                      // print_r($array_kandidat);
                                      // print_r($array_subtotal);
                                      $j = 1;
                                      // print_r($array_kriteria);
                                      if (isset($_GET['kandidat'])){
                                        $id_kandidat = $_GET['kandidat']; // indeks kandidat di db
                                      }
                                      else {
                                        $id_kandidat = $array_id_kandidat[0];
                                      }

                                      $sql="SELECT id_kandidat, nama_kandidat FROM kandidat WHERE id_kandidat = '$id_kandidat'";
                                      $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                      $rslt = $res->fetch_assoc();

                                      $nomor_kandidat = 0;
                                      for($i = 0; $i < $jumlah_kandidat * 11; $i++){
                                        if(strcmp($value, $rslt['nama_kandidat']) == 0){
                                          $nomor_kandidat = $i;
                                        }
                                      }

                                      $sql2="SELECT * FROM posisi_pekerjaan WHERE id_jabatan = '$id_jabatan'";
                                      $res2=mysqli_query($connection, $sql2) or die (mysqli_error($connection));
                                      $rslt = $res2->fetch_assoc();

                                      $array_no_kriteria = [];
                                      for($i = 1; $i < 11; $i++){
                                        if ($rslt['bobot_kriteria'.$i] > 0.0){
                                          array_push($array_no_kriteria, $i);
                                        }
                                      }

                                      for ($i=0; $i<$jum_kriteria_isi; $i++){
                                        echo"{x: '".split(' ',$array_kriteria[$i])[0]."', ";
                                        $j = $array_no_kriteria[$i];
                                        echo "y: ".$array_subtotal[$nomor_kandidat + $j].",";
                                        echo "}, \n";
                                      }
                                    echo"],
                                      xkey: 'x',
                                      ykeys: 'y',
                                      labels: 'Y',
                                      barColors: function (row, series, type) {
                                        if (type === 'bar') {
                                          var red = Math.ceil(250 * row.y / this.ymax);
                                          var green = Math.ceil(190 * row.y / this.ymax);
                                          var blue = Math.ceil(40 * row.y / this.ymax);
                                          return 'rgb(' + red + ',' + green + ', ' + blue + ')';
                                        }
                                        else {
                                          return '#000';
                                        }
                                      },
                                      xLabelAngle: 40
                                    }).on('click', function(i, row){
                                      console.log(i, row);
                                    });
                                </pre>
                              </div>
                              <div class='col-md-6'>";
                              echo"<div id='graph4' style='height: 300px; width: 500px'></div>
                                <pre style='display:none' id='code4' class='prettyprint linenums morris-chart'>";
                                  $id_kandidat = $_GET['kandidat'];
                                  $sql="SELECT * FROM kandidat WHERE id_kandidat = '$id_kandidat'";
                                  $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                                  $rslt = $res->fetch_assoc();
                                  echo"Morris.Donut({
                                  element: 'graph4',
                                  data: [
                                    {value: '".$rslt['sentimen_positif']."', label: 'Positif'},
                                    {value: '".$rslt['sentimen_negatif'].", label: 'Negatif'},
                                    {value: '".$rslt['sentimen_neutral'].", label: 'Neutral'}
                                  ],
                                  formatter: function (x) {return x + '%'}
                                }).on('click', function(i, row){
                                  console.log(i, row);
                                });
                                </pre>
                              </div>
                            </div>
                          </div>
                        </div>";
                      } else {
                        echo'<br><br><br>
                        <div style="text-align:center">
                          <h3>Pilih Posisi Pekerjaan untuk Menampilkan Dashboard</h3>
                        </div>';
                        echo'<div>';
                        echo'<div class="col-md-4"></div>';
                        echo'<div class="col-md-4" style="text-align: center">
                          <form action="index.php" class="form select-tailor" style="text-align:center" method="GET">
                          <div>';
                          $sql="SELECT id_jabatan, nama_jabatan FROM posisi_pekerjaan";
                          $res=mysqli_query($connection, $sql) or die (mysqli_error($connection));
                          echo'<br><br>';
                          echo'Posisi Pekerjaan      :
                            <select name="posisi" id="posisi">
                              <option value = 0>--- pilih posisi ---</option>';
                                while ($row = mysqli_fetch_array($res)) {
                                  echo '<option value="'.$row['id_jabatan'].'">'.$row['nama_jabatan'].'</option>';
                                }            
                          echo'</select>
                          <br><br>
                          </div>
                          <div>
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                              <button type="submit" class="btn btn-success btn-block">Tampilkan</button>
                            </div>
                            <div class="col-md-3"></div>
                          </div></form>
                        </div>';
                        echo'<div class="col-md-4"></div>';
                        echo'</div>';
                      }
                    ?>                    
                  </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    function setposisi(posisi, text){
        $("#posisi").val(posisi);
        $("#tombolposisi").html('<span id="posisi"  style="font-size: 16px">'+text+'</span><span class="caret"></span>');
    }

    function setkriteria(kriteria, text){
        $("#kriteria").val(kriteria);
        $("#tombolkriteria").html('<span id="kriteria">'+text+'</span><span class="caret"></span>');
    }

    function setkandidat(kandidat, text){
        $("#kandidat").val(kandidat);
        $("#tombolkandidat").html('<span id="kandidat">'+text+'</span><span class="caret"></span>');
    }
</script>

</html>