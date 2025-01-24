<?php
session_start();
require_once '../includes/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $user = new User();
  if ($user->register($username, $email, $password)) {
    header("Location: login.php");
    exit();
  } else {
    $error = "Registration failed.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Plantex</title>
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

  <!--==================== REGISTER ====================-->
  <section class="section register">
    <div class="register__container container grid">
      <div class="register__data">
        <h1 class="register__title">Register</h1>
        <?php if (isset($error)): ?>
          <p class="register__error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" class="register__form">
          <div class="register__content">
            <input type="text" name="username" placeholder=" " class="register__input" required />
            <label for="username" class="register__label">Username</label>
          </div>
          <div class="register__content">
            <input type="email" name="email" placeholder=" " class="register__input" required />
            <label for="email" class="register__label">Email</label>
          </div>
          <div class="register__content">
            <input type="password" name="password" placeholder=" " class="register__input" required />
            <label for="password" class="register__label">Password</label>
          </div>
          <button type="submit" class="button button--flex register__button">
            Register <i class="ri-arrow-right-down-line button__icon"></i>
          </button>
        </form>
        <p class="register__login">
          Already have an account? <a href="login.php">Login here</a>
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