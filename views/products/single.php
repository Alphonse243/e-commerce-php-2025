<?php 
if (!isset($product)) {
    header('Location: index.php');
    exit();
}

require_once __DIR__ . '/../../views/partials/header.php'; 
?>

<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Product Details Page</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
                    <a href="single-product.html">product-details</a>
                </nav>
            </div>
        </div>
    </div>
</section>

<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <?php include 'views/partials/product-images.php'; ?>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <?php include 'views/partials/product-details.php'; ?>
            </div>
        </div>
    </div>
</div>

<section class="product_description_area">
    <?php include 'views/partials/product-tabs.php'; ?>
</section>

<section class="related-product-area section_gap_bottom">
    <?php include 'views/partials/related-products.php'; ?>
</section>

<?php require_once 'views/partials/footer.php'; ?>