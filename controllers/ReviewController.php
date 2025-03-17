<?php
class ReviewController {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getReviews($productId) {
        $stmt = $this->db->prepare("SELECT * FROM reviews WHERE product_id = ? ORDER BY created_at DESC");
        $stmt->execute([$productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAverageRating($productId) {
        $stmt = $this->db->prepare("SELECT AVG(rating) as avg_rating FROM reviews WHERE product_id = ?");
        $stmt->execute([$productId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['avg_rating'] ?? 0;
    }

    public function addReview($data) {
        $sql = "INSERT INTO reviews (product_id, name, email, rating, message, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['product_id'],
            $data['name'],
            $data['email'],
            $data['rating'],
            $data['message']
        ]);
    }
}
