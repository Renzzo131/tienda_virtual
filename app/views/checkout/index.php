<?php require_once APP_ROOT . '/app/views/inc/header.php'; ?>

<div class="container">
    <h2>Realizar Pedido</h2>
    <?php if (!empty($data['cartItems'])): ?>
        <h4>Resumen de tu Pedido</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['cartItems'] as $item): ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>S/ <?php echo number_format($item['price'], 2); ?></td>
                        <td>S/ <?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Total a Pagar: S/ <?php echo number_format($data['total'], 2); ?></h3>

        <div class="payment-section">
            <h4>Selecciona tu Método de Pago</h4>
            <form action="/order/checkout" method="post">
                <div class="form-group">
                    <input type="radio" id="card" name="payment_method" value="card" checked>
                    <label for="card">Tarjeta de Crédito/Débito</label><br>
                    <input type="radio" id="pagoefectivo" name="payment_method" value="pagoefectivo">
                    <label for="pagoefectivo">PagoEfectivo</label><br>
                    <input type="radio" id="paypal" name="payment_method" value="paypal">
                    <label for="paypal">PayPal</label><br>
                </div>
                <input type="submit" value="Confirmar Pedido" class="button">
            </form>
        </div>
    <?php else: ?>
        <p>Tu carrito está vacío. No puedes realizar un pedido.</p>
        <a href="/products" class="button">Ver Productos</a>
    <?php endif; ?>
</div>

<?php require_once APP_ROOT . '/app/views/inc/footer.php'; ?>
