<?php
session_start();

// FIX: Check for driver_id, not customer_id!
if (!isset($_SESSION['driver_id'])) {
    header("Location: Driverlogin.html");
    exit();
}

// Default value before JS kicks in
$driver_status = 'Offline'; 
$checked = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MotoRide Dashboard</title>

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- CSS -->
  <link rel="stylesheet" href="Driverhome.css">
</head>
<body>

  <!-- HEADER -->
  <div class="header">
    <div class="logo">
      <i class="fa-solid fa-motorcycle"></i> MotoRide
    </div>

    <div class="user-actions">
      <span>Hi, <?php echo $_SESSION['name']; ?></span>
        <i class="fa-solid fa-arrow-right-from-bracket"></i> <a href="logout.php" class="logout">Logout</a>
      </span>
    </div>
  </div>

  <!-- MAIN -->
  <div class="container">

    <!-- DRIVER STATUS -->
    <div class="card">
      <h2>Driver Status</h2>
      <p>Toggle your availability to receive ride requests</p>

      <div class="status-header">
      <span id="statusText"><?php echo $driver_status; ?></span>
      <input type="checkbox" id="statusToggle" <?php echo $checked; ?>>
    </div>
  </div>

    <!-- ONLINE CONTENT -->

<div id="onlineContent">
      <!-- RIDE REQUESTS -->
<div class="card">

  <!-- STATS (now inside card, at top) -->
  <div class="stats">
    <div class="stat-box">
      <h2 style="color:#9333ea;">12</h2>
      <p>Total rides</p>
    </div>

    <div class="stat-box">
      <h2 style="color:#16a34a;">₱6967</h2>
      <p>Total earnings</p>
    </div>
  </div>

  <h2>Incoming Ride Requests</h2>
  <p>Accept a ride to get started</p>

        <div id="rideRequests">
        <!-- Ride requests will load here dynamically -->
        </div>

      </div>
    </div>

    <!-- OFFLINE CONTENT -->
    <div id="offlineContent" style="display:none;">
      <div class="card offline">
        <i class="fa-regular fa-user"></i>
        <h2>You're Offline</h2>
        <p>Toggle the switch above to go online and start receiving ride requests.</p>
      </div>
    </div>

  </div> 

  <!-- BOTTOM NAV -->
  <div class="bottom-nav">
    <div class="nav-item active">
      <i class="fa-solid fa-house"></i>
      <span>Home</span>
    </div>

    <div class="nav-item">
      <i class="fa-solid fa-user"></i>
      <a href="Driverprofile.php">Profile</a>
    </div>
  </div>

  <!-- JS -->
  <script src="tite3.js"></script>

</body>
</html>