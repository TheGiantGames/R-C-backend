<?php

require_once '../includes/DBOperations.php';

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    if(
        isset($_POST['username'] , $_POST['staffID'], $_POST['password'])
    ){
        //operations
            $db = new DBOperations();

            $result = $db->isValidUser($_POST['username'] , $_POST['staffID'] );
            
            if($result == 1){
                $userResult = $db->validUserCredentials($_POST['username'] , $_POST['staffID']);
                //$isPassResult = $db->isPassAlreadySet($userResult['Id']);
                if(!empty($userResult['Password']) ){
                    $response['error'] = true;
                    $response['message'] = "User Already registered";
                }else{
                    if($userResult['Id']){
                        $createPassResult = $db->createPassword($userResult['Id'],$_POST['password'] );
                        if($createPassResult){
                            $response['error'] = false;
                            $response['message'] = "password saved successfully";
                        }else{
                            $response['error'] = true;
                            $response['message'] = "Error occured in storing password";
                        }
                    }
                }

                
                   
                
            }
            if($result == 0 ){
                $response['error'] = true;
                $response['message'] = "Invalid Username or staff Id";
            }



    }else{
        $response['error'] = true;
        $response['message'] = "Required fields are missing";
    }

}else{
    $response['error'] = true;
    $response['message'] = "Invalid Request";
}

echo json_encode($response);