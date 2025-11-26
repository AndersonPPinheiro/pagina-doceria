<?php 
    include_once('check/conexao.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $telefone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
        $senha = $_POST['senha'];
        $confirmar_senha = $_POST['confirm-senha'];

        if ($senha !== $confirmar_senha) {
            header('Location: registro.php?erro=senhadiferente');
            exit();
        }

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $statement = $conexao -> prepare("INSERT INTO usuarios(nome_completo, email, telefone, senha) VALUES (?, ?, ?, ?)");
        $statement -> bind_param("ssss", $nome, $email, $telefone, $senha_hash);
        if ($statement -> execute()) {
            header('Location: login.php?cadastro=sucesso');
        }
        else {
            header('Location: registro.php?erro=emailexistente');
        }

        $statement -> close();
        $conexao -> close();
        exit();
    }
?>

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

        <?php 
            if (isset($_GET['erro'])) {
                if ($_GET['erro'] == 'senhadiferente') {
                    echo '<p style="color: red; font-weight: bold;">Senhas Não Coincidem!';
                }
                elseif ($_GET['erro'] == 'emailexistente') {
                    echo '<p style="color: red; font-weight: bold;">Email já Cadastrado!';
                }
            }
        ?>

        <form action="registro.php" method="POST">
            <div class="input-group">
                <label for="name">Nome Completo</label>
                <input type="text" id="name" name="nome" class="inputUser" placeholder="Seu Nome e Sobrenome" required>
            </div>

            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="inputUser" placeholder="seu@email.com" required>
            </div>
            
            <div class="input-group">
                <label for="phone">Telefone / WhatsApp</label>
                <input type="tel" id="phone" name="phone" class="inputUser" maxlength="11" placeholder="(99) 99999-9999" required>
            </div>
            
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" minlength="6" name="senha" class="inputUser" placeholder="Crie uma senha forte" required>
                <p class="p-senha">Minimo 6 Digitos</p>
            </div>

            <div class="input-group">
                <label for="confirm-password">Confirmar Senha</label>
                <input type="password" id="confirm-password" name="confirm-senha" class="inputUser" placeholder="Repita a senha" required>
            </div>

            <!-- <button type="submit" class="btn-register">Criar Conta</button> -->
            <input type="submit" class="btn-register" name="submit" value="Criar Conta">
            
            <br><br>
            <a href="login.php" class="login-link">Já tem uma conta? Faça Login</a>
        </form>
    </div>

</body>
</html>