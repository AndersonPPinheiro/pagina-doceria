<?php 
    session_start();

    if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'gerente') {
        header('Location: ../menu.php');
        exit();
    }

    include_once('../check/conexao.php');

    $id = $_GET['id'];

    if ($id == $_SESSION['id']) {
        echo "Você não pode excluir a sua própria conta!";
        exit();
    }

    $sql = "DELETE FROM usuarios WHERE id = ?";
    $statement = $conexao -> prepare($sql);
    $statement -> bind_param("i", $id);

    if ($statement -> execute()) {
        header('Location: admin_usuarios.php?msg=excluido');
    }
    else {
        $mensagem = "Você não pode excluir sua própria conta.";
        echo "<script>alert('$mensagem');</script>";
    }

    $statement -> close();
    $conexao -> close();
?>