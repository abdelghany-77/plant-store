<?php

require_once 'Database.php';
class Cart {
    private $db;
    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Add to cart
    public function addToCart($user_id, $product_id, $quantity = 1) {
        $stmt = $this->db->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        $stmt->execute([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity
        ]);
        return $stmt->rowCount();
    }

    // Remove from cart
    public function removeFromCart($cart_id) {
        $stmt = $this->db->prepare("DELETE FROM cart WHERE id = :cart_id");
        $stmt->execute(['cart_id' => $cart_id]);
        return $stmt->rowCount();
    }

    // Update quantity
    public function updateQuantity($cart_id, $quantity) {
        $stmt = $this->db->prepare("UPDATE cart SET quantity = :quantity WHERE id = :cart_id");
        $stmt->execute([
            'cart_id' => $cart_id,
            'quantity' => $quantity
        ]);
        return $stmt->rowCount();
    }

    // Get cart items
    public function getCartItems($user_id) {
        $stmt = $this->db->prepare("SELECT cart.*, products.name, products.price FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>