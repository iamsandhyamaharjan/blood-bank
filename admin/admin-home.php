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
   
    <main>
        <aside>
            <a href="../admin/admin-home.php"><i class="fas fa-home"></i>Dashboard</a>
            <a href="../admin-donor-management/donor.php"><i class="fas fa-users"></i>Donor Management</a>
            <a href="../admin-recipient-management/recipient.php"><i class="fas fa-users"></i>Recipient Management</a>
            <a href="../admin-donationlist/admin-donationlist.php"><i class="fas fa-list-alt"></i>Donation Lists</a>
            <a href="../admin-requestlist/admin-requestlist.php"><i class="fas fa-list-alt"></i>Request List</a>
            <!-- <a href="#"><i class="fas fa-chart-bar"></i>Reports</a> -->
            <a href="admin-profile.php"><i class="fas fa-cog"></i>Profile</a>
        </aside>


        <div class="content">
          
            <!-- rest of your content goes here -->
        </div>
    </main>

    <?php
        include '../footer/footer.php';
    ?>

</body>
</html>
