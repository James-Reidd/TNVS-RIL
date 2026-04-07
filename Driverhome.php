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
      <span class="logout">
      <a href="logout.php">
          <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
        </a>
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

        <!-- RIDE 1 -->
        <div class="ride">
          <div class="ride-header">
            <strong>Sarah Williams</strong>
            <span class="price">₱150</span>
          </div>

          <p>8 min • 2.3 km</p>
          <p>Pickup: 350 5th Ave</p>
          <p>Dropoff: Central Park</p>

          <div class="ride-actions">
            <button class="btn">Accept Ride</button>
            <button class="decline-btn">Decline</button>
          </div>
        </div>

        <!-- RIDE 2 -->
        <div class="ride">
          <div class="ride-header">
            <strong>Michael Brown</strong>
            <span class="price">₱220</span>
          </div>

          <p>15 min • 4.1 km</p>
          <p>Pickup: Penn Station</p>
          <p>Dropoff: Brooklyn Bridge</p>

          <div class="ride-actions">
            <button class="btn">Accept Ride</button>
            <button class="decline-btn">Decline</button>
          </div>
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