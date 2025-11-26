<?php
include("../check/conexao.php");

// Recebe dados
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$situacao = $_POST['situacao'];

// Verifica upload
$imagem = "";
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {

    $pasta = "../img/";
    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    $nomeImagem = uniqid() . "_" . $_FILES['imagem']['name'];
    $caminhoCompleto = $pasta . $nomeImagem;

    move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto);

    // Caminho salvo no banco
    $imagem = "img/" . $nomeImagem;
}

// Salvar produto no banco
$stmt = $conexao->prepare("INSERT INTO produtos (nome, descricao, preco, imagem_url, situacao)
    VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param("ssdss", $nome, $descricao, $preco, $imagem, $situacao);
$stmt->execute();

header("Location: admin_produtos.php?ok=1");
exit;
?>
