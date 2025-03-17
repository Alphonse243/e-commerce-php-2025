function updateCartCount(count) {
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = count;
    }
}

function updateCartTotal(total) {
    const cartTotalElement = document.querySelector('.cart-total');
    if (cartTotalElement) {
        cartTotalElement.textContent = `${total.toFixed(2)} €`;
    }
}

function updateCartUI(data) {
    updateCartCount(data.cart_count);
    updateCartTotal(data.cart_total);

    // Mettre à jour la quantité du produit
    const quantityInput = document.querySelector(`tr[data-product-id="${data.productId}"] input[type="number"]`);
    if (quantityInput && data.item_count) {
        quantityInput.value = data.item_count;
    }

    // Mettre à jour le total de la ligne
    updateLineTotal(data.productId, data.item_count, data.unit_price);
}

function updateLineTotal(productId, quantity, price) {
    const totalCell = document.querySelector(`tr[data-product-id="${productId}"] .line-total`);
    if (totalCell) {
        totalCell.textContent = `${(quantity * price).toFixed(2)} €`;
    }
}

function handleCartAction(action, productId, quantity = 1) {
    fetch('cart-action.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: action,
            productId: productId,
            quantity: quantity
        })
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            updateCartUI(data);
            
            if (action === 'remove') {
                const productRow = document.querySelector(`tr[data-product-id="${productId}"]`);
                if (productRow) {
                    productRow.remove();
                }
            }

            Swal.fire({
                icon: 'success',
                title: data.message,
                showConfirmButton: false,
                timer: 1500
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Une erreur est survenue'
        });
    });
}
