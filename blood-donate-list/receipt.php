<?php
// Include your connect.php file here, which contains your PDO database connection
include('../connect.php');

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Make sure the donationId is set and numeric
    if (isset($_POST['donationId']) && is_numeric($_POST['donationId'])) {
        $donationId = (int)$_POST['donationId'];

        // Update the status of the donation in the database
        try {
            $stmt = $db->prepare("UPDATE donation SET Status = 'Donated' WHERE id = :donationId");
            $stmt->bindParam(':donationId', $donationId, PDO::PARAM_INT);
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
