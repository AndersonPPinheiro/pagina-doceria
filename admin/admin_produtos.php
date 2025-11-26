<?php
    $usuario_logado = isset($_SESSION['id']);

    include('../check/verificar_login.php');

    if ($_SESSION['cargo'] !== 'gerente') {
        header('Location: ../menu.php');
        exit();
    }

    include_once('../check/conexao.php');

    $produtos = $conexao->query("SELECT * FROM produtos ORDER BY id DESC");
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

        <div class="aba-buttons">
            <button class="aba-btn active" onclick="trocarAba('abaAdicionar')">Adicionar</button>
            <button class="aba-btn" onclick="trocarAba('abaModificar')">Modificar</button>
        </div>

        <div id="abaAdicionar" class="box-aba active">
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
                    <input type="file" class="inputUser" name="imagem" accept="img/" required>
                </div>
                
                <div class="input-group">
                    <label>Situação</label>
                    <select name="situacao" class="inputUser">
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
                    </select>
                </div>

                <input type="submit" name="submit" value="Enviar" class="btn-register">
            </form>
        </div>

        <div id="abaModificar" class="box-aba">
            <h3 class="h3 admin">Modificar Produto</h3>

            <form action="update_produto.php" method="POST" enctype="multipart/form-data">

                <label>Selecione o Produto:</label>
                <select name="id_produto" class="inputUser" required onchange="carregarProduto(this.value)">
                    <option value="">-- Selecione --</option>

                    <?php while($p = $produtos->fetch_assoc()): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['nome'] ?></option>
                    <?php endwhile; ?>
                </select>

                <div id="dadosProduto" style="display:none;">
                    
                    <div class="input-group">
                        <br>
                        <label>Nome</label>
                        <input id="nome" type="text" name="nome" class="inputUser">
                    </div>
                    
                    <div class="input-group">
                        <label>Descrição</label>
                        <textarea id="descricao" name="descricao" class="inputUser"></textarea>
                    </div>
                    
                    <div class="input-group">
                        <label>Preço</label>
                        <input id="preco" type="number" step="0.01" name="preco" class="inputUser">
                    </div>

                    <div class="input-group">
                        <label>Imagem</label>
                        <input type="file" name="imagem" class="inputUser">
                    </div>
                    
                    <div class="input-group">
                        <label>Situação</label>
                        <select id="situacao" name="situacao" class="inputUser">
                            <option value="ativo">Ativo</option>
                            <option value="inativo">Inativo</option>
                        </select>
                    </div>

                    <button class="btn-admin-save">Salvar Alterações</button>

                </div>
            </form>
        </div>
    </main>
    <script>
        function trocarAba(aba) {
            document.querySelectorAll(".box-aba").forEach(div => div.classList.remove("active"));
            document.querySelectorAll(".aba-btn").forEach(btn => btn.classList.remove("active"));

            document.getElementById(aba).classList.add("active");

            const botao = aba === "abaAdicionar"
                ? document.querySelectorAll(".aba-btn")[0]
                : document.querySelectorAll(".aba-btn")[1];

            botao.classList.add("active");
        }

        // ======================= CARREGAR PRODUTO VIA AJAX =======================
        function carregarProduto(id) {
            if (id === "") {
                document.getElementById("dadosProduto").style.display = "none";
                return;
            }

            fetch("get_produto.php?id=" + id)
                .then(r => r.json())
                .then(prod => {
                    document.getElementById("dadosProduto").style.display = "block";

                    document.getElementById("nome").value = prod.nome;
                    document.getElementById("descricao").value = prod.descricao;
                    document.getElementById("preco").value = prod.preco;
                    document.getElementById("situacao").value = prod.situacao;
                });
        }
</script>
    <script src="../js/nav_hamburger.js"></script>
</body>
</html>