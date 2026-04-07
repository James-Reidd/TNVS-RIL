<?php
session_start();
include 'connection.php'; // Must set $conn

if (!isset($_SESSION['driver_id'])) {
    echo "Not logged in";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    $status = $_POST['status']; // Online/Offline
    $driver_id = $_SESSION['driver_id'];

    // Prepare statement
    $stmt = $conn->prepare("UPDATE driver_tbl SET status = ? WHERE driver_id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!$stmt->bind_param("si", $status, $driver_id)) {
        die("Bind failed: " . $stmt->error);
    }

    if ($stmt->execute()) {
        echo "Status updated to $status";
    } else {
        echo "Update failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No status provided or wrong request method";
}
?>