<?php 

if(isset($_GET['id'])){
    
    $id = $_GET['id'];

    include_once('conection.php');

    // Borramos Ambos Registros ya que si se borra el pozo, deben borrarse las mediciones asociadas al mismo
    $sql_query = "DELETE FROM mediciones WHERE id_pozo = $id;";
    $sql_query .= "DELETE FROM pozos WHERE id = $id;";
    $conn ->multi_query($sql_query);

}

header("location: index.php");

?>