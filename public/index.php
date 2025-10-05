<?php

require_once dirname(__DIR__) . '/config/config.php';
require_once APP_ROOT . '/vendor/autoload.php';

use App\Router;

$router = new Router();

// Define routes
$router->addRoute('GET', '/', ['Product', 'index']);
$router->addRoute('GET', '/products', ['Product', 'index']);
$router->addRoute('GET', '/product/details/{id}', ['Product', 'details']);

// User routes
$router->addRoute('GET', '/user/register', ['User', 'register']);
$router->addRoute('POST', '/user/register', ['User', 'register']);
$router->addRoute('GET', '/user/login', ['User', 'login']);
$router->addRoute('POST', '/user/login', ['User', 'login']);
$router->addRoute('GET', '/user/logout', ['User', 'logout']);

// Cart routes
$router->addRoute('GET', '/cart', ['Cart', 'index']);
$router->addRoute('POST', '/cart/add/{id}', ['Cart', 'add']);
$router->addRoute('POST', '/cart/update/{id}', ['Cart', 'update']);
$router->addRoute('GET', '/cart/remove/{id}', ['Cart', 'remove']);

// Order routes
$router->addRoute('GET', '/checkout', ['Order', 'checkout']);
$router->addRoute('POST', '/order/checkout', ['Order', 'checkout']);
$router->addRoute('GET', '/order/success', ['Order', 'success']);
$router->addRoute('GET', '/user/myorders', ['Order', 'myorders']);
$router->addRoute('GET', '/user/orderdetails/{id}', ['Order', 'orderDetails']);

// Admin routes
$router->addRoute('GET', '/admin', ['Admin', 'index']);
$router->addRoute('GET', '/admin/reports', ['Admin', 'reports']);
$router->addRoute('GET', '/admin/orderdetails/{id}', ['Order', 'orderDetails']); // Reusing orderDetails from OrderController

// Dispatch the request
$router->dispatch();
