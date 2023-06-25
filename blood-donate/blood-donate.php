<?php
// Include file2.php
include '../header/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form values
    $name = $_POST['name'];
    $bloodType = $_POST['bloodType'];
    $contact = $_POST['contact'];

    try {
        // Prepare and bind the SQL statement with placeholders
        $q = $db->prepare("INSERT INTO donation(Name, BloodGroup, Contact) VALUES (:name, :bloodType, :contact)");
        $q->bindParam(':name', $name);
        $q->bindParam(':bloodType', $bloodType);
        $q->bindParam(':contact', $contact);
        $q->execute();

        echo "Blood request saved successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blood Request Form</title>
</head>
<body>
    <h2>Blood Donation Form</h2>
    <form method="POST" action="">
        <!-- Your form fields here -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="bloodType">Blood Type:</label>
        <input type="text" id="bloodType" name="bloodType" required><br><br>

        <label for="contact">Contact:</label>
        <input type="text" id="contact" name="contact" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
// Include file2.php
include '../footer copy/footer.php';
?>
