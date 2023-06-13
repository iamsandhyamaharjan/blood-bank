<?php
include('../connect.php');

if (isset($_GET['id'])) {
    $donorId = $_GET['id'];

    try {
        $q = $db->prepare("SELECT * FROM donors WHERE id=:id");
        $q->bindParam(':id', $donorId);
        $q->execute();
        $donor = $q->fetch(PDO::FETCH_ASSOC);

        if ($donor) {
            // Return the donor details as JSON
            echo json_encode($donor);
        } else {
            // Donor not found
            echo "Donor not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Invalid request
    echo "Invalid request.";
}
?>
