<?php
    include('../check/verificar_login.php');

    if ($_SESSION['cargo'] !== 'gerente') {
        header('Location: ../menu.php');
        exit();
    }

    include_once('../check/conexao.php');

    $sql = "SELECT id, nome_completo, email, telefone, cargo FROM usuarios";
    $result = $conexao -> query($sql);
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
                    <a href="../admin_usuarios.php" class="active">Usuários</a>
                    <a href="admin_produtos.php">Produtos</a>
                    <a href="../menu.php">Voltar</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
        
    <main class="register-container admin usuarios">
        <h2 class="h2 admin">Painel de Gerenciamento</h2>
        <h3 class="h3 admin">Usuários</h3>

        <table class="table-admin">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Cargo</th>
                <th>Situação</th>
            </tr>
        <?php
            if ($result -> num_rows > 0) {
                while ($u = $result -> fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $u['id']; ?></td>
                <td><?php echo $u['nome_completo']; ?></td>
                <td><?php echo $u['email']; ?></td>
                <td><?php echo $u['telefone']; ?></td>
                <td><?php echo $u['cargo']; ?></td>

                <td>
                    <!-- Botão excluir -->
                    <a href="excluir_usuario.php?id=<?php echo $u['id']; ?>"
                    onclick="return confirm('Deseja realmente excluir este usuário?');">
                    <button class="btn-small btn-delete">Excluir</button>
                    </a>

                    <!-- Botão alterar cargo -->
                    <?php if ($u['cargo'] === 'cliente') { ?>
                        <a href="alterar_cargo.php?id=<?php echo $u['id']; ?>&cargo=gerente">
                            <button class="btn-small btn-role">Promover a Gerente</button>
                        </a>
                    <?php } else { ?>
                        <a href="alterar_cargo.php?id=<?php echo $u['id']; ?>&cargo=cliente">
                            <button class="btn-small btn-role" style="background:#888;">
                                Rebaixar para Cliente
                            </button>
                        </a>
                    <?php } ?>

                </td>
            </tr>
        <?php 
                }
            }
        ?>
        </table>
    </main>
    <script src="../js/nav_hamburger.js"></script>
</body>