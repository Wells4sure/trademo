<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include '../../../config/Autoloader.php';

$response = array();

// Instantiate  objects
$user = new App\User();
$company = new App\Company();
$branch = new App\Company_branch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //set up
    if(isset($_POST['setup'])){

        $email = $user->checkInputs($_POST['email']);
        $password = $user->checkInputs($_POST['password']);
        $role = $user->checkInputs($_POST['role']);
        $business = $company->checkInputs($_POST['business']);

        //validation 
        $response['error']=false;
        if(!$email){
            $response['error'] = true;
            $response['email'] = 'Email is required';
        };

        if(!$password){
            $response['error'] = true;
            $response['password'] = 'Password is required';
        }

        if(!$business){
            $response['error'] = true;
            $response['business'] = 'Business name is required';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['error'] = true;
            $response['email'] =  "Invalid format and please re-enter valid email.";
        }

        if(!$response['error']){

       
            $data =[
                'first_name'=>'Owner',
                'last_name'=>'Owner',
                'email'=>$email,
                'password'=>$password,
                'role'=>$role,
                'setup'=>$_POST['setup'],
            ];

            $userCreated=$user->create($data);
            //create Company
            if($userCreated){

            
                $data =[
                    'user_id'=>$userCreated, 
                    'business'=>$business 
                ];
                $companyCreated=$company->create($data);

                //create Branch
                if($companyCreated) {
                    $data=[
                    'company_id'=>$companyCreated, 
                    'name'=>$business  
                    ];
                    if($branch->create($data)){
                        $response['error'] = false;
                        $response['message'] = 'Merchant Generated';
                    }else{
                        
                    $response['error'] = true;
                    $response['message'] = 'Company branch name already exists';
                    };
                }else{
                    //failed

                    $response['error'] = true;
                    $response['message'] = 'Company name already taken';
                };
            }else{
                $response['error'] = true;
                $response['message'] = 'email Already taken';
            }


        }
    }
}


if (isset($response)) {
    
    echo json_encode($response);
}
