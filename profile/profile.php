

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <!-- Add your CSS stylesheets and other header elements -->
</head>
<link rel="stylesheet" type="text/css" href="../header/header.css">
          <link rel="stylesheet" type="text/css" href="content.css">
  <script src="../header/header.js"></script>
  <link rel="stylesheet" type="text/css" href="../footer/footer.css">
  <script src="../footer/footer.js"></script>
<body>
<?php
  // Include file2.php
  include '../header/header.php';
  ?>
<?php
// session_start();
include('../connect.php');

// Check if the user is logged in and the necessary profile information is available
if (isset($_SESSION['admin'])) {
    $username = $_SESSION['admin'];

    // Retrieve additional profile details from the database
    // ...

} elseif (isset($_SESSION['donor'])) {
    $username = $_SESSION['donor'];

    // Retrieve additional profile details from the database
    // ...

} elseif (isset($_SESSION['recipient'])) {
    $username = $_SESSION['recipient'];

    // Retrieve additional profile details from the database
    // ...

} else {
    // Redirect the user to the login page if they are not logged in
    header("Location: login.php");
    exit();
}
?>
    <h1>Welcome, <?php echo $username; ?></h1>
    <!-- Display additional profile details -->
    <?php
  // Include file2.php
  include '../footer copy/footer.php';
  ?> 
</body>
</html>
