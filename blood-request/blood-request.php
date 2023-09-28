<?php
// Include file2.php
include '../header/header.php';


// Start the session to access session variables


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form values
    // var_dump($_POST);
    $name = $_POST['name'];
    $bloodType = $_POST['bloodgroup'];
    $contact = $_POST['contact'];

    // Assuming you have a database connection named $db
    // Replace 'your_username_column' with the actual column name in your recipients table that stores the usernames
    if (isset($_SESSION['recipient'])) {
        $username = $_SESSION['recipient'];}
        // echo $username;

    try {
        // Get the RecipientID from the database based on the username
        $recipientIdQuery = $db->prepare("SELECT id FROM recipient WHERE name = :username");
        $recipientIdQuery->bindParam(':username', $username);
        $recipientIdQuery->execute();

        // Fetch the RecipientID
        $recipientIdResult = $recipientIdQuery->fetch();
        $recipientId = $recipientIdResult['id'];
        // echo $recipientId;

        // Prepare and bind the SQL statement with placeholders
        $q = $db->prepare("INSERT INTO request (r_id, Name, BloodGroup, Contact) VALUES (:recipientId, :name, :bloodType, :contact)");
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



try {
    // Assuming you have a valid PDO database connection ($db)
    $query = $db->query("
        SELECT r.* 
        FROM request r 
        INNER JOIN recipient re ON re.id = r.r_id
    ");
    $bloodRequests = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}




?>

<!DOCTYPE html>
<html>
<head>
    <title>Blood Request Form</title>
    <link rel="stylesheet" type="text/css" href="blood-request.css">
    <link rel="stylesheet" type="text/css" href="../header/header.css">

<script src="../header/header.js"></script>
<link rel="stylesheet" type="text/css" href="../footer copy/footer.css">
<link rel="stylesheet" type="text/css" href="profile.css">
<script src="../footer/footer.js"></script>
<script src="blood-donate-list.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="parent">
       
       
    <form method="POST" action="">
    <h2 id="hi">Blood Request Form</h2>
        <!-- Your form fields here -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="bloodgroup">Blood Group:</label><br>
<select id="bloodgroup" name="bloodgroup">
    <option value=""></option>
    <option value="A+">A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option>
    <option value="O+">O+</option>
    <option value="O-">O-</option>
</select>
        <br><br>

        <label for="contact">Contact:</label>
        <input type="text" id="contact" name="contact" required><br><br>

        <button type="submit" value="Submit">Submit</button>
    </form>
      
       
    </div>
 
</body>
</html>

<?php
// Include file2.php
include '../footer copy/footer.php';
?>
