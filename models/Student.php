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

    public function fetchAll() {
        
        $stmt = $this->conn->prepare('SELECT * FROM students');
        $stmt->execute();
        return $stmt;
    }

    public function fetchOne() {

        $stmt = $this->conn->prepare('SELECT  * FROM students WHERE id = ?');
        $stmt->bindParam(1, $this->id);
        $stmt->execute();        

        if($stmt->rowCount() > 0) {
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->address = $row['address'];
            $this->age = $row['age'];

            return TRUE;

        }
        
        return FALSE;
    }

    public function postData() {

        $stmt = $this->conn->prepare('INSERT INTO students SET name = :name, address = :address, age = :age');

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':age', $this->age);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function putData() {

        $stmt = $this->conn->prepare('UPDATE students SET name = :name, address = :address, age = :age WHERE id = :id');

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function delete() {

        $stmt = $this->conn->prepare('DELETE FROM students WHERE id = :id');
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }


}