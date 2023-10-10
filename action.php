<?php

include('db.php');

$action = (isset($_GET['action'])) ? $_GET['action'] : "";

if ($action != "") {
    switch ($action) {
        case 'saveInfo':
            $result = array();

            $fullName = isset($_POST['fullName']) ? trim($_POST['fullName']) : NULL;
            $email = isset($_POST['email']) ? trim($_POST['email']) : NULL;
            $mobileNo = isset($_POST['mobileNumber']) ? trim($_POST['mobileNumber']) : NULL;
            $birthDate = isset($_POST['bday']) ? date('Y-m-d', strtotime($_POST['bday'])) : NULL;
            $gender = isset($_POST['gender']) ? trim($_POST['gender']) : NULL;
            $dateAdded = date('Y-m-d H:i:s');

            $validation = true;
            //validations
            $errorMessage = [];
            if (!preg_match("/^[a-zA-Z., ]+$/", $fullName)) {
                $validation = false;
                $errorMessage[] = "Please enter valid name.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validation = false;
                $errorMessage[] = "Please enter valid email.";
            }

            if (preg_match("/^[^0-9]/", $mobileNo)) {
                $validation = false;
                $errorMessage[] = "Please enter valid mobile number.";
            } else {
                $firstTwo = substr($mobileNo, 0, 2);
                if ($firstTwo != "09") {
                    $validation = false;
                    $errorMessage[] = "Please enter valid mobile number.";
                }

                if (strlen($mobileNo) < 11) {
                    $validation = false;
                    $errorMessage[] = "Please enter valid mobile number.";
                }
            }

            if ($validation) {
                $query = "INSERT INTO profile (full_name,email,mobile_no,birthdate,gender,date_added) VALUES (:fullName,:email,:mobileNo,:birthDate,:gender,:dateAdded)";
                $insert = $conn->prepare($query);
                $data = [
                    ':fullName' => $fullName,
                    ':email' => $email,
                    ':mobileNo' => $mobileNo,
                    ':birthDate' => $birthDate,
                    ':gender' => $gender,
                    ':dateAdded' => $dateAdded
                ];
                $execute = $insert->execute($data);

                if ($execute) {
                    $result['success'] = true;
                } else {
                    $result['success'] = false;
                    $result['msg'] = "Something went wrong. Please try again!";
                }
            } else {
                $result['success'] = false;
                $result['msg'] = implode('\n', $errorMessage);
            }

            echo json_encode($result);
            break;

        default:
            # code...
            break;
    }
}
