<?php

include_once('conection.php');

$id_pozo = "";
$medicion="";

$mensajeError = "";

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $id_pozo = $_POST['id_pozo'];
    $medicion= $_POST['medicion'];
   
    
    do {

         // validacion
         $validation = "SELECT * FROM pozos WHERE id = '$id_pozo'";
         $checking = $conn->query($validation);
 
         if($checking->num_rows == 0){
            $mensajeError = "El Pozo no se encuentra en la Base de datos, por favor verifica el ID en la Lista";
            break;
         }        
        
        $sql_query = "INSERT INTO mediciones (medicion, id_pozo)".
                     "VALUES ('$medicion', '$id_pozo')";
        $result = $conn->query($sql_query);

        
        if(!$result){
            die("Invalid Query". $conn->error);
            break;
        }
        
        $id_pozo = "";
        $medicion= "";
        $mensajeError = "";

        header("location: mediciones.php");
        exit;

    } while (false);

    
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pozo</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <link rel="icon" href="./assets/img/favicon-pdvsa.png">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-body-tertiary" style="background-color:#d51928; color:#fff;">
  <div class="container-fluid" >
    <a class="navbar-brand " href="mediciones.php" >
      <img src="./assets/img/pdvsa-logo.jpg" alt="Logo" width="100" height="50" class="d-inline-block">
      Volver a Mediciones
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
    </div>
  </div>
</nav>
    <div class="container my-5">
        <h5>Nota: Recuerda que solo puedes agregar una medicion a los pozos que se encuentren registrados en el sistema</h5>
        <h5>para ver la Lista de Pozos y sus ID oprima el boton ver Lista</h5> <br>
        <div class="row mb-3">
            <div class="d-grid gap-2 col-6 mx-auto p-3">     
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Ver Lista
                </button>
            </div>
        </div>

        <div class="collapse" id="collapseExample">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Pozos</h4>
                        
                    </div>
                    <div class="card-body">
                      

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del Pozo</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              include_once('conection.php');
                              $sql_query = "SELECT * FROM pozos";
                              $result = $conn->query($sql_query);

                              if(!$result){
                                die("Invalid Query". $conn->error);
                              }

                              if(mysqli_num_rows($result) > 0) {

                                  while($row = $result->fetch_assoc()){
                                    echo "
                                    
                                    
                                    <tr>
                                        <td>$row[id]</td>
                                        <td>$row[nombre_pozo]</td>
                                    </tr>
                                    ";
                                  }
                              } else {
                                echo("
                                <tr>
                                  <td>No No Hay Registros</td>
                                  <td>No Hay Registros</td>
                                </tr>
                                ");
                              }
                    
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        </div>
        <h2>Nuevo Medicion</h2>
        <form  method="post">
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Medicion en PSI</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" name="medicion" value="<?php echo $medicion;?>" required="true">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">ID del Pozo</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="id_pozo" value="<?php echo $id_pozo;?>" required="true">
                </div>
            </div>

            
            <?php
                if(!empty($mensajeError)){
                    echo("<div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>$mensajeError</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>");
                }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <input type="submit" name="btn_agregarMedicion" class="btn btn-primary" value="Agregar Medicion"></input>
                </div>
            </div>
        </form>
    </div>
</body>
</html>