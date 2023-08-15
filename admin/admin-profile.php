<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- link to admin-home js -->
        <script src="../admin/admin-home.js"></script>
        
        <!-- link to admin-home css -->
        <link rel="stylesheet" type="text/css" href="../admin/admin-home.css">

        <!-- link to footer css -->
        <link rel="stylesheet" type="text/css" href="../footer/footer.css">

        <!-- link to donationlist css --> 
        <link rel="stylesheet" type="text/css" href="admin-donationlist.css">
        <link rel="stylesheet" type="text/css" href="../profile/profile.css">

        <!-- link to font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

        <title>Blood Bank Management System</title>
        
</head>
<body>

    <?php
        include '../admin/admin-header.php';
        include('../connect.php');
        session_start();
        // var_dump($_SESSION);    
if (isset($_SESSION['admin'])) {
    $username = $_SESSION['admin'];
    error_log($username) ;
    $query = $db->prepare("SELECT * FROM admin WHERE uname = :username");
    $query->bindParam(':username', $username);
    $query->execute();
    $profile = $query->fetch(PDO::FETCH_ASSOC);

    // Store the profile details in variables
    $name = $profile['uname'];
    $pass = $profile['pass'];
    $id =$profile['id'];

    // Retrieve additional profile details from the database
    // ...

}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          if (isset($_POST['submit1'])) {
              // Get the updated values from the form
              $newName = $_POST['name'];
              $newPassword = $_POST['password'];
             
      
              // Update the profile data in the database based on the user type
              if (isset($_SESSION['admin'])) {
                  $updateQuery = $db->prepare("UPDATE admin SET uname = :newName, pass = :newPassword WHERE id=:id"  );
                  $_SESSION['admin']= $newName;
               } else {
                 
              }
      
              $updateQuery->bindParam(':newName', $newName);
              $updateQuery->bindParam(':newPassword', $newPassword);
              $updateQuery->bindParam(':id', $id);
              $updateQuery->execute();
      
              // Redirect the user back to the profile page
              header("Location: admin-profile.php");
              
          }
      }
    ?>

    <main>
        <aside>
            <a href="../admin/admin-home.php"><i class="fas fa-home"></i>Dashboard</a>
            <a href="../admin-donor-management/donor.php"><i class="fas fa-users"></i>Donor Management</a>
            <a href="../admin-recipient-management/recipient.php"><i class="fas fa-users"></i>Recipient Management</a>
            <a href="../admin-donationlist/admin-donationlist.php"><i class="fas fa-list-alt"></i>Donation Lists</a>
            <a href="../admin-requestlist/admin-requestlist.php"><i class="fas fa-list-alt"></i>Request List</a>
            <a href="admin-profile.php"><i class="fas fa-cog"></i>Profile</a>
        </aside>

        <div class="content">
        <h1 class="welcome-message">Welcome, <?php echo $name; ?></h1>
<h2 class="profile-heading">Profile Information</h2>
<form action="admin-profile.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>">
    <br>
    <label for="address">Password:</label>
    <input type="text" id="password" name="password" value="<?php echo $pass; ?>">
   
    <br>
    <!-- Add more fields as necessary for the profile editing form -->
    <input style="background-color: #cf3d3c; color: white;" id="admin-profile" type="button" name="submit1" value="Update">
</form>

    </div>

    </main>
   
    <?php
         include '../footer/footer.php';
    ?>

</body>
</html>