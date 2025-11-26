<?php
session_start();
include("../check/conexao.php");

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_SESSION['id'];
$senha_atual = $_POST['senha_atual'];
$nova_senha = $_POST['nova_senha'];

$sql = $conexao->query("SELECT senha FROM usuarios WHERE id = $id");
$user = $sql->fetch_assoc();

if (!password_verify($senha_atual, $user['senha'])) {
    header("Location: perfil.php?erro=senha");
    exit;
}

$senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

$stmt = $conexao->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
$stmt->bind_param("si", $senha_hash, $id);
$stmt->execute();

header("Location: perfil.php?ok=senha");
exit;
