
<?php
// Include your connect.php file here, which contains your PDO database connection
include('../connect.php');

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Make sure the donationId is set and numeric
    if (isset($_POST['donationId']) && is_numeric($_POST['donationId'])) {
        $requestId = $_POST['donationId'];

        // Update the status of the donation in the database to "Approved"
        try {
            // Assuming you have a valid PDO database connection ($db)
            $stmt = $db->prepare("UPDATE blood SET status = 'Approved' WHERE BloodId = :requestId");
            $stmt->bindParam(':requestId', $requestId, PDO::PARAM_INT);
            $stmt->execute();

            // Respond with 'success' to indicate successful status update
            echo 'success';
        } catch (PDOException $e) {
            // Handle error if needed
            echo 'error';
        }
    } else {
        // Invalid request
        echo 'error';
    }
}
?>