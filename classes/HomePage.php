<?php
class HomePage {
    private Banner $banner;
    private Features $features;
    private Product $products;
    private Category $category;
    private ExclusiveDeal $exclusiveDeal;
    private Brand $brand;
    private RelatedProduct $relatedProduct;

    public function __construct() {
        $this->banner = new Banner();
        $this->features = new Features();
        $this->products = new Product();
        $this->category = new Category();
        $this->exclusiveDeal = new ExclusiveDeal();
        $this->brand = new Brand();
        $this->relatedProduct = new RelatedProduct();
    }

    public function render(): string {
        ob_start();
        ?>
        <!-- Start Homepage Content -->
        <?= $this->banner->render() ?>
        <?= $this->features->render() ?>
        <?= $this->category->render() ?>
        
        <!-- start product Area -->
        <section class="owl-carousel active-product-area section_gap">
            <?= $this->products->renderLatestProducts() ?>
            <?= $this->products->renderComingProducts() ?>
        </section>
        
        <?= $this->exclusiveDeal->render() ?>
        <?= $this->brand->render() ?>
        <?= $this->relatedProduct->render() ?>
        <?php
        return ob_get_clean();
    }
}
