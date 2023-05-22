


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
  </style>
   <script>
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
      <li><a href="#">Login</a></li>
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
