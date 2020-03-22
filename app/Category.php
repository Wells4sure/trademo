<?php

namespace App;

use Config\Database ;
class Category extends Database {

  private $table = 'categories';

    public function __construct(){
 
        parent::__construct();
    }

    public function create($data){
        $name=$data['name'];
        $color=$data['color'];

        $sql="INSERT INTO categories (name,color,created_at,updated_at) 
               VALUES(:name,:color,now(),now()) ";
        
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':color', $color);

        try{
            $stmt->execute();
            return true;
        }catch(\Exception $e){
            return 'Error: - '.$e;
        }
       

    }

    public function getAll(){
    
      $query = 'SELECT * FROM categories ORDER BY created_at DESC';

      $stmt = $this->conn->prepare($query);

      $stmt->execute();
      if($stmt->rowCount() > 0){

        $cat_arr = array();
        $cat_arr['categories'] = array();

        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            extract($row);

            $cat_item = array(
              'id' => $id,
              'name' => $name,
              'color' => $color
            );
  
            // Push to "data"
            array_push($cat_arr['categories'], $cat_item);
        }
        return $cat_arr;
      }
    }

    public function delete($data) {
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

      $stmt = $this->conn->prepare($query);

      $stmt-> bindParam(':id', $data['category_id']);

      if($stmt->execute()) {
        return true;
      }
     

      return false;
    }
}