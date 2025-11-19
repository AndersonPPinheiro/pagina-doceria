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

        <form action="/login" method="POST">
            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="inputUser" placeholder="seu@email.com" required>
            </div>
            
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="inputUser" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">Entrar</button>

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