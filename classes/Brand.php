<?php
class Brand {
    private array $brands = [
        ['image' => '1.png'],
        ['image' => '2.png'],
        ['image' => '3.png'],
        ['image' => '4.png'],
        ['image' => '5.png']
    ];

    public function render(): string {
        ob_start();
        ?>
        <section class="brand-area section_gap">
            <div class="container">
                <div class="row">
                    <?php foreach ($this->brands as $brand): ?>
                        <a class="col single-img" href="#">
                            <img class="img-fluid d-block mx-auto" 
                                 src="img/brand/<?= htmlspecialchars($brand['image']) ?>" 
                                 alt="">
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }
}
