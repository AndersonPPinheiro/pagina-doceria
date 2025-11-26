<?php
session_start();

include("../check/verificar_login.php");
include("../check/conexao.php");

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}

$usuario_logado = isset($_SESSION['id']);
$id = $_SESSION['id'];

$sql = $conexao->query("SELECT nome_completo, email, telefone FROM usuarios WHERE id = $id");
$usuario = $sql->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="../css/style.css">
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
                <a href="../menu.php">Menu</a>
                <?php if ($usuario_logado): ?>
                    <?php if (isset($_SESSION['cargo']) && $_SESSION['cargo'] == 'gerente'): ?>
                        <a href="../admin/admin_usuarios.php">Admin</a>
                    <?php endif; ?>
                    <a href="perfil.php" class="active">Perfil</a>
                <?php else: ?>
                    <a href="../login.php" class="login-link">Entrar</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <div class="perfil-container">

        <h2 class="perfil-titulo">Meu Perfil</h2>

        <div class="perfil-box">

            <p><strong>Nome:</strong> <?= $usuario['nome_completo'] ?></p>
            <p><strong>Email:</strong> <?= $usuario['email'] ?></p>
            <p><strong>Telefone:</strong> <?= $usuario['telefone'] ?: "Não informado" ?></p>

            <hr>

            <h3 class="perfil-subtitulo">Alterar Telefone</h3>
            <form action="update_telefone.php" method="POST" class="perfil-form">
                <input type="text" class="inputUser" name="telefone" value="<?= $usuario['telefone'] ?>" placeholder="Novo telefone" required>
                <button class="perfil-btn">Atualizar Telefone</button>
            </form>

            <h3 class="perfil-subtitulo">Alterar Senha</h3>
            <form action="update_senha.php" method="POST" class="perfil-form">
                <input type="password" class="inputUser" name="senha_atual" placeholder="Senha atual" required>
                <input type="password" class="inputUser" name="nova_senha" placeholder="Nova senha" required>
                <button class="perfil-btn">Alterar Senha</button>
            </form>

            <hr>

            <a class="perfil-link" href="meus_pedidos.php">📦 Meus Pedidos</a>
            <a class="perfil-link sair" href="../check/deslogar.php">🚪 Sair</a>
        </div>
    </div>

</body>
</html>
