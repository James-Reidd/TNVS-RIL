<?php
session_start();
include "connection.php";

$sql = "SELECT * FROM rides WHERE status='pending' ORDER BY created_at DESC";

$result = $conn->query($sql);

$rides = [];

while ($row = $result->fetch_assoc()) {
    $rides[] = $row;
}

echo json_encode($rides);
?>