<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}

// Forma de pagamento
$pagamento = "dinheiro";

// Envia diretamente para finalizar o pedido
?>
<form id="form_dinheiro" action="finalizar_pedido.php" method="POST">
    <input type="hidden" name="pagamento" value="<?= $pagamento ?>">
</form>

<script>
// Envia automaticamente
document.getElementById('form_dinheiro').submit();
</script>