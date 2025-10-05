<?php require_once APP_ROOT . '/app/views/inc/header.php'; ?>

<div class="container">
    <?php if ($data['product']): ?>
        <div class="product-details">
            <img src="<?php echo $data['product']->image; ?>" alt="<?php echo $data['product']->name; ?>">
            <h2><?php echo $data['product']->name; ?></h2>
            <p><?php echo $data['product']->description; ?></p>
            <p class="price">Precio: S/ <?php echo number_format($data['product']->price, 2); ?></p>
            <p>Stock Disponible: <?php echo $data['product']->stock; ?></p>
            <?php if (isset($_SESSION['user_id'])): ?>
                <form action="/cart/add/<?php echo $data['product']->id; ?>" method="post">
                    <input type="number" name="quantity" value="1" min="1" max="<?php echo $data['product']->stock; ?>">
                    <input type="submit" value="Añadir al Carrito" class="button">
                </form>
            <?php else: ?>
                <p><a href="/user/login" class="button">Inicia sesión para añadir al carrito</a></p>
            <?php endif; ?>

            <h3>Métodos de Pago Disponibles:</h3>
            <ul>
                <li>Tarjeta de Crédito/Débito</li>
                <li>PagoEfectivo</li>
                <li>PayPal</li>
            </ul>
        </div>
    <?php else: ?>
        <p>Producto no encontrado.</p>
    <?php endif; ?>
</div>

<?php require_once APP_ROOT . '/app/views/inc/footer.php'; ?>
