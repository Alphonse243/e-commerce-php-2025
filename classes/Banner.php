<?php
class Banner {
    private array $slides = [
        [
            'title' => 'Nike New <br>Collection!',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.',
            'image' => 'img/banner/banner-img.png'
        ],
        [
            'title' => 'Nike New <br>Collection!',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.',
            'image' => 'img/banner/banner-img.png'
        ]
    ];

    public function render(): string {
        ob_start();
        ?>
        <!-- start banner Area -->
        <section class="banner-area">
            <div class="container">
                <div class="row fullscreen align-items-center justify-content-start">
                    <div class="col-lg-12">
                        <div class="active-banner-slider owl-carousel">
                            <?php foreach ($this->slides as $index => $slide): ?>
                                <div class="row single-slide <?= $index > 0 ? '' : 'align-items-center d-flex' ?>">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="banner-content">
                                            <h1><?= $slide['title'] ?></h1>
                                            <p><?= $slide['description'] ?></p>
                                            <div class="add-bag d-flex align-items-center">
                                                <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                                                <span class="add-text text-uppercase">Add to Bag</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="banner-img">
                                            <img class="img-fluid" src="<?= htmlspecialchars($slide['image']) ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End banner Area -->
        <?php
        return ob_get_clean();
    }
}
