<?php

class DBManager{
    // members
    private $db_servername;
    private $db_username;
    private $db_password;

    // functions
    function __construct($db_servername, $db_username, $db_password){
        $this->db_servername = $db_servername;
        $this->db_username = $db_username;
        $this->db_password = $db_password;
    }

    public function openConnection(){
        return new mysqli($this->db_servername, $this->db_username, $this->db_password);
    }

    private function closeConnection($conn){
        $conn->close();
    }

    public function checkConnection($conn){
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }

    public function recreateDB(){
        $conn = $this->openConnection();
        // drop database
        $sql = "DROP DATABASE zaipw";
        if ($conn->query($sql) === TRUE) {
            echo "Database dropped successfully"."<br>";
        } else {
            echo "Error dropping database: " . $conn->error."<br>";
        }
    
        // Create database
        $sql = "CREATE DATABASE zaipw";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully"."<br>";
        } else {
            echo "Error creating database: " . $conn->error."<br>";
        }
    
        // create tables
        $sql = "CREATE TABLE zaipw.users_ (
        user_id integer unsigned auto_increment primary key,
        user_name varchar(50) not null,
        user_password varchar(50) not null,
        user_email varchar(50) not null
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Table users created successfully"."<br>";
        } else {
            echo "Error creating table: " . $conn->error."<br>";
        }
        
        $sql = "CREATE TABLE zaipw.loggedusers_ (
        session_id varchar(100) primary key,
        user_name varchar(50) not null
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Table loggedusers created successfully"."<br>";
        } else {
            echo "Error creating table: " . $conn->error."<br>";
        }

        $sql = "CREATE TABLE zaipw.text_fields_ (
        text_field_id integer unsigned auto_increment primary key,
        text_field varchar(500) not null
        )";
            
        if ($conn->query($sql) === TRUE) {
            echo "Table text_fields created successfully"."<br>";
        } else {
            echo "Error creating table: " . $conn->error."<br>";
        }
    
        for ($x = 0; $x < 60; $x++) {

            $sql1 = "INSERT INTO zaipw.text_fields_(text_field)
                    VALUES ('Place your task title here')";
            $sql2 = "INSERT INTO zaipw.text_fields_(text_field)
                    VALUES ('Place your task summary here. Place your task summary here. Place your task summary here. Place your task summary here. Place your task summary here. Place your task summary here. Place your task summary here. Place your task summary here. Place your task summary here. Place your task summary here. Place your task summary here. Place your task summary here.')";

            if (($x % 2)==0){
                
                $result = $conn->query($sql1);
            }
            else{
                $result = $conn->query($sql2);
            }
            
            if($result === FALSE)
                echo "Failure";
            else
                echo "Success";
        }
        $conn->close();
    }
}

?>


