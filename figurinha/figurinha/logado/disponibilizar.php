<?php
    //Chamar o arquivo verificar para poder saber se realmente está logado 
    include 'verificar.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Disponibilizar para Troca</title>
        <!--Css-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../estilo.css">
        <!--Js-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    </head>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }   
    </style>
    <body>
        <!--Navbar--> 
    <nav class="navbar navbar-expand-lg navbar-light " style="width:100%;height:60px; background-color:rgb(245, 255, 156); color:white;">
        <img href ="index.php" src="img/logo.png" width=" 80" height="50" alt="">
        <a class="navbar-brand" href="#"></a>
        <a class="navbar-brand" href="index.php">Home <span class="sr-only">(current)</span></a>
        <a class="navbar-brand" href="#"></a>
        <a class="navbar-brand" href="disponibilizar.php">Disponibilizar </a>
        <a class="navbar-brand" href="#"></a>
        <a class="navbar-brand" href="trocar.php">Troca de Figurinhas</a>
        <a class="navbar-brand" href="#"></a>
        <a class="navbar-brand" href="ganhar.php">Ganhar Figurinhas</a>
        <a class="navbar-brand" href="#"></a>
        <a class="navbar-brand" href="deslogar.php">Sair</a>
        <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    </nav>
        <p>
            <form action="disponibilizarBd.php" method="post">
                <table >
                    <tr>
                        <th>\/</th>
                        <th>Figurinha</th>
                    </tr>
                    <?php
                        $select = "SELECT figurinhas.nome, usuariosfigurinhas.id as ufid
                        FROM figurinhas, usuariosfigurinhas, usuarios 
                        WHERE usuarios.id = '$idUser' 
                        AND usuarios.id = usuariosfigurinhas.usuarios_id 
                        AND usuariosfigurinhas.figurinha_id = figurinhas.id
                        AND usuariosfigurinhas.disponivel = 1";
                        $vetor = buscarFigurinhas($select, $idUser, $conexao);
                        if($vetor != -1){
                            foreach ($vetor as $key => $value) {
                                echo '<tr>';
                                echo '<td>';
                                echo "<input type='checkbox' name='array[]' value='".$value['ufid']."'>";
                                echo '</td>';
                                echo '<td>';
                                echo $value['nome'];
                                echo '</td>';
                                echo '</tr>';
                            }
                        }else{
                            echo "<p>Voce não possui nenhuma figurinha disponivel para troca!</p>";
                        }
                    ?>
                </table><br/>
                <button type='submit'class="btn btn-outline-dark">Disponibilizar</button>
                <a href="index.php"><button type='button'class="btn btn-outline-dark">Voltar</button></a>
            </form>
            
        </p>
    </body>
</html>