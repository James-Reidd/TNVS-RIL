<?php
$conn = new mysqli("localhost", "root", "", "tnvs");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only get ONLINE drivers
$sql = "SELECT name, rating, vehicle, color FROM drivers WHERE status='online'";

$result = $conn->query($sql);

$drivers = [];

while ($row = $result->fetch_assoc()) {
    $drivers[] = $row;
}

// Return JSON
echo json_encode($drivers);

$conn->close();
?>

