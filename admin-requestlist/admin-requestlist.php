<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" type="text/css" href="../admin/admin-home.css">
  <script src="../admin/admin-home.js"></script>
          <title>Document</title>
</head>
<body>


</body>
</html><!DOCTYPE html>
<html>
<head>
    <title>Blood Bank Management System</title>
    <link rel="stylesheet" type="text/css" href="admin-home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="admin-home.js"></script>
</head>
<body>
<div class="header">
<img class="blood-logo" src="https://assets.rumsan.com/esatya/hlb-navbar-logo.png">
        <h1>Blood Bank Management System</h1>
        <h1> <a href="../logout/logout.php" >Logout</a></li></h1>
    </div>
    <div class=body1 >
    <div class="sidebar">
    <ul>
            <li><a href="../admin/admin-home.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="../admin-donor-management/donor.php"><i class="fas fa-users"></i> Donor Management</a></li>
            <li><a href="../admin-recipient-management/recipient.php"><i class="fas fa-users"></i> Recipient Management</a></li>
            <li><a href="../admin-donationlist/admin-donationlist.php"><i class="fas fa-list-alt"></i> Donation Lists</a></li>
            <li><a href="../admin-requestlist/admin-requestlist.php"><i class="fas fa-list-alt"></i> Request List</a></li>
           
            <li><a href="#"><i class="fas fa-chart-bar"></i> Reports</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>
    </div>


    <div class="content">
    
    <?php
// Include file2.php
// include '../header/header.php';
include('../connect.php');

// Retrieve blood requests from the database
try {
    // Assuming you have a valid PDO database connection ($db)
    $query = $db->query("SELECT * FROM request");
    $bloodRequests = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

    <h2>Requested Blood List</h2>
   
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Blood Type</th>
                <th>Contact</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bloodRequests as $request) : ?>
                <tr>
                    <td><?php echo $request['Name']; ?></td>
                    <td><?php echo $request['BloodGroup']; ?></td>
                    <td><?php echo $request['Contact']; ?></td>
                    <td>
                        <form method="POST" action="donate.php">
                            <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                            <input type="submit" value="Donate">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <div >

</body>
</html>
