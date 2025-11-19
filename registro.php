<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Doceria PaiD'Égua</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="register-container">
        
        <h2>Crie sua Conta e Comece a Pedir!</h2>

        <form action="/register" method="POST">
            <div class="input-group">
                <label for="name">Nome Completo</label>
                <input type="text" id="name" name="name" class="inputUser" placeholder="Seu Nome e Sobrenome" required>
            </div>

            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="inputUser" placeholder="seu@email.com" required>
            </div>
            
            <div class="input-group">
                <label for="phone">Telefone / WhatsApp</label>
                <input type="tel" id="phone" name="phone" class="inputUser" placeholder="(99) 99999-9999" required>
            </div>
            
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="inputUser" placeholder="Crie uma senha forte" required>
            </div>

            <div class="input-group">
                <label for="confirm-password">Confirmar Senha</label>
                <input type="password" id="confirm-password" name="confirm-password" class="inputUser" placeholder="Repita a senha" required>
            </div>

            <button type="submit" class="btn-register">Criar Conta</button>

            <a href="index.php" class="login-link">Já tem uma conta? Faça Login</a>
        </form>
    </div>

</body>
</html>