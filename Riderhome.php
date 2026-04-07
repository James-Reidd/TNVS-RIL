<?php 
session_start(); 

if (!isset($_SESSION['customer_id'])) {
    header("Location: Riderlogin.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="Riderhome.css">

<link href='https://fonts.googleapis.com/css?family=Zen Dots' rel='stylesheet'>

</head>
<body>
    
<!-- HEADER -->
  <div class="header">
    <div class="logo">
      <i data-lucide="bike"></i> MotoRide
    </div>
    <div class="user-actions">
      <span>Hi, <?php echo htmlspecialchars($_SESSION['name']); ?></span>
      <a href="logout.php" class="logout">Logout</a>
    </div>
  </div>

  <!-- MAIN -->
  <div class="container">

  <!-- REQUEST CARD -->
  <div class="card">
    <h2>Request a Ride</h2>
    <p>Enter your pickup and destination</p>

    <div class="input-group">
  <label>Pickup Location</label>
  <select id="pickup">
    <option disabled selected value="">Select pickup</option>
    <option value="Cubao">Cubao</option>
    <option value="Marikina">Marikina</option>
    <option value="Manila">Manila</option>
    <option value="Makati">Makati</option>
    <option value="Taguig">Taguig</option>
    <option value="Caloocan">Caloocan</option>
  </select>
</div>

<div class="input-group">
  <label>Dropoff Location</label>
  <select id="dropoff">
    <option disabled selected value="">Select dropoff</option>
    <option value="Cubao">Cubao</option>
    <option value="Marikina">Marikina</option>
    <option value="Manila">Manila</option>
    <option value="Makati">Makati</option>
    <option value="Taguig">Taguig</option>
    <option value="Caloocan">Caloocan</option>
  </select>
</div>

    <button class="btn" onclick="calculateFare()">Find Available Drivers</button>
  </div>

  <!-- ✅ MOVE PANEL OUTSIDE CARD -->
  <div id="driversPanel" class="drivers-panel hidden">
  <h3>Available Drivers Nearby</h3>
  <p class="subtitle">Choose your preferred driver</p>

  <div id="driversList"></div>
</div>

</div>

  <!-- BOTTOM NAV -->
  <div class="bottom-nav">
    <div class="nav-item active">
      Home
    </div>

    <div class="nav-item">
      <a href="Riderprofile.php">Profile</a>
    </div>

  </div> 

  <script src="tite.js"></script>
</body>
</html>