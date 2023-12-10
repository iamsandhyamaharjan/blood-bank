
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <!-- Add your CSS stylesheets and other header elements -->
</head>
<link rel="stylesheet" type="text/css" href="../header/header.css">
<link rel="stylesheet" type="text/css" href="content.css">
<!-- <script src="../header/header.js"></script> -->
<link rel="stylesheet" type="text/css" href="../footer copy/footer.css">
<link rel="stylesheet" type="text/css" href="blood-donate.css">
<script src="../footer/footer.js"></script>
<script src="blood-donate.js"></script>
<body>
<?php
// Include file2.php
include '../header/header.php';

if (isset($_SESSION['donor'])) {
    $username = $_SESSION['donor'];
    $query = $db->prepare("SELECT * FROM donors WHERE Name = :username");
    $query->bindParam(':username', $username);
    $query->execute();
    $profile = $query->fetch(PDO::FETCH_ASSOC);

    // Store the profile details in variables
    $name = $profile['Name'];
    $id =$profile['id'];
    $address = $profile['Address'];
    $age = $profile['Age'];
    $contact = $profile['Contact'];
    $bloodgroup = $profile['BloodGroup'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form values
    $name = $_POST['name'];
    $bloodType = $_POST['bloodgroup'];
    $contact = $_POST['contact'];
    if (isset($_SESSION['donor'])) {
        $username = $_SESSION['donor'];}
        // echo $username;


    try {
        // Prepare and bind the SQL statement with placeholders
        $recipientIdQuery = $db->prepare("SELECT id FROM donors WHERE name = :username");
        $recipientIdQuery->bindParam(':username', $username);
        $recipientIdQuery->execute();

        // Fetch the RecipientID
        $recipientIdResult = $recipientIdQuery->fetch();
        $recipientId = $recipientIdResult['id'];

        $checkDonationQuery = $db->prepare("SELECT COUNT(*) as donationCount FROM donation WHERE d_id = :recipientId AND Date >= DATE_SUB(NOW(), INTERVAL 2 MONTH)");
        $checkDonationQuery->bindParam(':recipientId', $recipientId);
        $checkDonationQuery->execute();
        $donationCountResult = $checkDonationQuery->fetch();
        $donationCount = $donationCountResult['donationCount'];         

        if ($donationCount > 0) {
            // Donor has already donated within the last 2 months
            echo "<br><br><h3>You have already donated. Please wait for 2 months before donating again.</h3>";
        }
       else{ 
        $q = $db->prepare("INSERT INTO donation(d_id,Name, BloodGroup, Contact) VALUES (:recipientId,:name, :bloodType, :contact)");
        $q->bindParam(':recipientId', $recipientId);
        $q->bindParam(':name', $name);
        $q->bindParam(':bloodType', $bloodType);
        $q->bindParam(':contact', $contact);
        $q->execute();

        echo "<br><br><h3>Blood request saved successfully.</h3>";}
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
    <form method="POST" action="" onsubmit="return validateForm()">
    <!-- Your form fields here -->
    <label for="name">Name:</label>
    <input type="text" id="editName" name="name" value="<?php echo $name; ?>">
    <div id="error-msg-name" style="color: red;"></div><br><br>

    <label for="bloodgroup">Blood Group:</label><br>
    <select id="editBloodgroups" name="bloodgroup" >
    <option value="<?php echo $bloodgroup; ?>"><?php echo $bloodgroup; ?></option>
    <option value="A+">A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option>
    <option value="O+">O+</option>
    <option value="O-">O-</option>
    </select>
    <div id="error-msg-bloodgroup" style="color: red;"></div><br><br>

    <label for="contact">Contact:</label>
    <input type="text" id="editContact" name="contact" value="<?php echo $contact; ?>" >
    <div id="error-msg-contact" style="color: red;"></div><br><br>

    <input type="submit" value="Request to donate">
</form>
    
</body>
</html>

<?php
// Include file2.php
include '../footer copy/footer.php';
?>
