<!-- <?php
// include_once('conection.php');

//     $id = "";
//     if(!isset($_GET["id_pozo"])){
//       header('location: mediciones.php');
//       exit;
//   }

//   $id = $_GET['id_pozo'];
?> -->
<?php
    //session_start();
    include_once("conection.php");

    $id = '';

    if($_SERVER['REQUEST_METHOD']==='GET'){
        if(isset($_GET['id_pozo']) && !empty($_GET['id_pozo'])) {
           $id = $_GET['id_pozo'];
        } else {
            header('Location:mediciones.php');
        }
    }

    $peticion = mysqli_query($conn, "SELECT * FROM mediciones WHERE id_pozo = $id;");
    $datosmediciones = [];
    $fechas = [];
    $valores = [];
    
    if(mysqli_num_rows($peticion) > 0) {
        while($array = mysqli_fetch_array($peticion)) {
           array_push($datosmediciones, $array);
           array_push($fechas, $array['fecha_registro']);
           array_push($valores, $array['medicion']);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos de Pozos Petroleros</title>
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="./style.css">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <!-- Chart Js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="./assets/img/favicon-pdvsa.png">
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-body-tertiary" style="background-color:#d51928; color:#fff;">
  <div class="container-fluid" >
    <a class="navbar-brand " href="index.php" >
      <img src="./assets/img/pdvsa-logo.jpg" alt="Logo" width="100" height="50" class="d-inline-block">
    </a>
    <a href="mediciones.php" class="navbar-brand">Volver a las Mediciones</a>
    <div class="collapse navbar-collapse" id="navbarNav">
    </div>
  </div>
</nav>
<div class="container my-5">
  <h1 class="mt-2 mb-3 text-center">Grafica</h1>
  <div class="card">
    <div class="card-header">
      <div class="row">
      <div class="col col-sm-9">Grafico del Pozo ID <?php echo($id)?></div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <div class="chart-container pie-chart">
          <canvas id="lineChart" height="40"> </canvas>
        </div>
        <table class="table table-striped table-bordered" id="order_table">
          <br>
          <thead>
            <tr>
              <th>ID MEDICION</th>
              <th>Medicion</th>
              <th>Fecha del Registro</th>
              <th>ID POZO</th>
            </tr>
          </thead>
          <tbody>
          <?php
            include_once('conection.php');
            $sql_query = "SELECT * FROM mediciones WHERE id_pozo = $id;";
            $result = $conn->query($sql_query);
            
            if(!$result){
              die("Invalid Query". $conn->error);
            }

            if(mysqli_num_rows($result) > 0 ){

              while($row = $result->fetch_assoc()){
                echo "
                <tr>
                  <td>$row[id_mediciones]</td>
                  <td>$row[medicion] PSI</td>
                  <td>$row[fecha_registro]</td>
                  <td>$row[id_pozo]</td>
                </tr>
                ";
              }
            } else {
              echo('No hay Registros por los momentos');
            }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
   
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const CHART = document.getElementById("lineChart");
        console.log(CHART);
        let lineChart = new Chart(CHART, {
            type: "bar",
            data: {
                labels: [<?php echo '"'.implode('","',  $fechas ).'"' ?>],
                datasets: [{
                    label: 'Gráfica Para los Pozos Valor en PSI',
                    data: [<?php echo '"'.implode('","',  $valores ).'"' ?>],
                    fill: true,
                    tension: 0.1,
                    backgroundColor : 'rgb(255,0,0)'
                }]
        }
    })
    </script>
</body>
</html>