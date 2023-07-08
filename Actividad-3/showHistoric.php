<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros Historicos</title>
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
<!-- <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="./assets/img/pdvsa-logo.jpg" alt="Logo" width="100" height="80" class="d-inline-block align-text-top">
    </a>
  </div>
</nav> -->
<nav class="navbar navbar-expand-lg navbar-dark bg-body-tertiary" style="background-color:#d51928; color:#fff;">
  <div class="container-fluid" >
    <a class="navbar-brand " href="index.php" >
      <img src="./assets/img/pdvsa-logo.jpg" alt="Logo" width="100" height="50" class="d-inline-block">
    </a>
    <a href="index.php" class="navbar-brand">Pozos</a>
    <a href="mediciones.php" class="navbar-brand">Mediciones</a>
    <a href="showHistoric.php" class="navbar-brand">Historico de Registros</a>
    <div class="collapse navbar-collapse" id="navbarNav">
    </div>
  </div>
</nav>
<div class="container my-5">
<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista Historica de los Registros</h4>
                        
                    </div>
                    <div class="card-body">
                      

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID MEDICION</th>
                                    <th>Medicion</th>
                                    <th>Fecha de Registro</th>
                                    <th>ID POZO</th>
                                    <th>Nombre Pozo</th>
                                    <th>Region</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              include_once('conection.php');
                              $sql_query = "SELECT * FROM mediciones INNER JOIN pozos ON pozos.id = mediciones.id_pozo;";
                              $result = $conn->query($sql_query);

                              if(!$result){
                                die("Invalid Query". $conn->error);
                              }
                              
                    
                              while($row = $result->fetch_assoc()){
                                echo "
                                
                                
                                <tr>
                                    <td>$row[id_mediciones]</td>
                                    <td>$row[medicion] PSI</td>
                                    <td>$row[fecha_registro]</td>
                                    <td>$row[id_pozo]</td>
                                    <td>$row[nombre_pozo]</td>
                                    <td>$row[region]</td>
                                    
                                </tr>
                                ";
                              }
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    
</div>
</body>
</html>