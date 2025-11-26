<?php
    include("../check/conexao.php");

    $id = intval($_GET['id']);

    $sql = $conexao->query("SELECT * FROM produtos WHERE id = $id");
    echo json_encode($sql->fetch_assoc());
?>
