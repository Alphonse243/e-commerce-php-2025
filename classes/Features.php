<?php
class Features {
    private array $features = [
        [
            'icon' => 'f-icon1.png',
            'title' => 'Free Delivery',
            'description' => 'Free Shipping on all order'
        ],
        [
            'icon' => 'f-icon2.png',
            'title' => 'Return Policy',
            'description' => 'Free Shipping on all order'
        ],
        [
            'icon' => 'f-icon3.png',
            'title' => '24/7 Support',
            'description' => 'Free Shipping on all order'
        ],
        [
            'icon' => 'f-icon4.png',
            'title' => 'Secure Payment',
            'description' => 'Free Shipping on all order'
        ]
    ];

    public function render(): string {
        ob_start();
        ?>
        <section class="features-area section_gap">
            <div class="container">
                <div class="row features-inner">
                    <?php foreach ($this->features as $feature): ?>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-features">
                                <div class="f-icon">
                                    <img src="img/features/<?= htmlspecialchars($feature['icon']) ?>" alt="">
                                </div>
                                <h6><?= htmlspecialchars($feature['title']) ?></h6>
                                <p><?= htmlspecialchars($feature['description']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }
}
