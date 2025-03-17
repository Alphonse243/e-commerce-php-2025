<?php
require_once 'includes/init.php';

$product = new Product();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    if ($product->addProduct($_POST)) {
        header('Location: products.php?success=1');
        exit;
    } else {
        $error = "Erreur lors de l'ajout du produit";
    }
}

include 'includes/header.php';
echo $product->renderAddProductForm();
if (isset($error)) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
}
include 'includes/footer.php';
