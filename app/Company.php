<?php
namespace App;
use Config\Database ;
class Company extends Database {

    public function __construct(){
 
        parent::__construct();
    }
  
/**                   //
* Create @company     //
* Data array Required //
**/                   //

  public function create($data){

    $name=$data['business'];
    $phone=$data['phone']??'';
    $address=$data['address']??'';
    $user_id=$data['user_id'];
    $logo=$data['logo']??'';
    
    $sql="SELECT * FROM companies WHERE name='$name' ";
    $result= $this->conn->query($sql);
    if ($result->rowCount() > 0) {
        return false;
    }else{
        $stmt ="INSERT INTO companies(
            name,phone,address,user_id,logo,created_at,updated_at
        )VALUES(
            '$name','$phone','$address','$user_id','$logo',now(),now()
        );";

        $this->conn->query($stmt);

        $last_id = $this->conn->lastInsertId();
        
        return $last_id;
    }
  }

}