<?php
// cart/add_to_cart.php

session_start();
require_once '../includes/auth.php';
require_once '../includes/product.php';

Auth::redirectIfNotLoggedIn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $product_id = $_POST['product_id'];
  $user_id = $_SESSION['user_id'];

  $product = new Product();
  $product->addToCart($user_id, $product_id);

  header("Location: view_cart.php");
  exit();
}
