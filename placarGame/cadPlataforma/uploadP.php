<?php
if(isset($_FILES['foto'])){

$foto = $_FILES['foto']; 

if($foto['error']){
    die('Falha ao enviar o arquivo');
}

if($foto['size'] > 1024 * 1024 * 2){ 
    die('Arquivo muito grande. Tam Max: 2MB');
}

$folder = '../images/plataformas/'; 
$nomeFoto = $foto['name'];  
$nomeRam = uniqid(); 
$ext = strtolower(pathinfo($nomeFoto, PATHINFO_EXTENSION));

$path = $folder.$nomeRam.'.'.$ext; 

$upload = move_uploaded_file($foto['tmp_name'], $path);
}
?>

