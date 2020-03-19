<?php
namespace App;
use Config\Database ;
class Company_branch extends Database {

    public function __construct(){
 
        parent::__construct();
    }
  
/**                   //
* Create @Company_branches     //
* Data array Required //
**/                   //

  public function create($data){

    $name=$data['name'];
    $address=$data['address']??'';
    $company_id=$data['company_id'];
    
    $sql="SELECT * FROM Company_branches WHERE name='$name' AND company_id='$company_id' ";
    $result= $this->conn->query($sql);
    if ($result->rowCount() > 0) {
        return false;
    }else{
        $stmt ="INSERT INTO Company_branches(
            name,address,company_id,created_at,updated_at
        )VALUES(
            '$name','$address','$company_id',now(),now()
        );";
        
        $this->conn->query($stmt);

        $last_id = $this->conn->lastInsertId();
        
        return $last_id;
    }
  }

}