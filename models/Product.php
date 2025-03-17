<?php
declare(strict_types=1);

class Product {
    private PDO $db;

    public function __construct() {
        $dbInstance = Database::getInstance();
        $this->db = $dbInstance->getConnection();
    }

    public function getProductBySlug($slug) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE slug = ?");
        $stmt->execute([$slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductReviews($productId) {
        $stmt = $this->db->prepare("SELECT * FROM reviews WHERE product_id = :product_id ORDER BY created_at DESC");
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAverageRating($reviews) {
        if (empty($reviews)) return 0;
        $total_rating = array_sum(array_column($reviews, 'rating'));
        return $total_rating / count($reviews);
    }

    public function renderLatestProducts() {
        // Add this method required by HomePage
        return '';
    }

    public function renderComingProducts() {
        // Add this method required by HomePage
        return '';
    }
}
