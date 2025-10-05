<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\CartModel;

class OrderController extends BaseController
{
    private $orderModel;
    private $cartModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->cartModel = new CartModel();
    }

    public function checkout()
    {
        if (!isset($_SESSION['user_id'])) {
            header('location: /user/login');
            exit();
        }

        $cartItems = $this->cartModel->getCartItems();
        $total = $this->cartModel->getTotal();

        if (empty($cartItems)) {
            header('location: /cart');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process payment (mock) and create order
            if ($this->orderModel->createOrder($_SESSION['user_id'], $total, $cartItems)) {
                $this->cartModel->clearCart();
                header('location: /order/success');
            } else {
                die('Error al crear la orden');
            }
        } else {
            $this->view('checkout/index', ['cartItems' => $cartItems, 'total' => $total]);
        }
    }

    public function success()
    {
        $this->view('checkout/success');
    }

    public function myorders()
    {
        if (!isset($_SESSION['user_id'])) {
            header('location: /user/login');
            exit();
        }
        $orders = $this->orderModel->getOrdersByUserId($_SESSION['user_id']);
        $this->view('users/orders', ['orders' => $orders]);
    }

    public function orderDetails($orderId)
    {
        if (!isset($_SESSION['user_id'])) {
            header('location: /user/login');
            exit();
        }
        $orderDetails = $this->orderModel->getOrderDetails($orderId);
        if (empty($orderDetails) || $orderDetails[0]->user_id != $_SESSION['user_id']) {
            header('location: /user/myorders');
            exit();
        }
        $this->view('users/order_details', ['orderDetails' => $orderDetails]);
    }
}
