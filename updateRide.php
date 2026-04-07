<?php
session_start();
include "connection.php";

$data = json_decode(file_get_contents("php://input"), true);

$ride_id = $data['ride_id'];
$status = $data['status'];
$driver_id = $_SESSION['driver_id'];

$sql = "UPDATE rides 
        SET status='$status', driver_id='$driver_id' 
        WHERE id='$ride_id'";

$conn->query($sql);

echo json_encode(["status" => "updated"]);
?>