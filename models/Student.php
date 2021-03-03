<?php

class Student {

    private $conn;
    
    public $id;
    public $name;
    public $address;
    public $age;

    public function __construct($db){
        $this->conn = $db;
    }

    public function get() {
        
        $stmt = $this->conn->prepare('SELECT * FROM students');
        $stmt->execute();
        return $stmt;
    }


}