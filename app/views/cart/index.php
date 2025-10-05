<?php require_once APP_ROOT . '/app/views/inc/header.php'; ?>

<div class="container">
    <h2>Tu Carrito de Compras</h2>
    <?php if (!empty($data['cartItems'])): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['cartItems'] as $item): ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td>S/ <?php echo number_format($item['price'], 2); ?></td>
                        <td>
                            <form action="/cart/update/<?php echo $item['product_id']; ?>" method="post">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>S/ <?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        <td>
                            <a href="/cart/remove/<?php echo $item['product_id']; ?>" class="button">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Total: S/ <?php echo number_format($data['total'], 2); ?></h3>
        <a href="/checkout" class="button">Proceder al Pago</a>
    <?php else: ?>
        <p>Tu carrito está vacío.</p>
        <a href="/products" class="button">Ver Productos</a>
    <?php endif; ?>
</div>

<?php require_once APP_ROOT . '/app/views/inc/footer.php'; ?>
