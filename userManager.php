<?php

class UserManager{

private $dbManager;

function __construct($db_manager){
    $this->dbManager = $db_manager;
}

private function userExists($user_name, $conn){
    $sql = "SELECT * FROM zaipw.users_ 
            WHERE user_name = '$user_name'";
    $result = $conn->query($sql);
    return ($result->num_rows > 0);
}

private function checkUserAndPasswd($user_name, $user_password, $conn){
    $sql = "SELECT * FROM zaipw.users_ 
            WHERE user_name = '$user_name' AND user_password = '$user_password'";
    $result = $conn->query($sql);
    return ($result->num_rows == 1);
}

private function clearUserLoginEntry($user_name_checked, $conn){
    $sql = "DELETE FROM zaipw.loggedusers_
            WHERE user_name = '$user_name_checked'";
    return $result = $conn->query($sql);
}

private function insertUserLoginEntry($user_name_checked, $conn){
    $sesion_id = session_id();
    $sql = "INSERT INTO zaipw.loggedusers_(session_id, user_name)
            VALUES ('$sesion_id', '$user_name_checked')";
    return $result = $conn->query($sql);
}

private function getUserName($session_id, $conn){
    $sql = "SELECT user_name FROM zaipw.loggedusers_
    WHERE session_id = '$session_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row["user_name"];
}

public function readTextField($text_field_id){
    $conn = $this->dbManager->openConnection();
    $sql = "SELECT * FROM zaipw.text_fields_ 
            WHERE text_field_id = $text_field_id";
    $result = $conn->query($sql);
    if($result === FALSE)
        throw new Exception('SQL query cannot be executed.');
    if(($row = $result->fetch_assoc()) === NULL)
        echo "no data"; 
    return $row["text_field"];
}

public function writeTextField($text_field_id, $text){
    $conn = $this->dbManager->openConnection();
    $text_checked = $conn->real_escape_string($text);
    $sql = "UPDATE zaipw.text_fields_
            SET text_field = '$text'
            WHERE text_field_id = $text_field_id";
    $result = $conn->query($sql);
    if($result === FALSE)
        throw new Exception('SQL query cannot be executed.');
    return TRUE;
}

public function findUserName($session_id, $conn = NULL){
    if($conn === NULL){
        $openedConnection = FALSE;
        $conn = $this->dbManager->openConnection();
    }
    try{
        $session_id_checked = $conn->real_escape_string($session_id);
        $sql = "SELECT * FROM zaipw.loggedusers_ WHERE session_id = '$session_id_checked'";
        $result = $conn->query($sql);
        if($result === FALSE)
            throw new Exception('SQL query cannot be executed.');
        if(($row = $result->fetch_assoc()) === NULL)
            $user_name = "";
        else{
            $user_name = $row["user_name"];
        }
    }
    catch(Exception $e){
        if(isset($conn) and isset($openedConnection))
            $conn->close();
        throw $e;
    }
    if(isset($openedConnection))
        $conn->close();
    return  $user_name;
}

public function createAccount($user_name, $user_password, $user_password_repeat, $email){
    if($user_name == '' or $user_password == '' or $user_password_repeat == "" or $email == '')
        throw new Exception('Incorrect input data.');
    if($user_password != $user_password_repeat)
        throw new Exception('Passwords are not the same.');      
    $conn = $this->dbManager->openConnection();
    $user_name_checked = $conn->real_escape_string($user_name);
    $email_checked = $conn->real_escape_string($email);
    $user_password_md5 = md5($user_password);
    
    try{
        if($this->userExists($user_name_checked, $conn)){
            // echo "Account of user " . $user_name ." already exists. New account will not be created."."<br>";
            return FALSE;
            }
        $insert_query = "INSERT INTO zaipw.users_(user_name, user_password, user_email) 
        VALUES ('$user_name_checked', '$user_password_md5', '$email_checked')";
        $result = $conn->query($insert_query);
        if($result === FALSE)
            throw new Exception('Data base query cannot be executed.');
    }      

    catch(Exception $e){                    
        if(isset($conn))
        $conn->close();
            throw $e;      
    }
    $conn->close();
    // echo "Created account for user " . $user_name ."<br>";
    return TRUE;
}

public function login($user_name, $user_password){
    if($user_name == '' or $user_password == '')        
        throw new Exception('Incorrect input data.');              
    $conn = $this->dbManager->openConnection();               

    $user_password_md5 = md5($user_password);  
    if($this->checkUserAndPasswd($user_name, $user_password_md5, $conn)===FALSE){          
        if(isset($conn))       
            $conn->close();
        // echo "Username or password of user " . $user_name ." is incorrect. Login aborted."."<br>";
        return FALSE;
    }

    $user_name_checked = $conn->real_escape_string($user_name);
    try{
        $this->clearUserLoginEntry($user_name_checked, $conn);              
        $this->insertUserLoginEntry($user_name_checked, $conn);      
        }
    catch(Exception $e){                 
        if(isset($conn))            
        $conn->close();          
        throw $e;      
    }

    $conn->close();
    // echo "User " . $user_name ." was logged in."."<br>";     
    return TRUE;    
}

public function checkIfUserLoggedIn($session_id){
    $conn = $this->dbManager->openConnection();      
    try{
        $session_id_checked = $conn->real_escape_string($session_id);                            
        $select_query = "SELECT * FROM zaipw.loggedusers_ 
                        WHERE session_id = '$session_id_checked'";        
        $result = $conn->query($select_query);        
        if($result === FALSE)          
            throw new Exception('Data base query cannot be executed.');                
        
        if(($row = $result->fetch_assoc()) === NULL)          
            $login_check = FALSE;
        else{          
            $login_check = TRUE;      
        }                          
    }
    catch(Exception $e){                    
        if(isset($conn))            
        $conn->close();          
        throw $e;      
    }  
    $conn->close();      
    return $login_check;    
}    

public function logout($conn = NULL){
    if($conn === NULL){
        $openedConnection = FALSE;
        $conn = $this->dbManager->openConnection();
    }
    try{
        $sessionid = session_id();
        $user_name = $this->getUserName($sessionid, $conn);
        $sql = "DELETE FROM zaipw.loggedusers_ 
                WHERE session_id = '$sessionid'";
        $result = $conn->query($sql);                
        if($result === FALSE)
            throw new Exception('Data base query cannot be executed.');                
    }
    catch(Exception $e){
        if(isset($conn) and isset($openedConnection))
        $conn->close();
        throw $e;
    }
    if(isset($openedConnection))
    $conn->close();
    // echo "User " . $user_name ." was logged out."."<br>";
}

public function deleteAccount($user_name){
    $conn = $this->dbManager->openConnection();
    $user_name_checked = $conn->real_escape_string($user_name);
    try{
        $this->clearUserLoginEntry($user_name_checked, $conn);
        $sql = "DELETE FROM zaipw.users_
                WHERE user_name = '$user_name_checked'";
        $result = $conn->query($sql);
        if($result === FALSE)
            throw new Exception('Data base query cannot be executed.');
    } catch(Exception $e){
        if(isset($conn))
            $conn->close();
        throw $e;
    }
    $conn->close();
    // echo "User account of " . $user_name ." was removed."."<br>";
}  
}
?>