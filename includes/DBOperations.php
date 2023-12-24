<?php

class DBOperations{

    private $con;
    function __construct(){

        require_once dirname(__FILE__).'/DBConnect.php';

        $db = new DBConnect();

        $this->con = $db->connect();

    }


    public function isValidUser($username, $staffID){

        $stmt = $this->con->prepare("SELECT * FROM staff WHERE Username = ? AND staff_ID = ?");
        $stmt->bind_param("ss" , $username , $staffID);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows>0){
            return 1;
        }else{
            return 0;
        }
         
    }

    public function validUserCredentials($username, $staffID){

        $stmt = $this->con->prepare("SELECT * FROM staff WHERE Username = ? OR staff_ID = ?");
        $stmt->bind_param("ss" , $username , $staffID);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
         
    }

    public function createPassword($ID , $password){

        $stmt = $this->con->prepare("UPDATE `staff` SET `Password` = ? WHERE `staff`.`Id` = ?;");
        $stmt->bind_param("ss" , $password , $ID);
        if( $stmt->execute()){
            return true;
        }else{
            return false;
        }
         
    }

    public function isPassAlreadySet($ID){

        $stmt = $this->con->prepare("SELECT * FROM staff WHERE Id = ?");
        $stmt->bind_param("s" , $ID);
        $stmt->execute();
        $stmt->store_result();
        //$stmt->get_result()->fetch_assoc();
        if($stmt['Password']){
            return true;
        }else{
            return false;
        }
        
    }

    public function isLoginCredentialCorrect($staffID , $password){
        $stmt = $this->con->prepare("SELECT * FROM staff WHERE Password = ? AND staff_ID = ?");
        $stmt->bind_param("ss" , $password , $staffID);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows>0){
            return 1;
        }else{
            return 0;
        }
    }

    public function getUserByStaffId($staffID){

        $stmt = $this->con->prepare("SELECT * FROM staff WHERE staff_ID = ?");
        $stmt->bind_param("s"  , $staffID);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
         
    }




}