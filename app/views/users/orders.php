<?php require_once APP_ROOT . '/app/views/inc/header.php'; ?>

<div class="container">
    <h2>Mis Pedidos</h2>
    <?php if (!empty($data['orders'])): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID de Pedido</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['orders'] as $order): ?>
                    <tr>
                        <td><?php echo $order->id; ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($order->order_date)); ?></td>
                        <td>S/ <?php echo number_format($order->total_amount, 2); ?></td>
                        <td><?php echo ucfirst($order->status); ?></td>
                        <td><a href="/user/orderdetails/<?php echo $order->id; ?>" class="button">Ver Detalles</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No tienes pedidos realizados aún.</p>
        <a href="/products" class="button">Explorar Productos</a>
    <?php endif; ?>
</div>

<?php require_once APP_ROOT . '/app/views/inc/footer.php'; ?>
