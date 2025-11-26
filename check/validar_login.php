<?php 
    session_start();

    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
        // Acessa
        include_once('conexao.php');
        $email = $_POST['email'];
        $senha_digitada = $_POST['senha'];

        $statement = $conexao -> prepare("SELECT id, nome_completo, email, telefone, senha, cargo FROM usuarios WHERE email = ?");
        $statement -> bind_param("s", $email);
        $statement -> execute();
        $result = $statement -> get_result();

        if ($result -> num_rows === 1) {
            $usuario = $result -> fetch_assoc();

            if (password_verify($senha_digitada, $usuario['senha'])) {
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['nome_completo'] = $usuario['nome_completo'];
                $_SESSION['cargo'] = $usuario['cargo'];

                header('Location: ../menu.php');
                exit();
            }
        }

        unset($_SESSION['id']);
        unset($_SESSION['email']);
        unset($_SESSION['nome_completo']);
        unset($_SESSION['cargo']);
        header('Location: ../login.php?erro=credenciais');

        $statement -> close();
        $conexao -> close();
    }
    else {
        // Não Acessa
        header('Location: ../login.php');
        exit();
    }
?>