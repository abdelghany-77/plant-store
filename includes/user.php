<?php
require_once 'Database.php';
class User{
  private $db;

  public function __construct() {
    $this->db = (new Database())->connect();
  }

  public function register($username, $email, $password){
    $errors = [];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email address.";
    }
    if (strlen($password) < 8) {
      $errors[] = "Password must be at least 8 characters long.";
    }
    if (!preg_match("/[A-Z]/", $password)) {
      $errors[] = "Password must contain at least one uppercase letter.";
    }
    if (!preg_match("/[a-z]/", $password)) {
      $errors[] = "Password must contain at least one lowercase letter.";
    }
    if (!preg_match("/[0-9]/", $password)) {
      $errors[] = "Password must contain at least one number.";
    }
    if (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $password)) {
      $errors[] = "Password must contain at least one special character.";
    }
    if (!empty($errors)) {
      return $errors;
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $query->execute([
      'username' => $username,
      'email' => $email,
      'password' => $hashed_password
    ]);
    return true; // Registration successful
  }
  public function login($email, $password){
    $query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
    $query->execute(['email' => $email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      return true;
    }
    return false;
  }
  public function logout(){
    session_destroy();
  }
}
