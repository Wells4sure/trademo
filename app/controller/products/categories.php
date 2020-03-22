<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include '../../../config/Autoloader.php';

$response = array();

$category = new App\Category();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
    if(isset($_POST['create'])){

        $name = $category->checkInputs($_POST['name']);
        $color = $category->checkInputs($_POST['color']);
        //validation 
        $response['error']=false;

        if(!$name){
            $response['error'] = true;
            $response['name'] = 'Category Name is required';
        };
        if(!$color){
            $response['error'] = true;
            $response['color'] = 'Category color is required';
        };

        if(!$response['error']){
             $data =[
                 'name'=>$name,
                 'color'=>$color
             ];

             if($category->create($data)){
                $response['error'] = false;
                $response['message'] = 'Category Successfully Created';
             }
        }

    }

    if(isset($_POST['delete'])){

        $id=$category->checkInputs($_POST['category_id']);
        
        $data =[
            'category_id'=>$id,
        ];
        if($category->delete($data)){
            $response['error'] = false;
            $response['message'] = 'Category Successfully Deleted';
         }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if($category->getAll()){
        $response['error'] = false;
        $response['data'] =$category->getAll()['categories'];
     }
}


if (isset($response)) {
    
    echo json_encode($response);
}
