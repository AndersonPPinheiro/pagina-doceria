<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Doceria PaiD'Égua</title>
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
                <a href="catalogo.php" class="active">Produtos</a>
                <a href="carrinho.php">Carrinho</a>
                <a href="minha-conta.php">Minha Conta</a>
                <a href="index.php" class="logout-link">Sair</a>
            </nav>
        </div>
    </header>

    <main class="catalog-main">
        <h2>Nossas Delícias Fresquinhas</h2>

        <div class="product-grid">
            <div class="product-card">
                <img src="img/bolo_chocolate.jpg" alt="Bolo de Chocolate Clássico">
                <div class="product-info">
                    <h3>Bolo de Chocolate Clássico</h3>
                    <p class="product-description">Massa fofinha de cacau com recheio trufado e cobertura de brigadeiro belga.</p>
                    <span class="product-price">R$ 59,90</span>
                    <button class="btn-add-cart">Adicionar ao Carrinho</button>
                </div>
            </div>

            <div class="product-card">
                <img src="img/caixa_brigadeiro_gourmet.jpg" alt="Caixa de Brigadeiros Gourmet">
                <div class="product-info">
                    <h3>Brigadeiros Gourmet (Cx. c/ 12)</h3>
                    <p class="product-description">Sabores: tradicional, ninho com nutella e churros. Escolha seus favoritos!</p>
                    <span class="product-price">R$ 35,00</span>
                    <button class="btn-add-cart">Adicionar ao Carrinho</button>
                </div>
            </div>
            
            <div class="product-card">
                <img src="img/torta_limao_merengue.jpg" alt="Torta de Limão Merengue">
                <div class="product-info">
                    <h3>Torta de Limão</h3>
                    <p class="product-description">Massa crocante, recheio azedinho e merengue italiano maçaricado.</p>
                    <span class="product-price">R$ 45,50</span>
                    <button class="btn-add-cart">Adicionar ao Carrinho</button>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.getElementById('hamburger-menu').onclick = function() {
            document.getElementById('nav-links').classList.toggle('active');
            this.classList.toggle('open');
        };
    </script>
</body>
</html>