<?php
session_start();
include "connection.php";

$rider_name = $_SESSION['name'] ?? '';
if (!$rider_name) {
    echo "<p>No current ride</p>";
    exit;
}

// Query the most recent pending or accepted ride for this rider
$stmt = $conn->prepare("
    SELECT rr.*, d.name AS driver_name, d.brand, d.model, d.color
    FROM ride_requests rr
    LEFT JOIN driver_tbl d ON rr.driver_id = d.driver_id
    WHERE rr.rider_name = ? AND rr.status IN ('pending','accepted')
    ORDER BY rr.created_at DESC
    LIMIT 1
");
$stmt->bind_param("s", $rider_name);
$stmt->execute();
$result = $stmt->get_result();
$ride = $result->fetch_assoc();
$stmt->close();

if (!$ride) {
    echo "<p>No current ride</p>";
    exit;
}

// Display ride status in plain HTML
if ($ride['status'] === 'pending') {
    echo "<p>Your ride request is pending. Waiting for a driver...</p>";
} elseif ($ride['status'] === 'accepted') {
    echo "<p>Driver {$ride['driver_name']} accepted your ride!</p>";
    echo "<p>Vehicle: {$ride['brand']} {$ride['model']} • {$ride['color']}</p>";
    echo "<p>Pickup: {$ride['pickup']}</p>";
    echo "<p>Dropoff: {$ride['dropoff']}</p>";
} else {
    echo "<p>No current ride</p>";
}
?>