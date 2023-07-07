
<!DOCTYPE html>
<html>

<head>
  <title>Responsive Navbar</title>
  <link rel="stylesheet" href="index.css">
 
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

  <header>
    <div class="logo">
      <img class="blood-logo" src="https://assets.rumsan.com/esatya/hlb-navbar-logo.png">
    </div>
    <nav>
      <a href="#">Home</a>
      <a href="#">About Us</a>
    </nav>
    <div class="user">
      <a href="#" onclick="openModal()">Admin</a>
      <a href="#">Login</a>
    </div>
  </header>

  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <form>
        <!-- Your form fields here -->
        <label for="username"></label>
        <input type="text" id="username" name="username" placeholder="Username">
        <br>
        <label for="password"></label>
        <input type="password" id="password" name="password" placeholder="Password">
        <br>
        <input type="submit" value="Login">
      </form>
    </div>
  </div>

</body>

</html>
