<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;

class CartController extends BaseController
{
    private $cartModel;
    private $productModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $cartItems = $this->cartModel->getCartItems();
        $total = $this->cartModel->getTotal();
        $this->view('cart/index', ['cartItems' => $cartItems, 'total' => $total]);
    }

    public function add($productId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_SESSION['user_id'])) {
                header('location: /user/login');
                exit();
            }
            $quantity = $_POST['quantity'] ?? 1;
            $product = $this->productModel->getProductById($productId);

            if ($product) {
                $this->cartModel->addToCart($productId, $quantity, $product);
                header('location: /cart');
            } else {
                die('Producto no encontrado');
            }
        }
    }

    public function update($productId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $quantity = $_POST['quantity'] ?? 1;
            $this->cartModel->updateCartItem($productId, $quantity);
            header('location: /cart');
        }
    }

    public function remove($productId)
    {
        $this->cartModel->removeFromCart($productId);
        header('location: /cart');
    }
}
