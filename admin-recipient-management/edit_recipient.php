<?php
include('../connect.php');

if (isset($_GET['id'])) {
    $recipientId = $_GET['id'];

    try {
        $q = $db->prepare("SELECT * FROM recipient WHERE id=:id");
        $q->bindParam(':id', $recipientId);
        $q->execute();
        $recipient = $q->fetch(PDO::FETCH_ASSOC);

        if ($recipient) {
            // Return the recipient details as JSON
            echo json_encode($recipient);
        } else {
            // recipient not found
            echo "recipient not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Invalid request
    echo "Invalid request.";
}
?>
