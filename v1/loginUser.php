<?php 

require_once '../includes/DbOperations.php';

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['staffID']) and isset($_POST['password'])){
		$db = new DbOperations(); 

        $resust = $db->isLoginCredentialCorrect($_POST['staffID'], $_POST['password']);
		if($resust == 1){
			$user = $db->getUserByStaffId($_POST['staffID']);
			$response['error'] = false; 
			$response['Id'] = $user['Id'];
			$response['Staff ID'] = $user['staff_ID']; 
			$response['Username'] = $user['Username'];
		}else{
			$response['error'] = true; 
			$response['message'] = "Invalid username or password";			
		}

	}else{
		$response['error'] = true; 
		$response['message'] = "Required fields are missing";
	}
}
echo json_encode($response);