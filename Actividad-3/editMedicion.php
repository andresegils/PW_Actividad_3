<?php

include_once('conection.php');

$id = "";
$id_pozo = "";
$medicion = "";



// Mostramos los datos para poder editarlo
if ( $_SERVER ['REQUEST_METHOD'] == 'GET'){
    
    if(!isset($_GET["id"]) && !isset($_GET["id_pozo"])){
        header('location: mediciones.php');
        exit;
    }

    $id = $_GET["id"];
    $id_pozo = $_GET['id_pozo'];
    
    $sql_query = "SELECT * FROM mediciones WHERE id_mediciones=$id";
    $result = $conn->query($sql_query);
    $row = $result->fetch_assoc();

    if(!$row){
        header('location: mediciones.php');
        exit;
    }

    $medicion = $row["medicion"];

} else {


    // POST

    $id = $_POST['id'];
    $id_pozo = $_POST['id_pozo'];
    $medicion = $_POST["medicion"];

    do{


        $sql_query = "UPDATE mediciones SET medicion = '$medicion' WHERE id_mediciones = $id ";
        $result = $conn->query($sql_query);
        header('location: mediciones.php');
        exit;

    } while(true);
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pozo</title>
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
        <h2>Editar Medicion</h2>
        <form  method="post">
        <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="hidden" name="id_pozo" value="<?php echo $id_pozo;?>">
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Medicion en PSI</label>
                <div class="col-sm-6">
                    <input type="number" step="0.01" class="form-control" name="medicion" value="<?php echo $medicion;?>" required="true">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <input type="submit" name="btn_EditarMedicion" class="btn btn-primary"></input>
                </div>
            </div>
        </form>
    </div>
</body>
</html>