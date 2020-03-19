<?php
namespace App;
use Config\Database ;
class Country  extends Database{
    private $table = 'countries';

    public function __construct(){
 
        parent::__construct();
    }

    public function allCountries($sql){
        $query ='SELECT *  FROM
        ' . $this->table . '
      ORDER BY
        created_at DESC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
}