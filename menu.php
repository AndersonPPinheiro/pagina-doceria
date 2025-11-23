<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$usuario_logado = isset($_SESSION['id']);

include_once('conexao.php');

$sql = "SELECT * FROM produtos";
$result = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Doceria PaiD'Égua</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="header-content">
            <h1 class="logo">Doceria PaiD'Égua</h1>

            <div class="hamburger-menu" id="hamburger-menu">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>

            <nav class="main-nav" id="nav-links">
                <a href="menu.php" class="active">Produtos</a>
                <?php if ($usuario_logado): ?>
                    <a href="minha_conta.php">Minha Conta</a>
                    <?php if (isset($_SESSION['cargo']) && $_SESSION['cargo'] == 'gerente'): ?>
                        <a href="admin/admin_usuarios.php">Admin</a>
                    <?php endif; ?>
                    <a href="deslogar.php" class="logout-link">Sair</a>
                <?php else: ?>
                    <a href="login.php" class="login-link">Entrar</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- Botão flutuante do carrinho -->
    <a href="#" class="floating-cart">
        <div class="cart-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                <path d="M6 6h15l-1.5 9h-12L4 2H1" stroke="white" stroke-width="2" stroke-linecap="round"/>
                <circle cx="10" cy="20" r="1.5" fill="white"/>
                <circle cx="17" cy="20" r="1.5" fill="white"/>
            </svg>
        </div>

        <!-- Badge com quantidade -->
        <span class="cart-badge" id="cart-badge">0</span>
    </a>

    <!-- Overlay com blur -->
    <div id="cart-overlay" class="cart-overlay"></div>

    <!-- Popup do Carrinho -->
    <div id="cart-modal" class="cart-modal" aria-hidden="true">
        <div class="cart-header">
            <h2>Seu Carrinho</h2>
            <button id="cart-close" class="cart-close" aria-label="Fechar carrinho">✖</button>
        </div>

        <div id="cart-items" class="cart-items">
            <!-- Itens serão inseridos aqui via JS -->
            <p class="no-items">Nenhum item no carrinho</p>
        </div>

        <div class="cart-footer">
            <span class="total-label">Total:</span>
            <span class="total-price" id="cart-total">R$ 0,00</span>
        </div>
    </div>

    <main class="catalog-main">
        <h2>Nossas Delícias Fresquinhas</h2>

        <div class="product-grid">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($produto = $result->fetch_assoc()) {
            ?>
                <div class="product-card">
                    <img src="<?php echo htmlspecialchars($produto['imagem_url']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
                        <p class="product-description"><?php echo htmlspecialchars($produto['descricao']); ?></p>
                        <span class="product-price">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
                        <button class="btn-add-cart" data-id="<?php echo (int)$produto['id']; ?>">Adicionar ao Carrinho</button>
                    </div>
                </div>
            <?php
                }
            } else {
                echo "<p>Nenhum produto cadastrado.</p>";
            }
            ?>
        </div>
    </main>

    <script src="js/nav_hamburger.js"></script>
    <script src="js/carrinho.js"></script>

    <!-- Conecta os botões "Adicionar" ao handler (garante carregamento após carrinho.js) -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll(".btn-add-cart").forEach(btn => {
            btn.addEventListener("click", function() {
                const produtoId = this.getAttribute("data-id");
                if (produtoId) {
                    adicionar_carrinho(produtoId);
                }
            });
        });
    });
    </script>
</body>
</html>
