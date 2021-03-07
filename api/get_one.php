<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/Student.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $db = new Database();
        $db = $db->connect();

        $student = new Student($db);

        $data = json_decode(file_get_contents("php://input"));

        if(isset($data->id)) {
            $student->id = $data->id;

            if($student->fetchOne()) {

                print_r(json_encode(array(
                    'id' => $student->id,
                    'name' => $student->name,
                    'address' => $student->address,
                    'age' => $student->age
                )));

            } else {
                echo json_encode(array('message' => "No records found!"));
            }

        } else {
            echo json_encode(array('message' => "Error: Student ID is missing!"));
        }
    } else {
        echo json_encode(array('message' => "Error: incorrect Method!"));
    }