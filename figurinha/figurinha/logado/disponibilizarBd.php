<?php
    //Chamar o arquivo verificar para poder saber se realmente está logado 
    include 'verificar.php';

    if(empty($_POST['array'])){
        echo "<script>alert('Erro ao receber Figurinhas do Checkbox');window.location.href='index.php';</script>";
        die();
    }

    $vetor = $_POST['array'];
    print_r($vetor);

    foreach ($vetor as $key => $value) {
        $update = "UPDATE `usuariosfigurinhas` SET `disponivel` = 0 WHERE `id` = '$vetor[$key]'";
        
        if(!alterarDisponibilidade($update, $conexao)){
            echo "<script>alert('Erro ao inserir trocas no BD!');window.location.href='index.php';</script>";
            break;
        }
        
    }
    echo "<script>alert('Sucesso!');window.location.href='index.php';</script>";
?>