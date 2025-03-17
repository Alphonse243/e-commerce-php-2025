<?php
class Category {
    private array $categories = [
        [
            'image' => 'c1.jpg',
            'title' => 'Sneaker for Sports',
            'size' => 'lg-8 md-8'
        ],
        [
            'image' => 'c2.jpg',
            'title' => 'Sneaker for Sports',
            'size' => 'lg-4 md-4'
        ],
        [
            'image' => 'c3.jpg',
            'title' => 'Product for Couple',
            'size' => 'lg-4 md-4'
        ],
        [
            'image' => 'c4.jpg',
            'title' => 'Sneaker for Sports',
            'size' => 'lg-8 md-8'
        ],
        [
            'image' => 'c5.jpg',
            'title' => 'Sneaker for Sports',
            'size' => 'lg-4 md-6',
            'full_width' => true
        ]
    ];

    public function render(): string {
        ob_start();
        ?>
        <!-- Start category Area -->
        <section class="category-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <?php foreach ($this->categories as $category): ?>
                                <?php if (empty($category['full_width'])): ?>
                                    <div class="col-<?= $category['size'] ?>">
                                        <?php $this->renderCategoryCard($category); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <?php 
                        $lastCategory = array_filter($this->categories, fn($cat) => !empty($cat['full_width']));
                        $this->renderCategoryCard(reset($lastCategory));
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End category Area -->
        <?php
        return ob_get_clean();
    }

    private function renderCategoryCard(array $category): void {
        ?>
        <div class="single-deal">
            <div class="overlay"></div>
            <img class="img-fluid w-100" src="img/category/<?= htmlspecialchars($category['image']) ?>" alt="">
            <a href="img/category/<?= htmlspecialchars($category['image']) ?>" class="img-pop-up" target="_blank">
                <div class="deal-details">
                    <h6 class="deal-title"><?= htmlspecialchars($category['title']) ?></h6>
                </div>
            </a>
        </div>
        <?php
    }
}
