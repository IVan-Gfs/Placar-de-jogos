<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/cadplat.css">
    <style>
        
    </style>
    
    <title>Cadastro | Plaforma</title>
</head>

<body>
    <section class="cadastro_plataformas">
        <?php
        require_once('../../connect.php');
        if (isset($_POST['nomePlat'])) {
            $nomePlat = $_POST['nomePlat'];

            $SQL = "SELECT COUNT(*) AS linhas FROM plataforma WHERE nomePlataforma='$nomePlat'";
            $result = mysqli_query($conn, $SQL);
            $linhas = mysqli_fetch_array($result);

            if ($linhas['linhas'] > 0) {
                echo '<p>A Plataforma: "' . $nomePlat . '" Já existe!</p>';
                echo '<a href="index.php" class="btnBack">Cadastre outra plataforma</a>';
            } else {
                require_once('./uploadP.php');
                $SQL = "INSERT INTO plataforma (nomePlataforma, imgPlataforma) VALUES ('$nomePlat','$path')";
                if(mysqli_query($conn, $SQL)){
                    $sql="SELECT * FROM plataforma WHERE nomePlataforma='".$nomePlat."'";
		    		$resultado=mysqli_query($conn,$sql);
		    		$plataforma=mysqli_fetch_array($resultado);
                    echo '<p>Plataforma: '.$plataforma['nomePlataforma'].' cadastrada com sucesso!</p>';
                    echo "<p><img src='".$plataforma['imgPlataforma']."' height='100px'></p>";
                    echo '<a href="index.php" class="btnBack">Cadastre outra plataforma</a>';

                }else{
                    echo 'Não foi possivél add a imagem';
                }               
            }
        } else {
        ?>
            <div>
                <h1>Cadastro de Plaformas</h1>
                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <label for="nomePlat">Nome da Plataforma
                     <input type="text" name="nomePlat" required>
                    </label><br><br>
                    <label>Escolha a imagem</label>
                    <label for="foto">Selecione uma imagem</label>
                    <input type="file" name="foto" id="foto" accept="image/png" required><br>
                    <input type="submit" value="Registrar">
                </form>
            </div>
        <?php
        }
        ?>

    </section>
    <section class="plataformas_cadastradas">
        <h2>Plataformas já cadastradas</h2>
        <div class="plataformas">
            <?php
            $result = $conn->query("SELECT * FROM plataforma ORDER BY nomePlataforma");

            while ($dadosPlat = mysqli_fetch_array($result)) {
            ?>
                <div class="plat">
                    <div class="imgPlat">
                        <img src="<?php echo $dadosPlat['imgPlataforma']; ?>" height="80px">
                    </div>
                    <div class="nomePlat"><?php echo $dadosPlat['nomePlataforma']; ?></div>
                </div>
            <?php
            }
            ?>
        </div>

    </section>
</body>

</html>