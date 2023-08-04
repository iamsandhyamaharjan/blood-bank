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

        <?php
// Include your connect.php file here, which contains your PDO database connection
include('../connect.php');

// Check if the donation ID is provided as a URL parameter
if (isset($_GET['id'])) {
    $donationId = $_GET['id'];

    // Retrieve the donation details from the database using the ID
    try {
        // Assuming you have a valid PDO database connection ($db)
        $stmt = $db->prepare("SELECT * FROM donation WHERE id = :donationId");
        $stmt->bindParam(':donationId', $donationId, PDO::PARAM_INT);
        $stmt->execute();
        $donation = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($donation) {
            // Display the donation details
            echo "<h2>Donation Details</h2>";
            echo "Name: " . $donation['Name'] . "<br>";
            echo "Blood Type: " . $donation['BloodGroup'] . "<br>";
            echo "Contact: " . $donation['Contact'] . "<br>";
            // ... other details you want to display
            if ($donation['status'] == 'Donated') {
                    echo "Status: Requested";
                    echo "<button type='button' onclick='approveDonation($donationId)'>Approve</button>";
                } 
                else if($donation['status'] == 'Approved') {
                    echo "Status: Approved";
                } 
                else {
                    echo "Status: No Recepient Found";
                }    
            
        } else {
            echo "Donation not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request. Donation ID is missing.";
}
?>

    </main>

    <?php
         include '../footer/footer.php';
    ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // This is your JavaScript code to handle the "Approve" button click
    function approveDonation(donationId) {
        // AJAX call to update the status in the database
        $.ajax({
            url: 'approve.php', // Replace with the actual PHP file that handles the AJAX request
            method: 'POST',
            data: {
                donationId: donationId
            },
            success: function(response) {
                if (response === 'success') {
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







</body>
</html>