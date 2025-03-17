<?php
class ExclusiveDeal {
    private array $exclusiveProducts = [
        [
            'image' => 'img/product/e-p1.png',
            'price' => 150.00,
            'original_price' => 210.00,
            'name' => 'addidas New Hammer sole for Sports person'
        ]
    ];

    public function render(): string {
        ob_start();
        ?>
        <section class="exclusive-deal-area">
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-6 no-padding exclusive-left">
                        <div class="row clock_sec clockdiv" id="clockdiv">
                            <div class="col-lg-12">
                                <h1>Exclusive Hot Deal Ends Soon!</h1>
                                <p>Who are in extremely love with eco friendly system.</p>
                            </div>
                            <div class="col-lg-12">
                                <div class="row clock-wrap">
                                    <?php $this->renderCountdown(); ?>
                                </div>
                            </div>
                        </div>
                        <a href="" class="primary-btn">Shop Now</a>
                    </div>
                    <div class="col-lg-6 no-padding exclusive-right">
                        <div class="active-exclusive-product-slider">
                            <?php foreach ($this->exclusiveProducts as $product): ?>
                                <?php $this->renderExclusiveProduct($product); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    private function renderCountdown(): void {
        $countdownItems = [
            'days' => 150,
            'hours' => 23,
            'minutes' => 47,
            'seconds' => 59
        ];

        foreach ($countdownItems as $unit => $value): ?>
            <div class="col clockinner1 clockinner">
                <h1 class="<?= $unit ?>"><?= $value ?></h1>
                <span class="smalltext"><?= ucfirst($unit) ?></span>
            </div>
        <?php endforeach;
    }

    private function renderExclusiveProduct(array $product): void {
        ?>
        <div class="single-exclusive-slider">
            <img class="img-fluid" src="<?= htmlspecialchars($product['image']) ?>" alt="">
            <div class="product-details">
                <div class="price">
                    <h6>$<?= number_format($product['price'], 2) ?></h6>
                    <h6 class="l-through">$<?= number_format($product['original_price'], 2) ?></h6>
                </div>
                <h4><?= htmlspecialchars($product['name']) ?></h4>
                <div class="add-bag d-flex align-items-center justify-content-center">
                    <a class="add-btn" href=""><span class="ti-bag"></span></a>
                    <span class="add-text text-uppercase">Add to Bag</span>
                </div>
            </div>
        </div>
        <?php
    }
}
