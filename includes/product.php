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
    $query = $this->db->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
    $query->execute([
      'user_id' => $user_id,
      'product_id' => $product_id,
      'quantity' => $quantity
    ]);
    return $query->rowCount();
  }

  // Get all products
  public function getAllProducts()
  {
    $query = $this->db->query("SELECT * FROM products");
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get product by ID
  public function getProductById($id)
  {
    $query = $this->db->prepare("SELECT * FROM products WHERE id = :id");
    $query->execute(['id' => $id]);
    return $query->fetch(PDO::FETCH_ASSOC);
  }
}
