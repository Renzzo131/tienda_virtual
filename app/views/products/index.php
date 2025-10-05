<?php require_once APP_ROOT . '/app/views/inc/header.php'; ?>

<div class="container">
    <h2>Nuestros Productos</h2>
    <div class="product-grid">
        <?php foreach ($data['products'] as $product): ?>
            <div class="product-card">
                <img src="<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>">
                <h3><?php echo $product->name; ?></h3>
                <p><?php echo substr($product->description, 0, 70); ?>...</p>
                <p class="price">S/ <?php echo number_format($product->price, 2); ?></p>
                <a href="/product/details/<?php echo $product->id; ?>" class="button">Ver Detalles</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once APP_ROOT . '/app/views/inc/footer.php'; ?>
