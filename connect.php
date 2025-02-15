<?php
$servidor = 'localhost';
$user = 'root';
$senha = '';
$bd = 'sciencefair';

$conn = new mysqli($servidor, $user, $senha, $bd);
// mysqli_set_charset($conn, "UFT-8");

if($conn->connect_error){
    die("Erro de conexão: ".$conn -> connect_errno.": ".$conn -> connect_error);
}

?>