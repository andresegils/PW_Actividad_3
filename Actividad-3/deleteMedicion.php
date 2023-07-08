<?php 

if(isset($_GET['id'])){
    
    $id = $_GET['id'];

    include_once('conection.php');

    // Borramos las mediciones
    $sql_query = "DELETE FROM mediciones WHERE id_mediciones = $id;";
    $conn ->query($sql_query);

}

header("location: mediciones.php");

?>