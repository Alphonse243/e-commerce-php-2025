<?php
class RelatedProduct {
    private array $products = [
        ['image' => 'r1.jpg', 'title' => 'Black lace Heels', 'price' => 189.00, 'original_price' => 210.00],
        ['image' => 'r2.jpg', 'title' => 'Black lace Heels', 'price' => 189.00, 'original_price' => 210.00],
        ['image' => 'r3.jpg', 'title' => 'Black lace Heels', 'price' => 189.00, 'original_price' => 210.00],
        ['image' => 'r5.jpg', 'title' => 'Black lace Heels', 'price' => 189.00, 'original_price' => 210.00],
        ['image' => 'r6.jpg', 'title' => 'Black lace Heels', 'price' => 189.00, 'original_price' => 210.00],
        ['image' => 'r7.jpg', 'title' => 'Black lace Heels', 'price' => 189.00, 'original_price' => 210.00],
        ['image' => 'r9.jpg', 'title' => 'Black lace Heels', 'price' => 189.00, 'original_price' => 210.00],
        ['image' => 'r10.jpg', 'title' => 'Black lace Heels', 'price' => 189.00, 'original_price' => 210.00],
        ['image' => 'r11.jpg', 'title' => 'Black lace Heels', 'price' => 189.00, 'original_price' => 210.00]
    ];

    public function render(): string {
        ob_start();
        ?>
        <section class="related-product-area section_gap_bottom">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1>Deals of the Week</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <?php foreach ($this->products as $product): ?>
                                <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                                    <?php $this->renderRelatedProduct($product); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ctg-right">
                            <a href="#" target="_blank">
                                <img class="img-fluid d-block mx-auto" src="img/category/c5.jpg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    private function renderRelatedProduct(array $product): void {
        ?>
        <div class="single-related-product d-flex">
            <a href="#"><img src="img/<?= htmlspecialchars($product['image']) ?>" alt=""></a>
            <div class="desc">
                <a href="#" class="title"><?= htmlspecialchars($product['title']) ?></a>
                <div class="price">
                    <h6>$<?= number_format($product['price'], 2) ?></h6>
                    <h6 class="l-through">$<?= number_format($product['original_price'], 2) ?></h6>
                </div>
            </div>
        </div>
        <?php
    }
}
