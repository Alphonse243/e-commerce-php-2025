<?php
header('Content-Type: application/json');
require_once 'config/db.php';
require_once 'classes/Cart.php';

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['action']) || !isset($data['productId'])) {
        throw new Exception('Paramètres manquants');
    }

    $cart = new Cart();
    $productId = intval($data['productId']);
    $quantity = isset($data['quantity']) ? intval($data['quantity']) : 1;

    switch ($data['action']) {
        case 'add':
            $cart->add($data['productId'], $data['quantity']);
            $message = 'Produit ajouté au panier';
            break;
            
        case 'update':
            $cart->update($data['productId'], $data['quantity']);
            $message = 'Quantité mise à jour';
            break;
            
        case 'remove':
            $cart->remove($data['productId']);
            $message = 'Produit retiré du panier';
            break;
            
        case 'clear':
            $cart->clear();
            $message = 'Panier vidé';
            break;
            
        default:
            throw new Exception('Action invalide');
    }

    echo json_encode([
        'success' => true,
        'message' => $message,
        'cart_count' => $cart->getTotalQuantity(),
        'cart_total' => $cart->getTotal(),
        'item_count' => $cart->getItemCount($productId)
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
