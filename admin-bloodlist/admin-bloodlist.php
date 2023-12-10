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
        <link rel="stylesheet" type="text/css" href="../admin/admin-header.css">

        <!-- link to footer css -->
        <link rel="stylesheet" type="text/css" href="../footer/footer.css">

        <!-- link to donationlist css --> 
        <link rel="stylesheet" type="text/css" href="../admin-donationlist/admin-donationlist.css">

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
            <a href="../admin-bloodlist/admin-bloodlist.php"><i class="fas fa-list-alt"></i>Blood List</a>

            <a href="../admin/admin-profile.php"><i class="fas fa-cog"></i>Profile</a>
        </aside>

        <div class="content">

            <div class="button-container">
                <button onclick="createDonor()"> Blood Lists</button>
            </div>

            <?php
                // Include file2.php
                // include '../header/header.php';
                include('../connect.php');
                // Retrieve blood requests from the database
                try {
                // Assuming you have a valid PDO database connection ($db)
                $query = $db->query("SELECT  b.BloodId AS blood_id, d.*, b.* FROM blood b inner join donors d where b.donorId = d.id");
                $bloodDonations = $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                }
            ?>

           
            <table class='content-table'>
                <thead>
                    <tr>
                        <th> Donor Name</th>
                        <th>Blood Type</th>
                        <th>Contact</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bloodDonations as $donation) : ?>
                        <tr>
                            <td><?php echo $donation['Name']; ?></td>
                            <td><?php echo $donation['BloodType']; ?></td>

                            <td><?php echo $donation['Contact']; ?></td>
                            <?php
if ($donation['status'] == "") {
    echo '<td>No requests</td>';
} 
else if ($donation['status'] == "Approved") {
    echo '<td>Approved</td>';
} 
else {
    $BloodId = $donation['blood_id']; 

    echo '<td>Requested <button onclick="approveRequest(' . $BloodId . ')">Approve</button></td>';
}
?>

                           
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // This is your JavaScript code to handle the "Approve" button click
    function approveRequest(donationId) {
        // AJAX call to update the status in the database
        $.ajax({
            url: 'approve.php', // Replace with the actual PHP file that handles the AJAX request
            method: 'POST',
            data: {
                donationId: donationId
            },
            success: function(response) {
                var trimmedResponse = response.trim(); 
                if (trimmedResponse === 'success') {
                    // Once the status is updated, reload the page to show the updated status
                    window.location.reload();
                } else {
                    // Handle error if needed
                    console.error('Status update failed');
                }
            },
            error: function(xhr, status, error) {
                // Handle error if needed
                console.error('AJAX error:', error);
            }
        });
    }
</script>
    <?php
         include '../footer/footer.php';
    ?>

</body>
</html>