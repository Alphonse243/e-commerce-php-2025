<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karma Shop</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php
    require_once __DIR__ . '/../classes/Cart.php';
    $cart = new Cart();
    $cartCount = $cart->getCount();
    ?>
    <header class="header_area sticky-header">
        <!-- ...existing code... -->
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
                <a href="cart.php" class="cart">
                    <span class="ti-bag"></span>
                    <span class="cart-count"><?= $cartCount ?></span>
                </a>
            </li>
            <!-- ...existing code... -->
        </ul>
        <!-- ...existing code... -->
    </header>
</body>
</html>