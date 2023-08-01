<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../admin/admin-home.css">
    <link rel="stylesheet" type="text/css" href="admin-home.css">
    <script src="admin-home.js"></script>
    <script src="../admin/admin-home.js"></script>
    
    <!-- link to footer css -->
    <link rel="stylesheet" href="../footer/footer.css">

    <!-- link to font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- link to css -->
    <link rel="stylesheet" href="admin-requestlist.css">

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
    
            <?php
                // Include file2.php
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

<div class="button-container">
                <button onclick="createDonor()">Requested Blood Lists</button>
            </div>
            <table class="content-table">
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
    </main>

    <?php
        include '../footer/footer.php';
    ?> 

</body>
</html>
