<?php

require_once '../includes/DbOperations.php';

$response = array(); 


if($_SERVER['REQUEST_METHOD']=='POST'){


    if(
        isset($_POST['staffID'])
    ){

        $db = new DBOperations();

        $result = $db->projectDetailsByStaffId($_POST['staffID']);
        //echo json_encode($result);
        if($result){

            $response['S.NO'] = $result['S.NO'];
            $response['TALLY CODE'] = $result['TALLY CODE'];
            $response['DEPARTMENT'] = $result['DEPARTMENT'];
            $response['staff_ID'] = $result['staff_ID'];
            $response['NAME'] = $result['NAME'];
            $response['TITLE OF THE PROJECT'] = $result['TITLE OF THE PROJECT'];
            $response['FUNDING AGENCY'] = $result['FUNDING AGENCY'];
            $response['SANCTION ORDER NO'] = $result['SANCTION ORDER NO'];
            $response['DURATION'] = $result['DURATION'];
            $response['SANCTIONED AMOUNT RS'] = $result['SANCTIONED AMOUNT RS'];
            $response['OVERHEAD %'] = $result['OVERHEAD %'];
            $response['AMOUNT RECEIVED DATE'] = $result['AMOUNT RECEIVED DATE'];
            $response['AMOUNT RECEIVED TILL DATE'] = $result['AMOUNT RECEIVED TILL DATE'];
            $response['EXPENDITURE'] = $result['EXPENDITURE'];
            $response['OVERHEAD'] = $result['OVERHEAD'];
            $response['BALANCE AVAILABLE'] = $result['BALANCE AVAILABLE'];
            $response['MAN POWER'] = $result['MAN POWER'];
            $response['MAN POWER NAME'] = $result['MAN POWER NAME'];

        }else{
            $response['error'] = true;
            $response['message'] = 'NO Data Found..';
        }

    }

    
    echo json_encode($response);
}