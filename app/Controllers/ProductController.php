<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $products = $this->productModel->getProducts();
        $this->view('products/index', ['products' => $products]);
    }

    public function details($id)
    {
        $product = $this->productModel->getProductById($id);
        $this->view('products/details', ['product' => $product]);
    }
}
