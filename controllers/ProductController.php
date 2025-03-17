<?php
require_once __DIR__ . '/../models/Product.php';

class ProductController {
    private $productModel;
    private $viewsPath;

    public function __construct() {
        $this->productModel = new Product();
        $this->viewsPath = __DIR__ . '/../views/';
    }

    public function showProduct($slug) {
        // Get product details
        $product = $this->productModel->getProductBySlug($slug);
        
        if (!$product) {
            header('Location: index.php');
            exit();
        }

        // Get reviews
        $reviews = $this->productModel->getProductReviews($product['id']);
        $avg_rating = $this->productModel->getAverageRating($reviews);
        
        // Make variables available to the view
        $viewData = [
            'product' => $product,
            'reviews' => $reviews,
            'avg_rating' => $avg_rating
        ];
        
        // Extract variables for the view
        extract($viewData);
        
        // Load view
        require_once $this->viewsPath . 'products/single.php';
    }
}
