<?php

namespace App;

use Config\Database ;

class Session extends Database{

    public function __construct(){
 
        parent::__construct();
    }

    public function check(){

        if ((!empty($_SESSION['user']))) {
           return 'true';
        }

        return 'false';
    }

    public function user(){

        if ((!empty($_SESSION['user']))) {
            $user=$_SESSION['user'];

            $sql = "SELECT * FROM users WHERE id='$user' ";
            $result= $this->conn->query($sql);
            if ($result->rowCount() > 0) {
                return false;
            }else{
                return $result;
            }
        }
    }
  
}