<?php
// Include your connect.php file here, which contains your PDO database connection
include('../connect.php');

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Make sure the donationId is set and numeric
    if (isset($_POST['donationId']) && is_numeric($_POST['donationId'])) {
        $donationId = $_POST['donationId'];

        // Update the status of the donation in the database to "Approved"
        try {
            // Assuming you have a valid PDO database connection ($db)
            $stmt = $db->prepare("UPDATE donation SET Status = 'Approved' WHERE id = :donationId");
            $stmt->bindParam(':donationId', $donationId, PDO::PARAM_INT);
            $stmt->execute();

            // Get the donor's information from the donation table
            $donorInfoStmt = $db->prepare("SELECT d_id, BloodGroup FROM donation WHERE id = :donationId");
            $donorInfoStmt->bindParam(':donationId', $donationId, PDO::PARAM_INT);
            $donorInfoStmt->execute();
            $donorInfo = $donorInfoStmt->fetch(PDO::FETCH_ASSOC);

            // Insert the donor's information into the blood table
            $insertBloodStmt = $db->prepare("INSERT INTO blood (DonorID, BloodType) VALUES (:d_id, :BloodGroup)");
            $insertBloodStmt->bindParam(':d_id', $donorInfo['d_id'], PDO::PARAM_INT); // Updated parameter name
            $insertBloodStmt->bindParam(':BloodGroup', $donorInfo['BloodGroup'], PDO::PARAM_STR); // Updated parameter name
            $insertBloodStmt->execute();

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
