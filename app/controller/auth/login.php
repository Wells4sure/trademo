<?php 

 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
 
 include_once '../../User.php';

 $response = array();

    // Instantiate user object
    $user = new User();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['login'])){

            $email = $user->checkInputs($_POST['email']);
            $password = $user->checkInputs($_POST['password']);
        
            $auth = $user->check_login($email, $password);
        
            if(!$auth){
              
                $response['error'] = true;
                $response['message'] = 'Invalid email or password';
            }else{
               
                $response['error'] = false;
                $response['message'] = 'User Authenticated';
              
            }
        }else{
            $response['error'] = true;
            $response['message'] = 'failed';
        }
        
    }

    //displaying the response in json structure
if (isset($response)) {
    
    echo json_encode($response);
}
?>