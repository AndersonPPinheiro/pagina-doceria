<?php
include("../check/verificar_login.php");
include("../check/conexao.php");

$id_usuario = $_SESSION['id'];

$sql = "SELECT c.id_produto, c.quantidade, p.nome, p.preco 
        FROM carrinho c
        JOIN produtos p ON p.id = c.id_produto
        WHERE c.id_usuario = $id_usuario";

$res = $conexao->query($sql);

$itens = [];
$total = 0;

while ($row = $res->fetch_assoc()) {
    $subtotal = $row['preco'] * $row['quantidade'];
    $total += $subtotal;
    $itens[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Finalizar Pedido</title>
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <main class="checkout-container">
        <h2 class="checkout-title">Finalizar Compra</h2>

        <div class="checkout-box">
            <h3>Itens do Carrinho</h3>

            <?php foreach ($itens as $item): ?>
                <div class="checkout-item">
                    <span><?= $item['nome'] ?></span>
                    <span><?= $item['quantidade'] ?>x</span>
                    <span>R$ <?= number_format($item['preco'], 2, ',', '.') ?></span>
                </div>
            <?php endforeach; ?>

            <div class="checkout-total">
                <strong>Total:</strong>
                <strong>R$ <?= number_format($total, 2, ',', '.') ?></strong>
            </div>
        </div>

        <h3 class="h3-pagamento">Escolha a forma de pagamento</h3>

        <div class="checkout-payments">

            <a class="btn-pagamento" href="pagamento_pix.php">
                📱 Pagar com Pix
            </a>

            <a class="btn-pagamento" href="pagamento_cartao.php">
                💳 Cartão de Crédito
            </a>

            <a class="btn-pagamento" href="pagamento_dinheiro.php">
                💵 Dinheiro na Entrega
            </a>

        </div>

    </main>
</body>
</html>
