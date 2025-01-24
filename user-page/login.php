<?php
// user-page/login.php

session_start();
require_once '../includes/user.php';
require_once '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $user = new User();
  if ($user->login($email, $password)) {
    header("Location: ../index.php");
    exit();
  } else {
    $error = "Invalid email or password.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Plantex</title>
  <link
    rel="shortcut icon"
    href="assets/img/favicon.png"
    type="image/x-icon" />
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

  <!--==================== LOGIN ====================-->
  <section class="section login">
    <div class="login__container container grid">
      <div class="login__data">
        <h1 class="login__title">Login</h1>
        <?php if (isset($error)): ?>
          <p class="login__error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" class="login__form">
          <div class="login__content">
            <input type="email" name="email" placeholder=" " class="login__input" required />
            <label for="email" class="login__label">Email</label>
          </div>
          <div class="login__content">
            <input type="password" name="password" placeholder=" " class="login__input" required />
            <label for="password" class="login__label">Password</label>
          </div>
          <button type="submit" class="button button--flex login__button">
            Login <i class="ri-arrow-right-down-line button__icon"></i>
          </button>
        </form>
        <p class="login__register">
          Don't have an account? <a href="register.php">Register here</a>
        </p>
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