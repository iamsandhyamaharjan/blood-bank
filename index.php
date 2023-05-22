


<!DOCTYPE html>
<html>
<head>
  <title>Responsive Navbar</title>
  <style>
    /* CSS for the navbar */
    body {
      margin: 0;
      padding: 0;
    }
    .navbar {
      background-color: #cf3d3c;
      color: white;
      display: flex;
      align-items: center;
      padding: 10px;
    }
    .navbar-brand {
      font-weight: bold;
      text-decoration: none;
      color: white;
    }
    .blood-logo {
      width: 10%;
      height: auto;
      margin-right: 10px; /* Adjust the margin as needed */
    }
    .navbar-nav {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
    }
    .navbar-nav li {
      margin-right: 10px;
    }
    .navbar-nav li a {
      text-decoration: none;
      color: white;
    }
    .ml-auto {
      margin-left: auto;
      margin-right:500px;
    }
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }
    .modal-content {
      background-color: #f9f9f9;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 50%;
    }
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }
    .dropdown {
      position: relative;
    }
    .dropdown-content {
      position: absolute;
      background-color: #f9f9f9;
      min-width: 120px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
      display: none;
    }
    .dropdown:hover .dropdown-content {
      display: block;
    }
    .dropdown-content a {
      display: block;
      padding: 10px;
      color:black;
    }
  </style>
   <script>
          
    // JavaScript to toggle modal visibility
    function openModal() {
      var modal = document.getElementById("modal");
      modal.style.display = "block";
    }
    function closeModal() {
      var modal = document.getElementById("modal");
      modal.style.display = "none";
    }
    window.onclick = function(event) {
      var modal = document.getElementById("modal");
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
     // JavaScript to toggle dropdown menu visibility
     function toggleDropdown() {
      var dropdownContent = document.getElementById("dropdown-content");
      dropdownContent.style.display = (dropdownContent.style.display === "none") ? "block" : "none";
    }
  </script>
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
            <a href="#"  style="color: black;">Sign Up</a>
            <a href="#"  style="color: black;" onclick="openModal()">Login</a>
          </div>
      </li>
    </ul>
  </div>
  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <form>
        <!-- Your form fields here -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username">
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password">
        <br>
        <input type="submit" value="Login">
      </form>
    </div>
  </div>

</body>
</html>
