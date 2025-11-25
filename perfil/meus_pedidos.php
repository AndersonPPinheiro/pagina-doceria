<?php
include("../verificar_login.php");
include("../conexao.php");

$id_usuario = $_SESSION['id'];
$usuario_logado = isset($_SESSION['id']);

// Buscar pedidos
$sql = "SELECT * FROM pedidos 
        WHERE id_usuario = $id_usuario
        ORDER BY criado_em DESC";

$res = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos</title>
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

    <main class="pedidos-container">

        <h2>Histórico de Pedidos</h2>

        <?php if ($res->num_rows == 0): ?>
            <p class="no-pedidos">Você ainda não fez nenhum pedido.</p>

        <?php else: ?>

            <div class="lista-pedidos">
                <?php while ($p = $res->fetch_assoc()): ?>
                    <a class="pedido-card" href="pedido_detalhes.php?id=<?= $p['id'] ?>">
                        
                        <div class="pedido-info">
                            <h3>Pedido #<?= $p['id'] ?></h3>
                            <p><strong>Total:</strong> R$ <?= number_format($p['total'], 2, ',', '.') ?></p>
                            <p class="pedido-status"><strong>Status:</strong> <?= ucfirst($p['status']) ?></p>
                        </div>

                        <div class="pedido-data">
                            <?= date("d/m/Y H:i", strtotime($p['criado_em'])) ?>
                        </div>

                    </a>
                <?php endwhile; ?>
            </div>

        <?php endif; ?>

    </main>

    <script src="../js/nav_hamburger.js"></script>

</body>
</html>
