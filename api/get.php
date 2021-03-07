<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/Student.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $db = new Database();
        $db = $db->connect();

        $student = new Student($db);

        $res = $student->fetchAll();
        $resCount = $res->rowCount();

        if($resCount > 0) {

            $students = array();

            while($row = $res->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                array_push($students, array( 'id' => $id, 'name' => $name, 'address' => $address, 'age' => $age));
            }
            
            echo json_encode($students);

        } else {
            echo json_encode(array('message' => "No records found!"));
        }
    } else {
        echo json_encode(array('message' => "Error: incorrect Method!"));
    }