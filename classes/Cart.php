<?php
require_once __DIR__ . '/Database.php';

class Cart {
    private $db;
    private $items = [];

    public function __construct() {
        $this->db = Database::getInstance();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->items = $_SESSION['cart'] ?? [];
    }

    public function add($productId, $quantity = 1) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch();

        if (!$product) {
            throw new Exception('Product not found');
        }

        if (isset($this->items[$productId])) {
            $this->items[$productId]['quantity'] += $quantity;
        } else {
            $this->items[$productId] = [
                'quantity' => $quantity,
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image']
            ];
        }

        $this->save();
    }

    public function update($productId, $quantity) {
        if (isset($this->items[$productId])) {
            if ($quantity <= 0) {
                $this->remove($productId);
            } else {
                $this->items[$productId]['quantity'] = $quantity;
                $this->save();
            }
        }
    }

    public function remove($productId) {
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
            $this->save();
        }
    }

    public function clear() {
        $this->items = [];
        $this->save();
    }

    public function getItems() {
        return $this->items;
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += floatval($item['price']) * intval($item['quantity']);
        }
        return round($total, 2);
    }

    public function getTotalQuantity() {
        $quantity = 0;
        foreach ($this->items as $item) {
            $quantity += intval($item['quantity']);
        }
        return $quantity;
    }

    public function exists($productId) {
        return isset($this->items[$productId]);
    }

    public function getItemCount($productId) {
        return $this->exists($productId) ? $this->items[$productId]['quantity'] : 0;
    }

    public function getCount() {
        return count($this->items);
    }

    private function save() {
        $_SESSION['cart'] = $this->items;
    }
}
