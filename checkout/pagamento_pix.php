<?php
include("../check/verificar_login.php");
include("../check/conexao.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pagamento via Pix</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="payment-page">
    <main class="pix-container">

        <h2 class="pix-title">Pagamento via Pix</h2>

        <div class="pix-card">

            <h3 class="pix-sub">Escaneie o QR Code</h3>

            <img src="../img/qrcode_falso.png" 
                 class="pix-qr" 
                 alt="QR Code Pix">

            <div class="pix-code-box">
                <?php echo "00020126360014BR.GOV...exemplo123"; ?>
            </div>

            <button class="btn-copy" onclick="copyPix()">Copiar código Pix</button>

            <p class="pix-info">
                O pagamento será confirmado automaticamente<br>
                em poucos segundos após a transferência.
            </p>

            <form action="finalizar_pedido.php" method="POST">
                <input type="hidden" name="pagamento" value="pix">
                <button class="btn-confirmar">Confirmar Pagamento</button>
            </form>
        </div>

    </main>

    <script>
    function copyPix() {
        const texto = document.querySelector(".pix-code-box").innerText;
        navigator.clipboard.writeText(texto);
        alert("Código Pix copiado!");
    }
    </script>

</body>
</html>
