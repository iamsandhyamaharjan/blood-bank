<?php
// update_donor.php

include('../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $donorId = $_POST['donor_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $bloodGroup = $_POST['blood_group'];

    try {
        if ($donorId) {
            // Update the existing donor data in the database
            $q = $db->prepare("UPDATE donors SET Name=:name, Address=:address, Age=:age, Contact=:contact, BloodGroup=:bloodGroup WHERE id=:id");
            $q->bindParam(':name', $name);
            $q->bindParam(':address', $address);
            $q->bindParam(':age', $age);
            $q->bindParam(':contact', $contact);
            $q->bindParam(':bloodGroup', $bloodGroup);
            $q->bindParam(':id', $donorId);
            $q->execute();

            echo "<script>window.location.href = '../admin-donor-management/donor.php';</script>";
            exit(); // Make sure to exit after redirecting
        } else {
            // Create a new donor in the database
            $q = $db->prepare("INSERT INTO donors (Name, Address, Age, Contact, BloodGroup) VALUES (:name, :address, :age, :contact, :bloodGroup)");
            $q->bindParam(':name', $name);
            $q->bindParam(':address', $address);
            $q->bindParam(':age', $age);
            $q->bindParam(':contact', $contact);
            $q->bindParam(':bloodGroup', $bloodGroup);
            $q->execute();

            echo "<script>window.location.href = '../admin-donor-management/donor.php';</script>";
            exit(); // Make sure to exit after redirecting
        }

        echo "<script>window.location.href = '../admin-donor-management/donor.php';</script>";
        exit(); // Make sure to exit after redirecting
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>