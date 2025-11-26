<?php
session_start();
include("../check/conexao.php");

// segurança básica
if (!isset($_SESSION['id']) || $_SESSION['cargo'] !== 'gerente') {
    header("Location: ../login.php");
    exit;
}

$id_produto = intval($_POST['id_produto']);
$nome = $conexao->real_escape_string($_POST['nome']);
$descricao = $conexao->real_escape_string($_POST['descricao']);
$preco = floatval($_POST['preco']);
$situacao = $conexao->real_escape_string($_POST['situacao']);


// ====================== ATUALIZAÇÃO DA IMAGEM ======================
$imagem_sql = "";

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {

    // pasta onde as imagens serão salvas
    $pasta = "../img/";

    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $novoNome = "prod_" . time() . "_" . rand(1000,9999) . "." . $ext;

    move_uploaded_file($_FILES['imagem']['tmp_name'], $pasta . $novoNome);

    // Atualizar na coluna correta
    $imagem_sql = ", imagem_url = 'img/$novoNome'";
}


// ====================== UPDATE ======================
$sql = "
    UPDATE produtos SET 
        nome = '$nome',
        descricao = '$descricao',
        preco = $preco,
        situacao = '$situacao'
        $imagem_sql
    WHERE id = $id_produto
";

$conexao->query($sql);


// ====================== REDIRECIONAMENTO ======================
header("Location: admin_produtos.php?sucesso=1");
exit;
?>
