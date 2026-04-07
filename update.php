<?php
session_start();
include "connection.php";

// ====================================================================
// STEP 1: CHECK ROLE
// ====================================================================
if (!isset($_POST['role'])) {
    echo "Error: Role not provided!";
    exit();
}

$role = $_POST['role'];

// ====================================================================
// STEP 2: VALIDATE SESSION
// ====================================================================
if ($role === "rider") {

    if (!isset($_SESSION['customer_id'])) {
        echo "Not logged in as rider";
        exit();
    }

    $user_id = $_SESSION['customer_id'];
    $table = "customer_tbl";

} elseif ($role === "driver") {

    if (!isset($_SESSION['driver_id'])) {
        echo "Not logged in as driver";
        exit();
    }

    $user_id = $_SESSION['driver_id'];
    $table = "driver_tbl";

} else {
    echo "Invalid role!";
    exit();
}

// ====================================================================
// STEP 3: GET INPUTS (SAFE CHECK)
// ====================================================================
$name = $_POST['name'] ?? '';
$username = $_POST['username'] ?? '';
$contactNo = $_POST['contactNo'] ?? '';

if (empty($name) || empty($username) || empty($contactNo)) {
    echo "Please fill all fields!";
    exit();
}

// ====================================================================
// STEP 4: UPDATE DATABASE (DYNAMIC TABLE)
// ====================================================================
$sql = "UPDATE $table 
        SET name='$name', username='$username', contact_no='$contactNo' 
        WHERE " . ($role === "rider" ? "customer_id" : "driver_id") . " = '$user_id'";

if (mysqli_query($conn, $sql)) {

    // ====================================================================
    // STEP 5: UPDATE SESSION
    // ====================================================================
    $_SESSION['name'] = $name;
    $_SESSION['username'] = $username;
    $_SESSION['contact_no'] = $contactNo;

    echo "Profile updated successfully!";

} else {
    echo "Error updating profile: " . mysqli_error($conn);
}
?>