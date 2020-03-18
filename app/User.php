<?php 
session_start();
include_once('../../../config/Database.php');
class User extends Database {

  public function __construct(){
 
      parent::__construct();
  }

  
  // Get categories
  public function check_login($email, $password){
    // check users
    $stmt = "SELECT * FROM users WHERE email ='$email' LIMIT 1";

    $result = $this->conn->query($stmt);
    
    if ($result->rowCount() > 0) {
      if ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        $hushedPwd = password_verify($password, $row['password']);
        if (!$hushedPwd === false) {
          return $row['id'];
        }else{
          return false;
        }
      }
    }else{
      return false;
    }
  }
    
  }