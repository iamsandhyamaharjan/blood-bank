<?php
// update_recipient.php

include('../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $recipientId = $_POST['recipient_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $bloodGroup = $_POST['blood_group'];

    try {
        if ($recipientId) {
            // Update the existing recipient data in the database
            $q = $db->prepare("UPDATE recipient SET Name=:name, Address=:address, Age=:age, Contact=:contact, BloodGroup=:bloodGroup WHERE id=:id");
            $q->bindParam(':name', $name);
            $q->bindParam(':address', $address);
            $q->bindParam(':age', $age);
            $q->bindParam(':contact', $contact);
            $q->bindParam(':bloodGroup', $bloodGroup);
            $q->bindParam(':id', $recipientId);
            $q->execute();

            echo "<script>window.location.href = '../admin-recipient-management/recipient.php';</script>";
            exit(); // Make sure to exit after redirecting
        } else {
            // Create a new recipient in the database
            $q = $db->prepare("INSERT INTO recipient (Name, Address, Age, Contact, BloodGroup) VALUES (:name, :address, :age, :contact, :bloodGroup)");
            $q->bindParam(':name', $name);
            $q->bindParam(':address', $address);
            $q->bindParam(':age', $age);
            $q->bindParam(':contact', $contact);
            $q->bindParam(':bloodGroup', $bloodGroup);
            $q->execute();

            echo "<script>window.location.href = '../admin-recipient-management/recipient.php';</script>";
            exit(); // Make sure to exit after redirecting
        }

        echo "<script>window.location.href = '../admin-recipient-management/recipient.php';</script>";
        exit(); // Make sure to exit after redirecting
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
