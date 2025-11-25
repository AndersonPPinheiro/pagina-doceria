<?php
    $usuario_logado = isset($_SESSION['id']);

    include('../verificar_login.php');

    if ($_SESSION['cargo'] !== 'gerente') {
        header('Location: ../menu.php');
        exit();
    }

    include_once('../conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Gerenciamento - Doceria PaiD'Égua</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="header-content">
            <h1 class="logo">Painel Administrador</h1>

            <div class="hamburger-menu" id="hamburger-menu">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>

            <nav class="main-nav" id="nav-links">
                <?php if ($_SESSION['cargo'] == 'gerente'): ?>
                    <a href="admin_usuarios.php">Usuários</a>
                    <a href="admin_produtos.php" class="active">Produtos</a>
                    <a href="../menu.php">Voltar</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="register-container admin produtos">
        <h2 class="h2 admin">Painel Gerenciamento</h2>
        <h3 class="h3 admin">Produtos</h3>

        <form action="salvar_produto.php" method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <label>Nome do Produto</label>
                <input type="text" name="nome" class="inputUser" required>
            </div>

            <div class="input-group">
                <label>Descrição</label>
                <textarea name="descricao" class="inputUser" rows="4" required></textarea>
            </div>

            <div class="input-group">
                <label>Preço</label>
                <input type="number" class="inputUser" step="0.01" name="preco" required>
            </div>

            <div class="input-group">
                <label>Imagem</label>
                <input type="text" class="inputUser" name="imagem" placeholder="ex: img/produto1.jpg" required>
            </div>

            <input type="submit" name="submit" value="Enviar" class="btn-register">
        </form>
    </main>
    <script src="../js/nav_hamburger.js"></script>
</body>
</html>