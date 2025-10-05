<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Virtual de Mascotas</title>
    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Tienda de Mascotas</h1>
            <nav>
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li><a href="/products">Productos</a></li>
                    <li><a href="/cart">Carrito</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php if ($_SESSION['user_role'] === 'admin'): ?>
                            <li><a href="/admin">Admin</a></li>
                        <?php endif; ?>
                        <li><a href="/user/myorders">Mis Pedidos</a></li>
                        <li><a href="/user/logout">Cerrar Sesión (<?php echo $_SESSION['user_name']; ?>)</a></li>
                    <?php else: ?>
                        <li><a href="/user/login">Iniciar Sesión</a></li>
                        <li><a href="/user/register">Registrarse</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
