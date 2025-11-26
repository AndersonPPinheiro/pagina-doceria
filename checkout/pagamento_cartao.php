<?php
include("../check/verificar_login.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento com Cartão</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="payment-page">
    <main class="card-container">

        <div class="card-card">
            <h2 class="card-title">Pagamento com Cartão</h2>

            <form class="card-form" action="finalizar_pedido.php" method="POST">
                <input type="hidden" name="pagamento" value="cartao">
                <label>Número do cartão</label>
                <input class="inputUser input-cartao" maxlength="16" name="card_number" placeholder="0000 0000 0000 0000" required>

                <label>Nome no cartão</label>
                <input class="inputUser input-cartao card-name" name="card_name" placeholder="Seu Nome" required>

                <div class="card-row">
                    <input class="inputUser input-cartao" id="validade-cartao" maxlength="5" name="card_valid" placeholder="MM/AA" required>
                    <input class="inputUser input-cartao" maxlength="3" name="card_cvv" placeholder="CVV" required>
                </div>

                <button class="btn-card-pay" type="submit">Pagar Agora</button>
            </form>
            
            <div class="card-note">Pagamento simulado — sem cobrança real.</div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const inputValidade = document.getElementById("validade-cartao");

            inputValidade.addEventListener("input", function () {
                let v = this.value.replace(/\D/g, "");

                if (v.length >= 3) {
                    v = v.substring(0, 2) + "/" + v.substring(2, 4);
                }

                this.value = v.substring(0, 5);
            });
        });
    </script>

</body>
</html>
