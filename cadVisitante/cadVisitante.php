 <!-- Código PHP Apenas para fazer a inserção dos visitantes -->
 <!-- ESTÁ PRONTO -->
 <?php

//Declaração de variavéis Globais
 $nomeV = $_POST['nomeV'];
 $celV = $_POST['celV'];
 $dataNascV = $_POST['dataNascV'];
 $nick = $_POST['nick'];
 $idCurso = $_POST['curso'];
 
 //Tratamento caso o nick não seja informado
if(empty($nick)){
    $names = explode(" ", $nomeV);
    $lastNick = isset($names[1]) ? $names[1] : "";
    
    if(isset($names[2])){   
        $lastNick = (strlen($names[1]) <= strlen($names[2])) ? $names[1] : $names[2];
    }

    $sizeName = $names[0]." ".$lastNick;
    $nick = (strlen($sizeName) <= 20) ? $sizeName : $names[0];
}

//Cadastrando Visitante
 require_once('../connect.php');
 $SQL = "INSERT INTO visitante(nomeVisitante, celular, dataNasc, nick) VALUES ('$nomeV','$celV','$dataNascV','$nick')";
 $insertQuery = mysqli_query($conn, $SQL);

//Buscando id do visitante cadastrado
$result = $conn->query("SELECT idV, nomeVisitante FROM visitante WHERE nomeVisitante='$nomeV'");
$buscaId = mysqli_fetch_array($result);
$idV = $buscaId['idV']; 

//Relacionando Cursos com Visitante
$insertCurso = "INSERT INTO Curso_Visitante(idC, idV) VALUES";
foreach($idCurso as $idC){
    $insertCurso = $insertCurso."(".$idC.",".$idV."),";
}
$insertCurso = substr($insertCurso, 0, -1);
mysqli_query($conn, $insertCurso);

header('Location: index.php');
 ?>