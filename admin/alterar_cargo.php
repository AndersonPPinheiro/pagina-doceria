<?php 
    session_start();

    if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== 'gerente') {
        header('Location: ../menu.php');
        exit();
    }

    include_once('../check/conexao.php');

    $id = $_GET['id'];
    $novoCargo = $_GET['cargo'];

    if ($id == $_SESSION['id']) {
        echo "Você não pode alterar seu próprio cargo!";
        exit();
    }

    $sql = "UPDATE usuarios SET cargo = ? WHERE id = ?";
    $statement = $conexao -> prepare($sql);
    $statement -> bind_param("si", $novoCargo, $id);

    if ($statement -> execute()) {
        header('Location: admin_usuarios.php?msg=cargo_alterado');
    }
    else {
        echo "Erro ao alterar cargo!";
    }

    $statement -> close();
    $conexao -> close();
?>