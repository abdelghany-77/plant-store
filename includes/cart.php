<?php

require_once 'Database.php';
class Cart {
    private $db;
    public function __construct(){
        $this->db = (new Database())->connect();
    }

    // Add to cart
    public function addToCart($user_id, $product_id, $quantity = 1) {
        $query = $this->db->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        $query->execute([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity
        ]);
        return $query->rowCount();
    }

    // Remove from cart
    public function removeFromCart($cart_id) {
        $query = $this->db->prepare("DELETE FROM cart WHERE id = :cart_id");
        $query->execute(['cart_id' => $cart_id]);
        return $query->rowCount();
    }

    // Update quantity
    public function updateQuantity($cart_id, $quantity) {
        $query = $this->db->prepare("UPDATE cart SET quantity = :quantity WHERE id = :cart_id");
        $query->execute([
            'cart_id' => $cart_id,
            'quantity' => $quantity
        ]);
        return $query->rowCount();
    }

    // Get cart items
    public function getCartItems($user_id) {
        $query = $this->db->prepare("SELECT cart.*, products.name, products.price FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = :user_id");
        $query->execute(['user_id' => $user_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>