<?php 
namespace App;

include_once('../../../config/Database.php');
class User extends Database {

  public function __construct(){
 
      parent::__construct();
  }

/**                   //
* Create @users       //
* Data array Required //
**/                   //

  public function create($data){
    //get data
    $email=$data['email'];
    $role=$data['role'];
    $password=$data['password'];

      $first_name=$data['first_name']??'';
      $last_name=$data['last_name']??'';
      $last_name=$data['last_name']??'';
      $phone=$data['phone']??'';
    

    $sql="SELECT * FROM users WHERE email='$email' ";
    $result= $this->conn->query($sql);
    if ($result->rowCount() > 0) {
      return false;
    }else{
      $hash_password= password_hash($password, PASSWORD_BCRYPT);
     
      $stmt ="INSERT INTO users(
        first_name,last_name,phone,email,role,password,active,created_at,updated_at
      ) VALUES (
        '$first_name','$last_name','$phone','$email','$role','$hash_password',1,now(),now()
      );";

      $this->conn->query($stmt);

      $last_id = $this->conn->lastInsertId();

      return $last_id;
    }




  }
  
  
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