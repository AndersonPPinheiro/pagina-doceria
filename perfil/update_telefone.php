<?php
session_start();
include("../check/conexao.php");

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_SESSION['id'];
$telefone = $_POST['telefone'];

$stmt = $conexao->prepare("UPDATE usuarios SET telefone = ? WHERE id = ?");
$stmt->bind_param("si", $telefone, $id);
$stmt->execute();

header("Location: perfil.php?ok=telefone");
exit;
