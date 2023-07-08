<?php

$host = "localhost";
$user = "id19273733_andres2814";
$pass = "@Egs4147";
$db   = "id19273733_db_pdvsa";

$conn = mysqli_connect($host, $user, $pass, $db);

if(mysqli_connect_errno()){
    echo "Error: " . mysqli_connect_error();
}else{
    //echo "conectado";
}

?>