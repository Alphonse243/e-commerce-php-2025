<?php
header('Content-Type: application/json');
require_once 'config/db.php';
require_once 'classes/Cart.php';

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $productId = intval($data['productId']);
    $quantity = intval($data['quantity']);

    $cart = new Cart();
    $cart->add($productId, $quantity);

    echo json_encode([
        'success' => true,
        'message' => 'Produit ajouté au panier',
        'cart_count' => $cart->getCount()
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
