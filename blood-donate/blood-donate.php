
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <!-- Add your CSS stylesheets and other header elements -->
</head>
<link rel="stylesheet" type="text/css" href="../header/header.css">
<link rel="stylesheet" type="text/css" href="content.css">
<script src="../header/header.js"></script>
<link rel="stylesheet" type="text/css" href="../footer copy/footer.css">
<link rel="stylesheet" type="text/css" href="blood-donate.css">
<script src="../footer/footer.js"></script>
<body>
<?php
// Include file2.php
include '../header/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form values
    $name = $_POST['name'];
    $bloodType = $_POST['bloodType'];
    $contact = $_POST['contact'];
    if (isset($_SESSION['donor'])) {
        $username = $_SESSION['donor'];}
        echo $username;


    try {
        // Prepare and bind the SQL statement with placeholders
        $recipientIdQuery = $db->prepare("SELECT id FROM donors WHERE name = :username");
        $recipientIdQuery->bindParam(':username', $username);
        $recipientIdQuery->execute();

        // Fetch the RecipientID
        $recipientIdResult = $recipientIdQuery->fetch();
        $recipientId = $recipientIdResult['id'];


        $q = $db->prepare("INSERT INTO donation(d_id,Name, BloodGroup, Contact) VALUES (:recipientId,:name, :bloodType, :contact)");
        $q->bindParam(':recipientId', $recipientId);
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
