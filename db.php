<?php

$host = "localhost";
$user = "root";
$password = "";
$dbName = "propelrr_exam";

try {

    $conn = new PDO("mysql:host=$host;dbname=$dbName", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    echo "Connection failed " . $e->getMessage();
}
