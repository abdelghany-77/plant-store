<?php
class Auth{
  public static function isLoggedIn()
  {
    return isset($_SESSION['user_id']);
  }

  public static function redirectIfNotLoggedIn(){
    if (!self::isLoggedIn()) {
      header("Location: user-page/login.php");
      exit();
    }
  }
}
