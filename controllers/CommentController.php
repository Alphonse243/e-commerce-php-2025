<?php
class CommentController {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getComments($productId) {
        $stmt = $this->db->prepare("SELECT * FROM comments WHERE product_id = ? ORDER BY created_at DESC");
        $stmt->execute([$productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addComment($data) {
        $sql = "INSERT INTO comments (product_id, name, email, message, created_at) VALUES (?, ?, ?, ?, NOW())";
        return $this->db->query($sql, [
            $data['product_id'],
            $data['name'],
            $data['email'],
            $data['message']
        ]);
    }
}
