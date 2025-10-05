<?php require_once APP_ROOT . '/app/views/inc/header.php'; ?>

<div class="container">
    <?php if (!empty($data['orderDetails'])): ?>
        <h2>Detalles del Pedido #<?php echo $data['orderDetails'][0]->order_id; ?></h2>
        <p><strong>Fecha del Pedido:</strong> <?php echo date('d/m/Y H:i', strtotime($data['orderDetails'][0]->order_date)); ?></p>
        <p><strong>Estado:</strong> <?php echo ucfirst($data['orderDetails'][0]->status); ?></p>
        <p><strong>Total:</strong> S/ <?php echo number_format($data['orderDetails'][0]->total_amount, 2); ?></p>

        <h3>Productos del Pedido:</h3>
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
                <?php foreach ($data['orderDetails'] as $item): ?>
                    <tr>
                        <td><?php echo $item->product_name; ?></td>
                        <td><?php echo $item->quantity; ?></td>
                        <td>S/ <?php echo number_format($item->item_price, 2); ?></td>
                        <td>S/ <?php echo number_format($item->item_price * $item->quantity, 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/user/myorders" class="button">Volver a Mis Pedidos</a>
    <?php else: ?>
        <p>Detalles del pedido no encontrados.</p>
        <a href="/user/myorders" class="button">Volver a Mis Pedidos</a>
    <?php endif; ?>
</div>

<?php require_once APP_ROOT . '/app/views/inc/footer.php'; ?>
