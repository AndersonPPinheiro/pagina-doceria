<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Doceria PaiD'Égua</title>
    <link rel="stylesheet" href="css\style.css">
</head>
<body>
    <div class="login-container">
        <h2>Entrar</h2>

        <?php 
            if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso') {
                echo '<p style="color: green; font-weight: bold;">Cadastro realizado com sucesso!</p>';
            }
            elseif (isset($_GET['erro']) && $_GET['erro'] == 'credenciais') {
                echo '<p style="color: red; font-weight: bold;">E-mail ou senha incorretos.</p>';
            }
        ?>

        <form action="check/validar_login.php" method="POST">
            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="inputUser" placeholder="seu@email.com" required>
            </div>
            
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="senha" class="inputUser" placeholder="••••••••" required>
            </div>

            <!-- <button type="submit" class="btn-login">Entrar</button> -->
            <input type="submit" class="btn-login" name="submit" value="Enviar">

            <div class="register-prompt">
                Ainda não tem cadastro?
                <a href="registro.php" class="register-link">
                    Crie sua Conta
                </a>
            </div>
        </form>
    </div>
</body>
</html>