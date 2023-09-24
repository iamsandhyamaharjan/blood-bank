<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../header/header.css">
  <link rel="stylesheet" type="text/css" href="content.css">
  <script src="../header/header.js"></script>
  <script src="../footer/footer.js"></script>
  <link rel="stylesheet" href="../footer/footer.css">
  <title>Document</title>
</head>

  <?php
  // Include file2.php
    include '../header/header.php';

    // var_dump($_SESSION);    
if (isset($_SESSION['donor'])) {
$username = $_SESSION['donor'];
error_log($username) ;
$query = $db->prepare("SELECT * FROM donors WHERE Name = :username");
$query->bindParam(':username', $username);
$query->execute();
$profile = $query->fetch(PDO::FETCH_ASSOC);

// Store the profile details in variables
$name = $profile['Name'];

// Retrieve additional profile details from the database
// ...
}
  ?>
<h1>  Welcome <?php echo $name ;?></h1>
 
<div id="content"></div>
 <?php
  // Include file2.php
    include '../footer/footer.php';
  ?> 
</body>
</html>