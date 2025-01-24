<?php
require_once 'Database.php';
class User{
  private $db;

  public function __construct() {
    $this->db = (new Database())->connect();
  }

  public function register($username, $email, $password){
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $stmt->execute(['username' => $username, 'email' => $email, 'password' => $hashed_password]);
    return $stmt->rowCount();
  }

  public function login($email, $password){
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

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
