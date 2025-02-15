<?php
if(isset($_FILES['fundo'])){//Verifica se a global variável existe.

$foto = $_FILES['fundo']; // Amarzena o array do arquivo em uma variável.

if($foto['error']){//verifica se o valor 'erro' do array é igual a true, caso seja, houve algum erro.
    die('Falha ao enviar o arquivo');// Interrompe a execução do script e mostra uma mensagem, justificando o motivo.
}

if($foto['size'] > 1024 * 1024 * 2){ //Verifica se o valor contido na chave de string "size" é superior ao tamanho suportado pelo php, 2MB.
    die('Arquivo muito grande. Tam Max: 2MB');
}

$folder = '../images/fundos/'; //Define a string do caminho do diretorio onde será salvo a imagem.
$nomeFoto = $foto['name']; //Armazena o nome do arquivo em uma variável 
$nomeRam = uniqid(); //Gera uma ceadeia de caracteres aleátoria.
$ext = strtolower(pathinfo($nomeFoto, PATHINFO_EXTENSION));//Obtém a extensão do arquivo utlizando a função 'pathinfo() para pegar informações do caminho, passando o nome do arquivo e o recurso da função que pega a extensão, como argumento.


$fundo = $folder.$nomeRam.'.'.$ext; //Constrói um caminho utlizando as variáveis que armazenam: local, nome aleatório e extenção.//OBS: Essa mesma variável de caminho pode ser informada no escopo da inserção sql, para realizar registros no banco.

$upload = move_uploaded_file($foto['tmp_name'], $fundo);//Realiza de fato o upload utilizando o nome temporário e caminho informado.
}
?>

<?php
if(isset($_FILES['logo'])){

$foto = $_FILES['logo']; 

if($foto['error']){
    die('Falha ao enviar o arquivo');
}

if($foto['size'] > 1024 * 1024 * 2){ 
    die('Arquivo muito grande. Tam Max: 2MB');
}

$folder = '../images/logotipos/'; 
$nomeFoto = $foto['name'];  
$nomeRam = uniqid(); 
$ext = strtolower(pathinfo($nomeFoto, PATHINFO_EXTENSION));

$logo = $folder.$nomeRam.'.'.$ext; 

$upload = move_uploaded_file($foto['tmp_name'], $logo);
}
?>



