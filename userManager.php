<?php

class UserManager{

private $dbManager;

function __construct($db_manager){
    $this->dbManager = $db_manager;
}

private function userExists($user_name, $conn){
    $sql = "SELECT * FROM mikolajkabacinski.users 
            WHERE user_name = '$user_name'";
    $result = $conn->query($sql);
    return ($result->num_rows > 0);
}

private function checkUserAndPasswd($user_name, $user_password, $conn){
    $sql = "SELECT * FROM mikolajkabacinski.users 
            WHERE user_name = '$user_name' AND user_password = '$user_password'";
    $result = $conn->query($sql);
    return ($result->num_rows == 1);
}

private function clearUserLoginEntry($user_name_checked, $conn){
    $sql = "DELETE FROM mikolajkabacinski.loggedusers
            WHERE user_name = '$user_name_checked'";
    return $result = $conn->query($sql);
}

private function insertUserLoginEntry($user_name_checked, $conn){
    $sesion_id = session_id();
    $sql = "INSERT INTO mikolajkabacinski.loggedusers(session_id, user_name)
            VALUES ('$sesion_id', '$user_name_checked')";
    return $result = $conn->query($sql);
}

private function getUserName($session_id, $conn){
    $sql = "SELECT user_name FROM mikolajkabacinski.loggedusers
    WHERE session_id = '$session_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row["user_name"];
}

public function findUserName($session_id, $conn = NULL){
    if($conn === NULL){
        $openedConnection = FALSE;
        $conn = $this->dbManager->openConnection();
    }
    try{
        $session_id_checked = $conn->real_escape_string($session_id);
        $select_query = "SELECT * FROM mikolajkabacinski.loggedusers WHERE session_id = '$session_id_checked'";
        $result = $conn->query($select_query);
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

public function createAccount($user_name, $user_password, $user_password_repeat){
    if($user_name == '' or $user_password == '' or $user_password_repeat == "")
        throw new Exception('Incorrect input data.');
    if($user_password != $user_password_repeat)
        throw new Exception('Passwords are not the same.');      
    $conn = $this->dbManager->openConnection();
    $user_name_checked = $conn->real_escape_string($user_name);
    $user_password_md5 = md5($user_password);
    
    try{
        if($this->userExists($user_name_checked, $conn)){
            return FALSE;
            }
        $insert_query = "INSERT INTO mikolajkabacinski.users(user_name, user_password) 
        VALUES ('$user_name_checked', '$user_password_md5')";
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
    return TRUE;    
}

public function checkIfUserLoggedIn($session_id){
    $conn = $this->dbManager->openConnection();      
    try{
        $session_id_checked = $conn->real_escape_string($session_id);                            
        $select_query = "SELECT * FROM mikolajkabacinski.loggedusers 
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
        $sql = "DELETE FROM mikolajkabacinski.loggedusers 
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
}

public function deleteAccount($user_name){
    $conn = $this->dbManager->openConnection();
    $user_name_checked = $conn->real_escape_string($user_name);
    try{
        $this->clearUserLoginEntry($user_name_checked, $conn);
        $sql = "DELETE FROM mikolajkabacinski.users
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
}  
}
?>