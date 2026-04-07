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
      <span>
      <span>Hi, <?php echo $_SESSION['name']; ?></span>
      <a href="logout.php" class="logout">Logout</a>
      </span>
    </div>
  </div>

  <!-- PROFILE CONTENT -->
  <div class="container column">

    <!-- PERSONAL INFO -->
    <div class="card">
      <h3>Personal Information</h3>
      <p class="subtitle">Manage your account details</p>

      <div class="input-group">
        <label>Full Name</label>
        <input type="text" id="name" value="<?php echo htmlspecialchars($_SESSION['name']); ?>">
      </div>

      <div class="input-group">
        <label>Username</label>
        <input type="email" id="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
      </div>

      <div class="input-group">
        <label>Phone Number</label>
        <input type="text" id="contactNo" value="<?php echo htmlspecialchars($_SESSION['contact_no']); ?>">
      </div>

      <button class="btn" id="saveChangesBtn" onclick="updateRider()">Save Changes</button>
      <p id="status" class="status"></p>
    </div>

  </div>

  <!-- BOTTOM NAV  -->
  <div class="bottom-nav">
    <div class="nav-item" >
     <a href="Riderhome.php">Home</a>
    </div>

    <div class="nav-item active">
      Profile
    </div>
  </div>
<script src="updateProfile.js"></script>
</body>
</html>