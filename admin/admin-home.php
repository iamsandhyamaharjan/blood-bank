<!DOCTYPE html>
<html>
<head>
    <title>Blood Bank Management System</title>
    <link rel="stylesheet" type="text/css" href="admin-home.css">
    <script src="admin-home.js"></script>
    
    <!-- link to blood donation css -->
    <link rel="stylesheet" type="text/css" href="blood-donate-list.css">

    <!-- link to admin-home css -->
    <link rel="stylesheet" href="admin-header.css">

    <!-- link to footer css -->
    <link rel="stylesheet" type="text/css" href="../footer/footer.css">

    <!-- link to font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>

    <?php
        include 'admin-header.php';
    ?>
    <?php
   include('../connect.php');

//<?php
$db = new PDO('mysql:host=localhost;dbname=bbms', 'root', '');

// Check if the connection is successful
if (!$db) {
    die('Failed to connect to the database.');
}

// Fetch data from tables
$donorCountQuery = "SELECT COUNT(*) AS donor_count FROM donors";
$recipientCountQuery = "SELECT COUNT(*) AS recipient_count FROM recipient";
$bloodAvailableQuery = "SELECT COUNT(*) AS blood_available FROM blood";
$requestCountQuery = "SELECT COUNT(*) AS request_count FROM request";
$donationCountQuery = "SELECT COUNT(*) AS donation_count FROM donation";

$donorResult = $db->query($donorCountQuery)->fetch(PDO::FETCH_ASSOC);
$recipientResult = $db->query($recipientCountQuery)->fetch(PDO::FETCH_ASSOC);
$bloodAvailableResult = $db->query($bloodAvailableQuery)->fetch(PDO::FETCH_ASSOC);
$requestResult = $db->query($requestCountQuery)->fetch(PDO::FETCH_ASSOC);
$donationResult = $db->query($donationCountQuery)->fetch(PDO::FETCH_ASSOC);

// Extract data
$donorCount = $donorResult['donor_count'];
$recipientCount = $recipientResult['recipient_count'];
$bloodAvailable = $bloodAvailableResult['blood_available'];
$requestCount = $requestResult['request_count'];
$donationCount = $donationResult['donation_count'];

// Close the database connection
$db = null;
?>



    <main>
        <aside>
            <a href="../admin/admin-home.php"><i class="fas fa-home"></i>Dashboard</a>
            <a href="../admin-donor-management/donor.php"><i class="fas fa-users"></i>Donor Management</a>
            <a href="../admin-recipient-management/recipient.php"><i class="fas fa-users"></i>Recipient Management</a>
            <a href="../admin-donationlist/admin-donationlist.php"><i class="fas fa-list-alt"></i>Donation Lists</a>
            <a href="../admin-requestlist/admin-requestlist.php"><i class="fas fa-list-alt"></i>Request List</a>
            <a href="../admin-bloodlist/admin-bloodlist.php"><i class="fas fa-list-alt"></i>Blood List</a>
            <!-- <a href="#"><i class="fas fa-chart-bar"></i>Reports</a> -->
            <a href="admin-profile.php"><i class="fas fa-cog"></i>Profile</a>
        </aside>


        <div class="content">
          
        <div class="dashboard-box">
        
        <div class="box">
            <h2>Number of Donors</h2>
            <p><?php echo $donorCount; ?></p>
        </div>
        <div class="box">
            <h2>Number of Recipients</h2>
            <p><?php echo $recipientCount; ?></p>
        </div>
</div>
<div class="dashboard-box">
        <div class="box">
            <h2>Number of Blood Available</h2>
            <p><?php echo $bloodAvailable; ?></p>
        </div>
        <div class="box">
            <h2>Number of Requests</h2>
            <p><?php echo $requestCount; ?></p>
        </div>
        <div class="box">
            <h2>Number of Donations</h2>
            <p><?php echo $donationCount; ?></p>
        </div>
    </div>
        </div>
    </main>

    <?php
        include '../footer/footer.php';
    ?>

</body>
</html>
