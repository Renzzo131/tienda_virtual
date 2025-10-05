<?php

namespace App\Models;

use App\Database;

class OrderModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function createOrder($userId, $totalAmount, $cartItems)
    {
        $this->db->query('INSERT INTO orders (user_id, total_amount, status) VALUES (:user_id, :total_amount, :status)');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':total_amount', $totalAmount);
        $this->db->bind(':status', 'pending');

        if ($this->db->execute()) {
            $orderId = $this->db->dbh->lastInsertId();

            foreach ($cartItems as $item) {
                $this->db->query('INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)');
                $this->db->bind(':order_id', $orderId);
                $this->db->bind(':product_id', $item['product_id']);
                $this->db->bind(':quantity', $item['quantity']);
                $this->db->bind(':price', $item['price']);
                $this->db->execute();
            }
            return true;
        }
        return false;
    }

    public function getOrdersByUserId($userId)
    {
        $this->db->query('SELECT * FROM orders WHERE user_id = :user_id ORDER BY order_date DESC');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function getOrderDetails($orderId)
    {
        $this->db->query('SELECT o.*, oi.quantity, oi.price as item_price, p.name as product_name, p.image FROM orders o JOIN order_items oi ON o.id = oi.order_id JOIN products p ON oi.product_id = p.id WHERE o.id = :order_id');
        $this->db->bind(':order_id', $orderId);
        return $this->db->resultSet();
    }

    public function getAllOrders()
    {
        $this->db->query('SELECT o.*, u.username FROM orders o JOIN users u ON o.user_id = u.id ORDER BY order_date DESC');
        return $this->db->resultSet();
    }
}
