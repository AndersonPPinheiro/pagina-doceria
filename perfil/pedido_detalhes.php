<?php
include("../verificar_login.php");
include("../conexao.php");

$id_usuario = $_SESSION['id'];
$id_pedido = intval($_GET['id']);
$usuario_logado = isset($_SESSION['id']);

// Verifica se o pedido pertence ao usuário
$sql = "SELECT * FROM pedidos 
        WHERE id = $id_pedido AND id_usuario = $id_usuario";

$res = $conexao->query($sql);

if ($res->num_rows == 0) {
    die("Pedido não encontrado.");
}

$pedido = $res->fetch_assoc();

// Itens
$sql_itens = "SELECT pi.*, p.nome 
              FROM itens_pedido pi
              JOIN produtos p ON p.id = pi.id_produto
              WHERE pi.id_pedido = $id_pedido";

$itens = $conexao->query($sql_itens);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Pedido</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header class="main-header">
        <div class="header-content">
            <h1 class="logo">Meus Pedidos</h1>

            <div class="hamburger-menu" id="hamburger-menu">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>

            <nav class="main-nav" id="nav-links">
                <a href="../menu.php">Menu</a>
                <?php if ($usuario_logado): ?>
                    <a href="perfil.php">Minha Conta</a>
                    <?php if (isset($_SESSION['cargo']) && $_SESSION['cargo'] == 'gerente'): ?>
                        <a href="../admin/admin_usuarios.php">Admin</a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="login.php" class="login-link">Entrar</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="pedido-detalhes-container">

        <div class="pedido-detalhes-box">

            <h2>Pedido #<?= $pedido['id'] ?></h2>

            <p><strong>Status:</strong> <?= ucfirst($pedido['status']) ?></p>
            <p><strong>Data:</strong> <?= date("d/m/Y H:i", strtotime($pedido['criado_em'])) ?></p>

            <h3>Itens</h3>

            <?php while ($i = $itens->fetch_assoc()): ?>
                <div class="pedido-item">
                    <span><?= $i['nome'] ?></span>
                    <span> <?= $i['quantidade'] ?>x</span>
                    <span>R$ <?= number_format($i['preco'], 2, ',', '.') ?></span>
                </div>
            <?php endwhile; ?>

            <div class="pedido-total">
                <strong>Total:</strong>
                <strong>R$ <?= number_format($pedido['total'], 2, ',', '.') ?></strong>
            </div>

            <?php if ($pedido['status'] === 'pendente'): ?>
                <form action="../checkout/cancelar_pedido.php" method="POST" onsubmit="return confirm('Tem certeza que deseja cancelar este pedido?');">
                    <input type="hidden" name="id_pedido" value="<?= $pedido['id'] ?>">
                    <button class="btn-cancelar-pedido" type="submit">Cancelar Pedido</button>
                </form>
            <?php endif; ?>

            <a class="voltar-pedidos" href="meus_pedidos.php">← Voltar</a>

        </div>

    </main>

    <script src="../js/nav_hamburger.js"></script>

</body>
</html>
