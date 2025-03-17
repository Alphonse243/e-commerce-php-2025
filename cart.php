<?php
require_once 'config/db.php';
require_once 'classes/Cart.php';

$cart = new Cart();

// Gérer les actions sur le panier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $productId = (int)($_POST['product_id'] ?? 0);
    $quantity = (int)($_POST['quantity'] ?? 1);

    switch ($action) {
        case 'update':
            $cart->update($productId, $quantity);
            break;
        case 'remove':
            $cart->remove($productId);
            break;
        case 'clear':
            $cart->clear();
            break;
    }

    // Rediriger pour éviter la resoumission du formulaire
    header('Location: cart.php');
    exit;
}

$items = $cart->getItems();
$total = $cart->getTotal();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Panier - Karma Shop</title>
    <!-- Inclure les CSS existants -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Header -->
    <?php include 'includes/header.php'; ?>

    <!-- Cart Area -->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Produit</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Quantité</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $productId => $item): ?>
                            <tr data-product-id="<?= $productId ?>">
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="<?= htmlspecialchars($item['image']) ?>" alt="" width="100">
                                        </div>
                                        <div class="media-body">
                                            <p><?= htmlspecialchars($item['name']) ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5><?= number_format($item['price'], 2) ?> €</h5>
                                </td>
                                <td>
                                    <input type="number" 
                                           value="<?= $item['quantity'] ?>" 
                                           min="1" 
                                           class="form-control" 
                                           style="width: 80px;"
                                           onchange="handleCartAction('update', <?= $productId ?>, this.value)">
                                </td>
                                <td>
                                    <h5><?= number_format($item['price'] * $item['quantity'], 2) ?> €</h5>
                                </td>
                                <td>
                                    <button onclick="handleCartAction('remove', <?= $productId ?>)" 
                                            class="btn">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3" class="text-right">
                                    <h5>Total</h5>
                                </td>
                                <td>
                                    <h5><?= number_format($total, 2) ?> €</h5>
                                </td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="action" value="clear">
                                        <button type="submit" class="btn">Vider le panier</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="checkout_btn_inner mt-5">
                    <a class="gray_btn" href="index.php">Continuer les achats</a>
                    <a class="primary-btn" href="checkout.php">Procéder au paiement</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
    <script src="js/cart.js"></script>
</body>
</html>
