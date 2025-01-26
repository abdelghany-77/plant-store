<?php
session_start();
require_once '../includes/auth.php';
require_once '../includes/cart.php';

Auth::redirectIfNotLoggedIn();

$cart = new Cart();
$user_id = $_SESSION['user_id'];
$cart_items = $cart->getCartItems($user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $cart->checkout($user_id);
  header("Location: ../index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Checkout - Plantex</title>
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

  <!--==================== CHECKOUT ====================-->
  <section class="section checkout">
    <div class="checkout__container container grid">
      <div class="checkout__data">
        <h1 class="checkout__title">Checkout</h1>
        <form method="POST" class="checkout__form">
          <ul class="checkout__items">
            <?php foreach ($cart_items as $item): ?>
              <li class="checkout__item">
                <?php echo $item['name']; ?>
                <br>
                Quantity = <?php echo $item['quantity']; ?>
                <br>
                The Total Price = $<?php echo $item['price'] * $item['quantity']; ?>
              </li>
            <?php endforeach; ?>
          </ul>
          <button type="submit" class="button button--flex checkout__button">
            Confirm Checkout <i class="ri-arrow-right-down-line button__icon"></i>
          </button>
        </form>
      </div>
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