<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../config/Database.php';
    include_once '../models/Student.php';

    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

		$db = new Database();
		$db = $db->connect();

		$student = new Student($db);

		$data = json_decode(file_get_contents("php://input"));

		$student->id = isset($data->id) ? $data->id : NULL;
		$student->name = $data->name;
		$student->address = $data->address;
		$student->age = $data->age;

		if(! is_null($student->id)) {

			if($student->putData()) {
			echo json_encode(array('message' => 'Student updated'));
			} else {
			echo json_encode(array('message' => 'Student Not updated, try again!'));
			}
		} else {
		echo json_encode(array('message' => "Error: Student ID is missing!"));
		}
	} else {
		echo json_encode(array('message' => "Error: incorrect Method!"));
	}