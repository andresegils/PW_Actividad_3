<?php

include_once('conection.php');

$nombre_pozo="";
$region = "";

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $nombre_pozo= $_POST['nombre_pozo'];
    $region= $_POST['region'];
    

    do {

        
        $sql_query = "INSERT INTO pozos (nombre_pozo, region)".
                     "VALUES ('$nombre_pozo','$region')";
        $result = $conn->query($sql_query);
        
        if(!$result){
            die("Invalid Query". $conn->error);
            break;
        }
        
        $nombre_pozo= "";
        $region= "";

        header("location: index.php");
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
    <a class="navbar-brand " href="index.php" >
      <img src="./assets/img/pdvsa-logo.jpg" alt="Logo" width="100" height="50" class="d-inline-block">
      Volver al inicio
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
    </div>
  </div>
</nav>
    <div class="container my-5">
        <h2>Nuevo Pozo</h2>
        <form  method="post">
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Nombre del Pozo</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nombre_pozo" value="<?php echo $nombre_pozo;?>" required="true">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Region</label>
                <div class="col-sm-6">
                    <select class="form-select" aria-label="Default select example" name="region" value="<?php echo $region;?>" required="true">
                        <option selected disabled>Elige la Region</option>
                        <option value="Delta Amacuro">Delta Amacuro</option>
                        <option value="Monagas">Monagas</option>
                        <option value="Sucre">Sucre</option>
                        <option value="Anzoategui">Anzoategui</option>
                        <option value="Zulia">Zulia</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <input type="submit" name="btn_agregarPozo" class="btn btn-primary"></input>
                </div>
            </div>
        </form>
    </div>
</body>
</html>