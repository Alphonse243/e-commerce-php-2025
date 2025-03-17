<div class="s_Product_carousel">
    <div class="single-prd-item">
        <img class="img-fluid" src="img/products/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
    </div>
    <?php if($product['image2']): ?>
    <div class="single-prd-item">
        <img class="img-fluid" src="img/products/<?= htmlspecialchars($product['image2']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
    </div>
    <?php endif; ?>
    <?php if($product['image3']): ?>
    <div class="single-prd-item">
        <img class="img-fluid" src="img/products/<?= htmlspecialchars($product['image3']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
    </div>
    <?php endif; ?>
</div>
