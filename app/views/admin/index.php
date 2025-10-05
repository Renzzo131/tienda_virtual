<?php require_once APP_ROOT . '/app/views/inc/header.php'; ?>

<div class="container">
    <h2>Panel de Administración</h2>
    <p>Bienvenido, <?php echo $_SESSION['user_name']; ?> (<?php echo $_SESSION['user_role']; ?>)</p>
    <ul>
        <li><a href="/admin/reports">Ver Reportes de Pedidos</a></li>
        <!-- Agrega más enlaces de administración aquí -->
    </ul>
</div>

<?php require_once APP_ROOT . '/app/views/inc/footer.php'; ?>
