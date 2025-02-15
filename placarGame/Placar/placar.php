<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="15">
    <link rel="stylesheet" href="../CSS/placar.css">
    <link rel="stylesheet" href="../CSS/walk_anim.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">

    <title>Placar | Jogadores</title>
    <!-- POR ALGUM MOTIVO ESSE ESTILO NÃO ESTAVA PEGANDO NO ARQUIVO EXTERNO -->
    <style>
        .logotipo {
            width: 30px;
            float: left;
        }

        .lastplay {
            color: black;
            font-size: 2.6em;
            text-align: center;
            padding-top: 5px;
        }
    </style>
</head>

<body>
    <!-- Placar -->
    <main class="placar">


        <?php
        //definição dos personagens que irão indicar visualmente o tempo de alternância de tela
        $characters = [
            'mario4.gif', 'mario2.gif', 'sonic.gif',
            'keN.gif', 'metalSlug.gif', 'ekko.gif',
            'megaMan.gif', 'sans.gif', 'ghost.gif',
            'pacman.gif', 'amongus.gif', 'tails.gif'
        ];

        $RamCharacter = function ($characters) {
            return $characters[array_rand($characters)];
        };

        //resoluação para alternar de tela a cada refresh
        $time = date('sa');
        $seg =  substr($time, 0, 2);
        $type = 'tempo';
        if ($seg % 2 == 0) {
            $type = 'ponto';
        }

        require_once('../../connect.php');
        $result = $conn->query("SELECT * FROM jogo WHERE tipoPont='$type'");

        //Tratamento para caso mais jogos, extendo para 3 ou 4 telas 
        $total = mysqli_num_rows($result);
        $f = 0;
        $l = 5;
        if ($seg > 30) {
            if ($total > 5) {
                $f = 5;
                $l = 10;
            }
        }

        //Exibição do Placar
        $SQL = "SELECT * FROM jogo, plataforma WHERE tipoPont='$type' AND jogo.idP=plataforma.idP LIMIT $f, $l";
        $result = mysqli_query($conn, $SQL);
        while ($jogo = mysqli_fetch_array($result)) {
        ?>

            <div class="model-game" style="background-image: url(../images/<?php echo $jogo['imgFundo']; ?>)">
                <div class="about-game">
                    <img src="<?php echo $jogo['imgPlataforma']; ?>" height="42px">
                    <div class="name-game">
                        <?php echo $jogo['nomeJogo']; ?>
                    </div>
                </div>

                <div class="info"><span>RANK</span><span><?php echo ($type == 'tempo') ? "TIME" : "SCORE"; ?></span></div>
                <?php
                $ordem = $jogo['ordem'];
                $queryResult = "SELECT visitante.nick, resultado.{$type} FROM resultado, visitante WHERE resultado.idV=visitante.idV AND resultado.idJ = {$jogo['idJ']} ORDER BY resultado.{$type} $ordem LIMIT 10";
                $result2 = mysqli_query($conn, $queryResult);

                $pos = 1;
                while ($placar = mysqli_fetch_array($result2)) {
                    $top = ($pos == 1) ? "#f5f587" : "#807E54";
                    $crowntop1 = ($pos == 1) ? '<img src="../images/fixed/coroa.png" height="24px">' : '';
                ?>
                    <div class="line-position">
                        <div class="rank-position" style="background-color:<?php echo ($pos < 3) ? $top : "whitesmoke"; ?>;"><?php echo $pos; ?></div>
                        <div class="rank-player"><span><?php echo $placar['nick'] . $crowntop1; ?></span><span><?php echo ($type == "tempo") ? substr($placar[$type], 3) : $placar[$type]; ?></span></div>
                    </div>
                <?php
                    $pos++;
                }
                // Resolução para quando não houver records manter as informações do placar
                for ($i = $pos; $i <= 10; $i++) {
                    $top = ($i == 1) ? "#f5f587" : "#807E54";
                ?>
                    <div class="line-position">
                        <div class="rank-position" style="background-color:<?php echo ($i < 3) ? $top : "whitesmoke"; ?>;"><?php echo $i; ?></div>
                        <div class="rank-player"><span>&nbsp;</span><span>&nbsp;</span></div>
                    </div>

                <?php
                }
                ?>

            <?php
            echo "</div>";
        }
            ?>
            <!-- Exibição das ultimas jogadas -->
            <div class="model-game" style="background-image:url(../images/fundos/flipower.gif);">
                <div class="about-game">
                    <h1 class="lastplay">Ultimas Jogadas</h1>
                </div>
                <div class="info"><span>NICK</span><span><?php echo ($type == 'tempo') ? 'TIME' : 'SCORE'; ?><span></div>
                <?php
                $sqltempos = "SELECT visitante.nick, resultado.{$type}, jogo.logo FROM resultado, visitante, jogo WHERE resultado.idV=visitante.idV AND resultado.idJ = jogo.idJ AND jogo.tipoPont = '$type'  ORDER BY resultado.idR DESC LIMIT 10;";
                $result = mysqli_query($conn, $sqltempos);
                while ($plays = mysqli_fetch_array($result)) {

                ?>
                    <div class="line-position">
                        <div class="logotipo">
                            <img src="<?php echo $plays['logo']; ?>" alt="logo" width="32px">
                        </div>

                        <div class="rank-player">
                            <span>
                                <?php echo $plays['nick']; ?>
                            </span>
                            <span>
                                <?php echo ($type == 'tempo') ? substr($plays[$type], 3) : $plays[$type]; ?>
                            </span>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
    </main>
    <!-- Animação do rodapé  -->
    <footer>
        <div class="animation">
            <img src="../images/gifs/<?php echo $RamCharacter($characters) ?>" class="gif">
        </div>
        <div>
            <img src="../images/fixed/tubcut.png" alt="tubo" class="start">
        </div>
        <div>
            <img src="../images/fixed/tubcut.png" alt="tubo" class="end">
        </div>
    </footer>

</body>

</html>