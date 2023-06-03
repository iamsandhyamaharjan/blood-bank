 <?php

include('../connect.php')
?> 


<!DOCTYPE html>
<html>
<head>
  <title>Responsive Navbar</title>
  <link rel="stylesheet" type="text/css" href="header.css">
  <script src="header.js"></script>

</head>
<body>

  <div class="navbar">
    <div>

      <ul class="navbar-nav">
      <img class="blood-logo" src="https://assets.rumsan.com/esatya/hlb-navbar-logo.png">
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
      </ul>
    </div>
    <ul class="navbar-nav ml-auto">
      <li><a href="#" onclick="openModal()">Admin</a></li>
      <li class="dropdown">
      <a href="#" onclick="toggleDropdown()">User</a>
      <div id="dropdown-content" class="dropdown-content">
            <a href="#"  style="color: black;"onclick="openSignModal()">Sign Up</a>
            <a href="#"  style="color: black;" onclick="openModal()">Login</a>
          </div>
      </li>
    </ul>
  </div>
  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <form action="" method="post">
        <!-- Your form fields here -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username">
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password">
        <br>
        <input type="submit" name="submit" value="Login">
      </form>
      <?php
if(isset($_POST['submit']))
{
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Prepare the query using parameterized statements to avoid SQL injection
  $q = $db->prepare("SELECT * FROM admin WHERE uname=:username AND pass=:password");
  $q->bindParam(':username', $username);
  $q->bindParam(':password', $password);
  $q->execute();

  // Fetch the result
  $res = $q->fetchAll(PDO::FETCH_OBJ);

  if ($res) {
    echo "<script>window.location.href = '../admin/admin-home.php';</script>";
    // header('Location: ../admin/admin-home.php');
    exit(); // Make sure to exit after redirecting
  } else {
    echo "<script>alert('Wrong user');</script>";
  }
}
?>
</div>
</div>
<div id="smodal" class="smodal">
    <div class="smodal-content">
      <span class="close" onclick="closeModal()">&times;</span>
    
    <form action="#" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" placeholder="Enter your name">
      <br>
      <label for="address">Address:</label>
      <input type="text" id="address" name="address" placeholder="Enter your address">
      <br>
      <label for="age">Age:</label>
      <input type="number" id="age" name="age" placeholder="Enter your age">
      <br>
      <label for="contact">Contact:</label>
      <input type="text" id="contact" name="contact" placeholder="Enter your contact number">
      <br>
      <label for="role">Role:</label>
      <select id="role" name="role">
        <option value="donor">Donor</option>
        <option value="recipient">Recipient</option>
      </select>
      <br>
      <input type="submit" name="signup" value="Sign Up">
    </form>
  

    
</div>
</div>


</body>
</html>
