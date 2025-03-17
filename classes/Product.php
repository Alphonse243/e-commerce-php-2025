<?php
class Product {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllProducts(): array {
        $stmt = $this->db->query('SELECT * FROM products ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public function getProductById(int $id): ?array {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function renderProductsList(): string {
        $products = $this->getAllProducts();
        ob_start();
        ?>
        <div class="container">
            <div class="row g-2">
                <?php foreach ($products as $product): ?>
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                        <div class="single-product h-100">
                            <img class="img-fluid w-100" src="<?= htmlspecialchars($product['image']) ?>" alt="">
                            <div class="product-details">
                                <h6><?= htmlspecialchars($product['name']) ?></h6>
                                <div class="price">
                                    <h6><?= number_format($product['price'], 2) ?> €</h6>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-cart"></span>
                                        <p class="hover-text">Ajouter au panier</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function renderLatestProducts(): string {
        $products = $this->getAllProducts();
        ob_start();
        ?>
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1>Latest Products</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <?php foreach (array_slice($products, 0, 8) as $product): ?>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <?php $this->renderProductCard($product); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function renderComingProducts(): string {
        $products = $this->getAllProducts();
        ob_start();
        ?>
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1>Coming Products</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <?php foreach (array_slice($products, -8) as $product): ?>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <?php $this->renderProductCard($product); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    private function renderProductCard(array $product): void {
        ?>
        <div class="single-product">
            <a href="single-product.php?slug=<?= urlencode($product['slug']) ?>">
                <img class="img-fluid" src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
            </a>
            <div class="product-details">
                <h6>
                    <a href="single-product.php?slug=<?= urlencode($product['slug']) ?>">
                        <?= htmlspecialchars($product['name']) ?>
                    </a>
                </h6>
                <?php if ($product['is_new']): ?>
                    <span class="new-badge">New</span>
                <?php endif; ?>
                <?php if ($product['is_sale']): ?>
                    <span class="sale-badge">Sale</span>
                <?php endif; ?>
                <div class="price">
                    <h6>$<?= number_format($product['price'], 2) ?></h6>
                    <?php if (!empty($product['original_price'])): ?>
                        <h6 class="l-through">$<?= number_format($product['original_price'], 2) ?></h6>
                    <?php endif; ?>
                </div>
                <div class="prd-bottom">
                    <a href="javascript:void(0)" onclick="addToCart(<?= $product['id'] ?>)" class="social-info">
                        <span class="ti-bag"></span>
                        <p class="hover-text">add to bag</p>
                    </a>
                    <a href="javascript:void(0)" onclick="addToWishlist(<?= $product['id'] ?>)" class="social-info">
                        <span class="lnr lnr-heart"></span>
                        <p class="hover-text">Wishlist</p>
                    </a>
                    <a href="single-product.php?slug=<?= urlencode($product['slug']) ?>" class="social-info">
                        <span class="lnr lnr-move"></span>
                        <p class="hover-text">view more</p>
                    </a>
                </div>
            </div>
        </div>
        <?php
    }

    public function addProduct(array $data): bool {
        $sql = "INSERT INTO products (name, price, original_price, image, created_at) 
                VALUES (:name, :price, :original_price, :image, NOW())";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'name' => $data['name'],
            'price' => $data['price'],
            'original_price' => $data['original_price'] ?? null,
            'image' => $data['image']
        ]);
    }

    public function renderAddProductForm(): string {
        ob_start();
        ?>
        <div class="container mt-5">
            <h2>Ajouter un produit</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nom du produit</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Prix</label>
                    <input type="number" name="price" step="0.01" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Prix original (optionnel)</label>
                    <input type="number" name="original_price" step="0.01" class="form-control">
                </div>
                <div class="form-group">
                    <label>Image URL</label>
                    <input type="text" name="image" class="form-control" required>
                </div>
                <button type="submit" name="add_product" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
        <?php
        return ob_get_clean();
    }
}
