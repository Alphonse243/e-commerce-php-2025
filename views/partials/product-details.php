<div class="s_product_text">
    <h3><?= htmlspecialchars($product['name']) ?></h3>
    <h2>$<?= number_format($product['price'], 2) ?></h2>
    <ul class="list">
        <li><a class="active" href="#"><span>Category</span> : <?= htmlspecialchars($product['category']) ?></a></li>
        <li><a href="#"><span>Availability</span> : <?= $product['stock'] > 0 ? 'In Stock' : 'Out of Stock' ?></a></li>
    </ul>
    <p><?= htmlspecialchars($product['description']) ?></p>
    <div class="product_count">
        <label for="qty">Quantity:</label>
        <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 1 ) result.value--;return false;"
         class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
    </div>
    <div class="card_area d-flex align-items-center">
        <?php if($product['stock'] > 0): ?>
        <button class="primary-btn" onclick="addToCart(<?= $product['id'] ?>)">Add to Cart</button>
        <?php else: ?>
        <button class="primary-btn" disabled>Out of Stock</button>
        <?php endif; ?>
        <button class="icon_btn" onclick="addToWishlist(<?= $product['id'] ?>)"><i class="lnr lnr lnr-heart"></i></button>
    </div>
</div>
