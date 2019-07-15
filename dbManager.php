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
        $sql = "DROP DATABASE DB";
        if ($conn->query($sql) === TRUE) {
            echo "Database dropped successfully"."<br>";
        } else {
            echo "Error dropping database: " . $conn->error."<br>";
        }
    
        // Create database
        $sql = "CREATE DATABASE DB";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully"."<br>";
        } else {
            echo "Error creating database: " . $conn->error."<br>";
        }
    
        // create tables
        $sql = "CREATE TABLE mikolajkabacinski.users (
        user_id integer unsigned auto_increment primary key,
        user_name varchar(50) not null,
        user_password varchar(50) not null
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Table users created successfully"."<br>";
        } else {
            echo "Error creating table: " . $conn->error."<br>";
        }
        
        $sql = "CREATE TABLE mikolajkabacinski.loggedusers (
        session_id varchar(100) primary key,
        user_name varchar(50) not null
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Table loggedusers created successfully"."<br>";
        } else {
            echo "Error creating table: " . $conn->error."<br>";
        }
    
        $conn->close();
    }
}

?>