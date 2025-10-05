<?php

namespace App\Controllers;

use App\Models\OrderModel;

class AdminController extends BaseController
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('location: /');
            exit();
        }
    }

    public function index()
    {
        $this->view('admin/index');
    }

    public function reports()
    {
        $orders = $this->orderModel->getAllOrders();
        $this->view('admin/reports', ['orders' => $orders]);
    }
}
