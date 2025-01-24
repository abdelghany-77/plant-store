<?php
require_once 'Database.php';

class Product{
  private $db;
  public function __construct()
  {
    $this->db = (new Database())->connect();
  }

  // Add product to cart
  public function addToCart($user_id, $product_id, $quantity = 1)
  {
    $stmt = $this->db->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
    $stmt->execute([
      'user_id' => $user_id,
      'product_id' => $product_id,
      'quantity' => $quantity
    ]);
    return $stmt->rowCount();
  }

  // Get all products
  public function getAllProducts()
  {
    $stmt = $this->db->query("SELECT * FROM products");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get product by ID
  public function getProductById($id)
  {
    $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
