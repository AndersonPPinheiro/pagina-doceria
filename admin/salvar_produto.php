<?php 
    session_start();

    if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'gerente') {
        header('Location: ../login.php');
        exit();
    }

    include_once('../conexao.php');

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];

    $sql = "INSERT INTO produtos (nome, descricao, preco, imagem_url) VALUES (?, ?, ?, ?)";
    $statement = $conexao -> prepare($sql);
    $statement -> bind_param("ssds", $nome, $descricao, $preco, $imagem);

    if ($statement -> execute()) {
        header('Location: admin_produtos.php?sucesso=1');
    }
    else {
        echo "Erro ao Salvar o Produto";
    }

    $statement -> close();
    $conexao -> close();
?>