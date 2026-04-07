<?php
session_start();
include "connection.php";

$driver_id = $_SESSION['driver_id'];

$query = mysqli_query($conn, "SELECT status FROM driver_tbl WHERE id='$driver_id'");
$row = mysqli_fetch_assoc($query);

echo ($row['status'] == 'on') ? "ONLINE" : "OFFLINE";
?>