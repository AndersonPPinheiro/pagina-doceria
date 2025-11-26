<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION['email'])) {
        header('Location: ../login.php');
        exit();
    }

    $logado_email = $_SESSION['email'];
    $logado_nome = $_SESSION['nome_completo'];
?>