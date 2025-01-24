<?php

session_start();
require_once '../includes/auth.php';
require_once '../includes/cart.php';

Auth::redirectIfNotLoggedIn();

$cart = new Cart();
$user_id = $_SESSION['user_id'];

// Fetch cart items for the logged-in user
$cart_items = $cart->getCartItems($user_id);

// Handle remove item request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
  $cart_id = $_POST['cart_id'];
  $cart->removeFromCart($cart_id);
  header("Location: view_cart.php"); // Refresh the page
  exit();
}

// Handle update quantity request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
  $cart_id = $_POST['cart_id'];
  $quantity = $_POST['quantity'];
  $cart->updateQuantity($cart_id, $quantity);
  header("Location: view_cart.php"); // Refresh the page
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cart - Plantex</title>
  <link rel="stylesheet" href="../assets/css/styles.css" />
</head>

<body>
  <!--==================== HEADER ====================-->
  <header class="header" id="header">
    <nav class="nav container">
      <a href="../index.php" class="nav__logo">
        <i class="ri-leaf-line nav__logo-icon"></i> Plantex
      </a>

      <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
          <li class="nav__item">
            <a href="../index.php" class="nav__link">Home</a>
          </li>
          <li class="nav__item">
            <a href="../index.php#about" class="nav__link">About</a>
          </li>
          <li class="nav__item">
            <a href="../index.php#products" class="nav__link">Products</a>
          </li>
          <li class="nav__item">
            <a href="../index.php#faqs" class="nav__link">FAQs</a>
          </li>
          <li class="nav__item">
            <a href="../index.php#contact" class="nav__link">Contact Us</a>
          </li>
        </ul>

        <div class="nav__close" id="nav-close">
          <i class="ri-close-line"></i>
        </div>
      </div>

      <div class="nav__btns">
        <!-- Theme change button -->
        <i class="ri-moon-line change-theme" id="theme-button"></i>
        <div class="nav__toggle" id="nav-toggle">
          <i class="ri-menu-line"></i>
        </div>
      </div>
    </nav>
  </header>

  <!--==================== CART ====================-->
  <section class="section cart">
    <div class="cart__container container grid">
      <h1 class="cart__title">Your Cart</h1>
      <div class="cart__items">
        <?php if (empty($cart_items)): ?>
          <p>Your cart is empty.</p>
        <?php else: ?>
          <?php foreach ($cart_items as $item): ?>
            <div class="cart__item">
              <h3><?php echo $item['name']; ?></h3>
              <p>Price: $<?php echo $item['price']; ?></p>

              <!-- Update Quantity Form -->
              <form action="view_cart.php" method="POST" class="cart__quantity-form">
                <input type="hidden" name="cart_id" value="<?php echo $item['id']; ?>" />
                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="cart__quantity-input" />
                <button type="submit" name="update_quantity" class="button button--flex cart__update-button">
                  Update <i class="ri-refresh-line"></i>
                </button>
              </form>

              <!-- Remove Item Form -->
              <form action="view_cart.php" method="POST" class="cart__remove-form">
                <input type="hidden" name="cart_id" value="<?php echo $item['id']; ?>" />
                <button type="submit" name="remove_item" class="button button--flex cart__remove-button">
                  Remove <i class="ri-delete-bin-line"></i>
                </button>
              </form>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
      <a href="checkout.php" class="button button--flex">Proceed to Checkout</a>
    </div>
  </section>

  <!--==================== FOOTER ====================-->
  <footer class="footer section">
    <p class="footer__copy">&#169; Plantex. All rights reserved</p>
  </footer>

  <!--=============== SCROLL REVEAL ===============-->
  <script src="../assets/js/scrollreveal.min.js"></script>

  <!--=============== MAIN JS ===============-->
  <script src="../assets/js/main.js"></script>
</body>

</html>