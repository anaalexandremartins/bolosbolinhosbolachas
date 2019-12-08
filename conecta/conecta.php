<?php
$servidor = 'localhost';
$utilizador = 'root';
$password = '';
$db = 'projetoloja';

$conn = mysqli_connect($servidor,$utilizador,$password,$db);

if(!$conn){
    echo 'erro ao conectar';
    die();
}
?>
