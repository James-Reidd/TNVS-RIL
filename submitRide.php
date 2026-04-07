<?php
session_start();
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rider_name = $_SESSION['name']; // rider's name from session
    $pickup = $_POST['pickup'];
    $dropoff = $_POST['dropoff'];
    $distance = $_POST['distance'];
    $fare = $_POST['fare'];

    $stmt = $conn->prepare("INSERT INTO ride_requests (rider_name, pickup, dropoff, distance, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdd", $rider_name, $pickup, $dropoff, $distance, $fare);
    $stmt->execute();
    $stmt->close();

    echo json_encode(["success" => true]);
}
?>