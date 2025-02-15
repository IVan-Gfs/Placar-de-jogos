<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/cadGame.css">
    <title>Cadastrar | Jogo</title>
</head>
<body>
    <!-- Form -->
    <section class="cadastro_jogos">
        <?php
        require_once('../../connect.php');
        if (isset($_POST['nomeJogo'])) {
            $nomeJogo = $_POST['nomeJogo'];
            $idP = $_POST['plataforma'];
            $tipoPont = $_POST['rank'];
            $ordem = $_POST['ordem'];

            $SQL = "SELECT COUNT(*) AS linhas FROM jogo WHERE nomeJogo='$nomeJogo'";
            $result = mysqli_query($conn, $SQL);
            $linhas = mysqli_fetch_array($result);

            if ($linhas['linhas'] > 0) {
                echo '<p>O jogo : "' . $nomeJogo . '" Já existe!</p>';
                echo '<a href="index.php" class="btnBack">Cadastre outro Jogo</a>';
            } else {
                require_once('./uploadF.php');
                $SQL = "INSERT INTO Jogo (nomeJogo, idP, logo, imgFundo, tipoPont, ordem) VALUES ('$nomeJogo',$idP,'$logo','$fundo','$tipoPont','$ordem')";
                if(mysqli_query($conn, $SQL)){
                    $sql="SELECT * FROM JOGO WHERE nomeJogo ='".$nomeJogo."'";
		    		$resultado=mysqli_query($conn, $sql);
		    		$jogo=mysqli_fetch_array($resultado);
                    echo '<p>Jogo: '.$jogo['nomeJogo'].' cadastrado com sucesso!</p>';
                    echo "<p><img src='".$jogo['logo']."' height='100px'></p>";
                    echo '<a href="index.php" class="btnBack">Cadastre outro jogo</a>';

                }else{
                    echo 'Não foi possivél add a imagem';
                }               
            }
        } else {
            $SQL = "SELECT * FROM plataforma ORDER BY nomePlataforma";
            $result = mysqli_query($conn,$SQL);
        ?>
            <div>
                <h1>Cadastro de Jogos</h1>
                <form action="index.php" method="POST" enctype="multipart/form-data">

                    <label for="nomeJogo">Nome da Jogo
                     <input type="text" name="nomeJogo" required>
                    </label><br><br>

                    <label>Selecione a plataforma do jogo</label>
                    <select name="plataforma" id="plataforma">
                        <?php while($plats=mysqli_fetch_array($result)){
                        ?>
                         <option value="<?php echo $plats['idP'];?>"><?php echo $plats['nomePlataforma'];?></option>
                        <?php
                        }
                        ?>
                    </select><br><br>

                    <label>Selecione o tipo de rank</label>
                    <select name="rank" id="rank">
                        <option value="tempo">Time</option>
                        <option value="ponto">Score</option>
                    </select><br><br>

                    <label>Ordem de Ranqueamento</label>
                    <select name="ordem" id="ordem">
                        <option value="ASC">Menor mais alto</option>
                        <option value="DESC">Maior mais alto</option>
                    </select><br><br>

                    <label>Escolha a imagem de fundo</label>
                    <label for="fundo">Selecione uma imagem</label>
                    <input type="file" name="fundo" id="fundo"  required><br><br>

                    <label>Escolha o logotipo</label>
                    <label for="logo">Selecione uma imagem</label>
                    <input type="file" name="logo" id="logo" accept="image/png" required><br>


                    <input type="submit" value="Registrar">
                </form>
            </div>
        <?php
        }
        ?>

    </section>
    <section class="jogos_cadastrados">
        <h2>Jogos já cadastrados</h2>
        <div class="jogos">
            <?php
            $result = $conn->query("SELECT * FROM jogo ORDER BY nomeJogo");

            while ($dadosJogo = mysqli_fetch_array($result)) {
            ?>
                <div class="jogo">
                    <div class="imgJogo">
                        <img src="<?php echo $dadosJogo['logo']; ?>" height="80px">
                    </div>
                    <div class="nomeJogo"><?php echo $dadosJogo['nomeJogo']; ?></div>
                </div>
            <?php
            }
            ?>
        </div>

    </section>
</body>
</html>