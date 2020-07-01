<?php
    //Chamar o arquivo verificar para poder saber se realmente está logado 
    include 'verificar.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Trocar</title>
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
        <h1>Selecionar Figurinhas para Troca</h1>
        <p>
            <form action="trocarUser.php" method="post">
                <table>
                    <tr>
                        <th>#</th>
                        <th>Id Usuario</th>
                        <th>Nome da Figurinha</th>
                    </tr>
                    <?php
                        $select = "SELECT figurinhas.nome, usuarios.id, usuariosfigurinhas.id as ufid
                        FROM figurinhas, usuariosfigurinhas, usuarios 
                        WHERE usuarios.id <> '$idUser'
                        AND usuarios.id = usuariosfigurinhas.usuarios_id 
                        AND usuariosfigurinhas.figurinha_id = figurinhas.id
                        AND usuariosfigurinhas.disponivel = 0";
                        $vetor = buscarFigurinhas($select, $idUser, $conexao);
                        if($vetor != -1){
                            foreach ($vetor as $key => $value) {
                                echo '<tr>';
                                echo '<td>';
                                $string = $value['id']. ',' . $value['ufid'];  
                                echo "<input type='radio' name='outroUser' value='".$string."'>";
                                echo '</td>';
                                echo '<td>';
                                echo $value['id'];
                                echo '</td>';
                                echo '<td>';
                                echo $value['nome'];
                                echo '</td>';
                                echo '</tr>';
                            }
                        }else{
                            echo "<p>Não há figurinhas disponiveis para troca!</p>";
                        }
                        echo '</tr>';
                    ?>
                    <button type="submit" class="btn btn-outline-dark">Trocar</button>
                    <a href="index.php"><button type='button' class="btn btn-outline-dark">Voltar</button></a>
                </table>
            </form>
        </p>    
    </body>
</html>