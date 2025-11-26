<?php if (isset($_GET['cancelado'])): ?>
    <div class="alert-sucesso">Pedido cancelado com sucesso.</div>
<?php endif; ?>
<?php if (isset($_GET['erro'])): ?>
    <div class="alert-erro">Este pedido não pode ser cancelado.</div>
<?php endif; ?>

<?php
session_start();
include("../check/conexao.php");

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}

$id_usuario = $_SESSION['id'];
$id_pedido = intval($_POST['id_pedido']);

$check = $conexao->query("SELECT * FROM pedidos 
    WHERE id = $id_pedido 
    AND id_usuario = $id_usuario
    AND status = 'pendente'
");

if ($check->num_rows === 0) {
    header("Location: ../perfil/pedido_detalhes.php?id=$id_pedido&erro=naopode");
    exit;
}

$conexao->query("UPDATE pedidos SET status = 'cancelado' 
    WHERE id = $id_pedido
");

header("Location: ../perfil/pedido_detalhes.php?id=$id_pedido&cancelado=1");
exit;
?>
