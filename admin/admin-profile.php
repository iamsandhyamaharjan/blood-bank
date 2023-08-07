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

        <!-- link to font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

        <title>Blood Bank Management System</title>
        
</head>
<body>

    <?php
        include '../admin/admin-header.php';
        
if (isset($_SESSION['admin'])) {
    $username = $_SESSION['admin'];

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
                  $updateQuery = $db->prepare("UPDATE admin SET Name = :name, Password = :password WHERE id=:id"  );
                  $_SESSION['donor']= $newName;
               } else {
                  $updateQuery = $db->prepare("UPDATE admin SET name = :name, address = :address, age = :age, contact = :contact WHERE id=:id");
              }
      
              $updateQuery->bindParam(':name', $newName);
              $updateQuery->bindParam(':password', $newPassword);
              $updateQuery->bindParam(':id', $id);
              $updateQuery->execute();
      
              // Redirect the user back to the profile page
              // header("Location: profile.php");
              exit();
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
    <h1>Welcome, </h1>
<h2>Profile Information</h2>
<form action="profile.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>">
    <br>
    <label for="address">Password:</label>
    <input type="text" id="address" name="address" value="<?php echo $address; ?>">
   
    <br>
    <!-- Add more fields as necessary for the profile editing form -->
    <input type="submit" name="submit1" value="Update">
</form>

    </div>

    </main>
   
    <?php
         include '../footer/footer.php';
    ?>

</body>
</html>