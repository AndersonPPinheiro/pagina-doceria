<?php 
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}

$id_pedido = $_GET['id'] ?? 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Concluído</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="sucesso-page">
    <div class="sucesso-box">
        <h2 class="sucesso-title">Pedido realizado com sucesso! 🎉</h2>

        <p class="sucesso-text">
            Seu pedido <strong>#<?= $id_pedido ?></strong> foi registrado com sucesso.
        </p>

        <a class="btn-fake-paid" href="../perfil/meus_pedidos.php">📦 Ver Meus Pedidos</a>
        <a class="btn-fake-paid" href="../menu.php">🍰 Voltar ao Menu</a>
    </div>
</div>

</body>
</html>