<html>
<head>
    <meta charset="utf-8">
    <title>Ganhar</title>
    <!--Css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../estilo.css">
        <!--Js-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</head>
<body> <!--NavBar-->
    <nav class="navbar navbar-expand-lg navbar-light " style="width:100%;height:60px; background-color:rgb(245, 255, 156); color:white;">
        <img href ="index.php" src="img/logo.png" width=" 80" height="50" alt="">
        <a class="navbar-brand" href="#"></a>
        <a class="navbar-brand" href="index.php">Home <span class="sr-only">(current)</span></a>
        <a class="navbar-brand" href="#"></a>
        <a class="navbar-brand" href="#">Features</a>
        <a class="navbar-brand" href="#"></a>
        <a class="navbar-brand" href="ganhar.php">Ganhar Figurinhas</a>
        <a class="navbar-brand" href="#"></a>
        <a class="navbar-brand" href="deslogar.php">Sair</a>
        <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    </nav>
<div><?php
    include 'verificar.php';
    if(verificarUltimasFigurinhas($idUser, $conexao) == 1){
        for($i = 0; $i <= 4; $i++){
            $aleatorio = rand(1, 30);
            ganharFigurinhas($conexao, $idUser, $aleatorio);
        }
        echo "<script>alert('Parabéns! Voce Ganhou as figurinhas do dia, volte amanhã.');</script>";
        echo '<p>';
        $select = "SELECT figurinhas.* 
        FROM figurinhas, usuariosfigurinhas, usuarios 
        WHERE usuarios.id = $idUser 
        AND usuarios.id = usuariosfigurinhas.usuarios_id 
        AND usuariosfigurinhas.figurinha_id = figurinhas.id
        ORDER BY usuariosfigurinhas.id DESC LIMIT 5";
        $vetor = buscarFigurinhas($select, $idUser, $conexao);
        if($vetor != -1){
            foreach ($vetor as $key => $valor) {
                echo "<img src='img/$valor[caminho]' alt=''>";
            }
        }else{
            echo "<p>Voce não possui nenhuma figurinha</p>";
        }
        echo '</p>';
    }elseif(verificarUltimasFigurinhas($idUser, $conexao) == 0){
        echo "<p>Voce já ganhou as figurinhas do dia! Volte amanhã.</p>";
    }else{
        echo "<script>alert('Erro na função verificarUltimasFigurinhas.');</script>";
    }
    echo '<a href="index.php"><button class="btn btn-outline-dark">Voltar</button></a>';
?>
</div>
</body>
</html>