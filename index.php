<?php
session_start();
require_once 'includes/auth.php';
require_once 'includes/product.php';

$product = new Product();
$products = $product->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!--=============== FAVICON ===============-->
  <link
    rel="shortcut icon"
    href="assets/img/favicon.png"
    type="image/x-icon" />

  <!--=============== REMIX ICONS ===============-->
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css"
    rel="stylesheet" />

  <!--=============== CSS ===============-->
  <link rel="stylesheet" href="assets/css/styles.css" />

  <title>Plants Store</title>
</head>

<body>
  <!--==================== HEADER ====================-->
  <header class="header" id="header">
    <nav class="nav container">
      <a href="#" class="nav__logo">
        <i class="ri-leaf-line nav__logo-icon"></i> Plantex
      </a>

      <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
          <li class="nav__item">
            <a href="#home" class="nav__link active-link">Home</a>
          </li>
          <li class="nav__item">
            <a href="#about" class="nav__link">About</a>
          </li>
          <li class="nav__item">
            <a href="#products" class="nav__link">Products</a>
          </li>
          <li class="nav__item">
            <a href="#faqs" class="nav__link">FAQs</a>
          </li>
          <li class="nav__item">
            <a href="#contact" class="nav__link">Contact Us</a>
          </li>
        </ul>

        <div class="nav__close" id="nav-close">
          <i class="ri-close-line"></i>
        </div>
      </div>

      <div class="nav__btns">
        <!-- Theme change button -->
        <i class="ri-moon-line change-theme" id="theme-button"></i>
        <?php if (Auth::isLoggedIn()): ?>
          <a href="user-page/logout.php" class="button button--flex">Logout</a>
        <?php else: ?>
          <a href="user-page/login.php" class="button button--flex">Login</a>
        <?php endif; ?>
        <a href="cart/view_cart.php" class="button button--flex">Cart</a>
        <div class="nav__toggle" id="nav-toggle">
          <i class="ri-menu-line"></i>
        </div>
      </div>
    </nav>
  </header>
  <!--==================== HOME ====================-->
  <section class="home" id="home">
    <div class="home__container container grid">
      <img src="assets/img/home.png" alt="" class="home__img" />

      <div class="home__data">
        <h1 class="home__title">
          Plants will make <br />
          your life better
        </h1>
        <p class="home__description">
          Create incredible plant design for your offices or apastaments.
          Add fresness to your new ideas.
        </p>
        <a href="#about" class="button button--flex">
          Explore <i class="ri-arrow-right-down-line button__icon"></i>
        </a>
      </div>
    </div>
  </section>

  <!--==================== ABOUT ====================-->
  <section class="about section container" id="about">
    <div class="about__container grid">
      <img src="assets/img/about.png" alt="" class="about__img" />

      <div class="about__data">
        <h2 class="section__title about__title">
          Who we really are & <br />
          why choose us
        </h2>

        <p class="about__description">
          We have over 4000+ unbiased reviews and our customers trust our
          plant process and delivery service every time
        </p>

        <div class="about__details">
          <p class="about__details-description">
            <i class="ri-checkbox-fill about__details-icon"></i>
            We always deliver on time.
          </p>
          <p class="about__details-description">
            <i class="ri-checkbox-fill about__details-icon"></i>
            We give you guides to protect and care for your plants.
          </p>
          <p class="about__details-description">
            <i class="ri-checkbox-fill about__details-icon"></i>
            We always come over for a check-up after sale.
          </p>
          <p class="about__details-description">
            <i class="ri-checkbox-fill about__details-icon"></i>
            100% money back guaranteed.
          </p>
        </div>

        <a href="#products" class="button--link button--flex">
          Shop Now <i class="ri-arrow-right-down-line button__icon"></i>
        </a>
      </div>
    </div>
  </section>

  <!--==================== STEPS ====================-->
  <section class="steps section container">
    <div class="steps__bg">
      <h2 class="section__title-center steps__title">
        Steps to start your <br />
        plants off right
      </h2>

      <div class="steps__container grid">
        <div class="steps__card">
          <div class="steps__card-number">01</div>
          <h3 class="steps__card-title">Choose Plant</h3>
          <p class="steps__card-description">
            We have several varieties plants you can choose from.
          </p>
        </div>

        <div class="steps__card">
          <div class="steps__card-number">02</div>
          <h3 class="steps__card-title">Place an order</h3>
          <p class="steps__card-description">
            Once your order is set, we move to the next step which is the
            shipping.
          </p>
        </div>

        <div class="steps__card">
          <div class="steps__card-number">03</div>
          <h3 class="steps__card-title">Get plants delivered</h3>
          <p class="steps__card-description">
            Our delivery process is easy, you receive the plant direct to
            your door.
          </p>
        </div>
      </div>
    </div>
  </section>
  <!--==================== PRODUCTS ====================-->
  <section class="product section container" id="products">
    <h2 class="section__title-center">Check out our products</h2>
    <p class="product__description">
      Here are some selected plants from our showroom, all are in excellent shape and have a long life span. Buy and enjoy best quality.
    </p>

    <div class="product__container grid">
      <?php foreach ($products as $product): ?>
        <article class="product__card">
          <div class="product__circle"></div>
          <img src="assets/img/product1.png?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product__img" />
          <h3 class="product__title"><?php echo $product['name']; ?></h3>
          <span class="product__price">$<?php echo $product['price']; ?></span>

          <!-- Add to Cart Form -->
          <form action="cart/add_to_cart.php" method="POST" class="product__form">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>" />
            <button type="submit" class="button--flex product__button">
              <i class="ri-shopping-bag-line"></i>
            </button>
          </form>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <!--==================== QUESTIONS ====================-->
  <section class="questions section" id="faqs">
    <h2 class="section__title-center questions__title container">
      Some common questions <br />
      were often asked
    </h2>

    <div class="questions__container container grid">
      <div class="questions__group">
        <div class="questions__item">
          <header class="questions__header">
            <i class="ri-add-line questions__icon"></i>
            <h3 class="questions__item-title">
              My flowers are falling off or dying?
            </h3>
          </header>

          <div class="questions__content">
            <p class="questions__description">
              Plants are easy way to add color energy and transform your
              space but which planet is for you. Choosing the right plant.
            </p>
          </div>
        </div>

        <div class="questions__item">
          <header class="questions__header">
            <i class="ri-add-line questions__icon"></i>
            <h3 class="questions__item-title">
              What causes leaves to become pale?
            </h3>
          </header>

          <div class="questions__content">
            <p class="questions__description">
              Plants are easy way to add color energy and transform your
              space but which planet is for you. Choosing the right plant.
            </p>
          </div>
        </div>

        <div class="questions__item">
          <header class="questions__header">
            <i class="ri-add-line questions__icon"></i>
            <h3 class="questions__item-title">
              What causes brown crispy leaves?
            </h3>
          </header>

          <div class="questions__content">
            <p class="questions__description">
              Plants are easy way to add color energy and transform your
              space but which planet is for you. Choosing the right plant.
            </p>
          </div>
        </div>
      </div>

      <div class="questions__group">
        <div class="questions__item">
          <header class="questions__header">
            <i class="ri-add-line questions__icon"></i>
            <h3 class="questions__item-title">How do i choose a plant?</h3>
          </header>

          <div class="questions__content">
            <p class="questions__description">
              Plants are easy way to add color energy and transform your
              space but which planet is for you. Choosing the right plant.
            </p>
          </div>
        </div>

        <div class="questions__item">
          <header class="questions__header">
            <i class="ri-add-line questions__icon"></i>
            <h3 class="questions__item-title">How do I change the pots?</h3>
          </header>

          <div class="questions__content">
            <p class="questions__description">
              Plants are easy way to add color energy and transform your
              space but which planet is for you. Choosing the right plant.
            </p>
          </div>
        </div>

        <div class="questions__item">
          <header class="questions__header">
            <i class="ri-add-line questions__icon"></i>
            <h3 class="questions__item-title">
              Why are gnats flying around my plant?
            </h3>
          </header>

          <div class="questions__content">
            <p class="questions__description">
              Plants are easy way to add color energy and transform your
              space but which planet is for you. Choosing the right plant.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--==================== CONTACT ====================-->
  <footer class="contact section container" id="contact">
    <div class="contact__container grid">
      <div class="contact__box">
        <h2 class="section__title">
          Reach out to us today <br />
          via any of the given <br />
          information
        </h2>
        <div class="contact__data">
          <div class="contact__information">
            <h3 class="footer__title">Contact us for instant support</h3>
            <span class="contact__description">
              <i class="ri-phone-line contact__icon"></i>
              +999 888 777
            </span>
            <br>
            <span class="contact__description">
              <i class="ri-mail-line contact__icon"></i>
              plantx@gmail.com
            </span>
          </div>
          <div class="contact__information">
            <h3 class="footer__title">Follow us</h3>
            <span class="contact__description">
              <div class="footer__social">
                <a href="https://www.facebook.com/" class="footer__social-link">
                  <i class="ri-facebook-fill"></i>
                </a>
                <a href="https://www.instagram.com/" class="footer__social-link">
                  <i class="ri-instagram-line"></i>
                </a>
                <a href="https://twitter.com/" class="footer__social-link">
                  <i class="ri-twitter-fill"></i>
                </a>
              </div>
            </span>
          </div>
        </div>
      </div>

      <form action="" class="contact__form">
        <div class="contact__inputs">
          <div class="contact__content">
            <input type="email" placeholder=" " class="contact__input" />
            <label for="" class="contact__label">Email</label>
          </div>

          <div class="contact__content">
            <input type="text" placeholder=" " class="contact__input" />
            <label for="" class="contact__label">Subject</label>
          </div>

          <div class="contact__content contact__area">
            <textarea
              name="message"
              placeholder=" "
              class="contact__input"></textarea>
            <label for="" class="contact__label">Message</label>
          </div>
        </div>

        <button class="button button--flex">
          Send Message
          <i class="ri-arrow-right-up-line button__icon"></i>
        </button>
      </form>
    </div>
    <p class="footer__copy">&#169; Plantx. All rigths reserved</p>
  </footer>
  </main>
  <!--=============== SCROLL UP ===============-->
  <a href="#" class="scrollup" id="scroll-up">
    <i class="ri-arrow-up-fill scrollup__icon"></i>
  </a>
  <!--=============== SCROLL REVEAL ===============-->
  <script src="assets/js/scrollreveal.min.js"></script>

  <!--=============== MAIN JS ===============-->
  <script src="assets/js/main.js"></script>
</body>

</html>