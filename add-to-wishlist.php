<?php
header('Content-Type: application/json');
session_start();
require_once 'config/db.php';

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $productId = intval($data['productId']);

    // Vérifier si le produit existe
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        throw new Exception('Product not found');
    }

    // Initialiser la liste de souhaits si nécessaire
    if (!isset($_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = [];
    }

    // Ajouter le produit à la liste de souhaits s'il n'y est pas déjà
    if (!in_array($productId, $_SESSION['wishlist'])) {
        $_SESSION['wishlist'][] = $productId;
    }

    echo json_encode([
        'success' => true,
        'message' => 'Product added to wishlist',
        'wishlist_count' => count($_SESSION['wishlist'])
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
