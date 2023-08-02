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
    ?>

    <main>
        <aside>
            <a href="../admin/admin-home.php"><i class="fas fa-home"></i>Dashboard</a>
            <a href="../admin-donor-management/donor.php"><i class="fas fa-users"></i>Donor Management</a>
            <a href="../admin-recipient-management/recipient.php"><i class="fas fa-users"></i>Recipient Management</a>
            <a href="../admin-donationlist/admin-donationlist.php"><i class="fas fa-list-alt"></i>Donation Lists</a>
            <a href="../admin-requestlist/admin-requestlist.php"><i class="fas fa-list-alt"></i>Request List</a>
            <a href="#"><i class="fas fa-chart-bar"></i>Reports</a>
            <a href="#"><i class="fas fa-cog"></i>Settings</a>
        </aside>

        <div class="content">

            <div class="button-container">
                <button onclick="createDonor()">Donated Blood Lists</button>
            </div>

            <?php
                // Include file2.php
                // include '../header/header.php';
                include('../connect.php');
                // Retrieve blood requests from the database
                try {
                // Assuming you have a valid PDO database connection ($db)
                $query = $db->query("SELECT * FROM donation");
                $bloodDonations = $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                }
            ?>

           
            <table class='content-table'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Blood Type</th>
                        <th>Contact</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bloodDonations as $donation) : ?>
                        <tr>
                            <td><?php echo $donation['Name']; ?></td>
                            <td><?php echo $donation['BloodGroup']; ?></td>
                            <td><?php echo $donation['Contact']; ?></td>
                            <td>
                                <form method="POST" action="donate.php">
                                    <input type="hidden" name="request_id" value="<?php echo $donation['id']; ?>">
                                    <input type="submit" value="Donate">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php
         include '../footer/footer.php';
    ?>

</body>
</html>