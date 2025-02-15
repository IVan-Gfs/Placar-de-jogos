<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/cadV.css">
    <title>Cadastro | Visitante</title>
</head>

<body>
    <!-- Form -->
    <div class="main">
        <h1>Cadastro de Visitante</h1>
        <form action="cadVisitante.php" method="POST">
            <label>
                Nome <br>
                <input type="text" name="nomeV" placeholder="Digite seu nome" required>
            </label><br>
            <label>
                Celular <br>
                <input type="text" name="celV" placeholder="Ex: (11) 99632-2175">
            </label><br>
            <label>
                Data de Nascimento <br>
                <input type="date" name="dataNascV">
            </label><br>
            <label>
                Nickname(apelido) para seção de jogos <br>
                <input type="text" name="nick">
            </label>



            <fieldset>
                <legend>Escolha quais cursos você teria interesse em fazer</legend>
                <?php
                require_once('../connect.php');
                $cursoQuery = "SELECT * FROM curso ORDER BY nomeCurso";
                $result = mysqli_query($conn, $cursoQuery);
                $pos = 1;
                while ($curso = mysqli_fetch_array($result)) {
                ?>
                    <input type="checkbox" id="<?php echo $curso['idC']; ?>" name="curso[<?php echo $pos; ?>]" value="<?php echo $curso['idC']; ?>" />
                    <label class="check" for="<?php echo $curso['idC']; ?>"><?php echo $curso['nomeCurso']; ?></label>
                <?php
                    $pos++;
                }
                ?>

            </fieldset>
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>

</html>