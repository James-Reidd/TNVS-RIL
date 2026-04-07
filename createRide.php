<?php
session_start();
include "connection.php";

$data = json_decode(file_get_contents("php://input"), true);

$customer_id = $_SESSION['customer_id'];
$pickup = $data['pickup'];
$dropoff = $data['dropoff'];
$fare = $data['fare'];

$sql = "INSERT INTO rides (customer_id, pickup, dropoff, fare)
        VALUES ('$customer_id', '$pickup', '$dropoff', '$fare')";

$conn->query($sql);

echo json_encode(["status" => "success"]);
?>