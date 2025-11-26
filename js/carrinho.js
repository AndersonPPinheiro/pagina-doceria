// Abre o carrinho
document.querySelector('.floating-cart').addEventListener('click', () => {
    const overlay = document.getElementById('cart-overlay');
    const modal = document.getElementById('cart-modal');

    overlay.style.display = 'block';
    modal.style.display = 'block';

    modal.setAttribute('aria-hidden', 'false');

    carregar_carrinho();
});

// Fecha o carrinho
document.getElementById('cart-close').addEventListener('click', fechar_carrinho);
document.getElementById('cart-overlay').addEventListener('click', fechar_carrinho);

function fechar_carrinho() {
    const overlay = document.getElementById('cart-overlay');
    const modal = document.getElementById('cart-modal');

    overlay.style.display = 'none';
    modal.style.display = 'none';

    modal.setAttribute('aria-hidden', 'true');
}

function carregar_carrinho() {
    fetch("carrinho/listar.php")
        .then(r => r.json())
        .then(data => {
            atualizar_carrinhoDOM(data);
            atualizar_badge(data.total_qtd);
        })
        .catch(err => console.error("Erro ao carregar carrinho:", err));
}

function atualizar_carrinhoDOM(data) {
    const itemsDIV = document.getElementById('cart-items');
    const totalSpan = document.getElementById('cart-total');

    if (!data || !data.itens || data.itens.length === 0) {
        itemsDIV.innerHTML = `<p class="no-items">Nenhum item no carrinho</p>`;
        totalSpan.textContent = "R$ 0,00";
        return;
    }

    let html = "";
    data.itens.forEach(item => {
        html += `
        <div class="cart-item">
            <div class="cart-item-info">
                <strong>${item.nome}</strong>
                <span>R$ ${item.preco}</span>
            </div>

            <div class="cart-item-controls">
                <button class="qtd-btn" onclick="alterarQtd(${item.id}, -1)">-</button>
                <span>${item.qtd}</span>
                <button class="qtd-btn" onclick="alterarQtd(${item.id}, 1)">+</button>
                <button class="remove-btn" onclick="removerItem(${item.id})">X</button>
            </div>
        </div>
        `;
    });

    itemsDIV.innerHTML = html;
    totalSpan.textContent = "R$ " + data.total;
}

function adicionar_carrinho(id) {
    fetch(`carrinho/adicionar.php?id=${id}`)
        .then(r => r.json())
        .then(data => {
            atualizar_badge(data.total_qtd);
        })
        .catch(err => console.error("Erro ao adicionar item:", err));
}

function alterarQtd(id, qtd) {
    fetch(`carrinho/atualizar_qtd.php?id=${id}&qtd=${qtd}`)
        .then(r => r.json())
        .then(data => {
            atualizar_carrinhoDOM(data);
            atualizar_badge(data.total_qtd);
        })
        .catch(err => console.error("Erro ao alterar quantidade:", err));
}

function removerItem(id) {
    fetch(`carrinho/remover.php?id=${id}`)
        .then(r => r.json())
        .then(data => {
            atualizar_carrinhoDOM(data);
            atualizar_badge(data.total_qtd);
        })
        .catch(err => console.error("Erro ao remover item:", err));
}

function atualizar_badge(qtd) {
    document.querySelector('.cart-badge').textContent = qtd;
}

function ir_para_checkout() {
    window.location.href = "checkout/checkout.php";
}

carregar_carrinho();