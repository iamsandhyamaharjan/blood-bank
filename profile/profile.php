<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <!-- Add your CSS stylesheets and other header elements -->
</head>
<link rel="stylesheet" type="text/css" href="../header/header.css">
<link rel="stylesheet" type="text/css" href="content.css">
<script src="../header/header.js"></script>
<link rel="stylesheet" type="text/css" href="../footer/footer.css">
<link rel="stylesheet" type="text/css" href="profile.css">
<script src="../footer/footer.js"></script>
<body>
<?php
// Include file2.php
include '../header/header.php';
?>

<?php
// session_start();
include('../connect.php');

// Check if the user is logged in and the necessary profile information is available
if (isset($_SESSION['admin'])) {
    $username = $_SESSION['admin'];

    // Retrieve additional profile details from the database
    // ...

} elseif (isset($_SESSION['donor'])) {
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

} elseif (isset($_SESSION['recipient'])) {
    $username = $_SESSION['recipient'];
    $query = $db->prepare("SELECT * FROM recipient WHERE Name = :username");
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

} else {
    // Redirect the user to the login page if they are not logged in
    // header("Location: login.php");
    exit();
}

// Update profile data when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit1'])) {
        // Get the updated values from the form
        $newName = $_POST['name'];
        $newAddress = $_POST['address'];
        $newAge = $_POST['age'];
        $newContact = $_POST['contact'];
        $newBloodGroup = $_POST['bloodgroup'];

        // Update the profile data in the database based on the user type
        if (isset($_SESSION['donor'])) {
            $updateQuery = $db->prepare("UPDATE donors SET Name = :name, Address = :address, Age = :age, Contact = :contact, BloodGroup = :bloodgroup WHERE id=:id"  );
        } elseif (isset($_SESSION['recipient'])) {
            $updateQuery = $db->prepare("UPDATE recipient SET Name = :name, Address = :address, Age = :age, Contact = :contact, BloodGroup = :bloodgroup WHERE id=:id");
        } else {
            $updateQuery = $db->prepare("UPDATE admin SET name = :name, address = :address, age = :age, contact = :contact WHERE id=:id");
        }

        $updateQuery->bindParam(':name', $newName);
        $updateQuery->bindParam(':address', $newAddress);
        $updateQuery->bindParam(':age', $newAge);
        $updateQuery->bindParam(':contact', $newContact);
        $updateQuery->bindParam(':bloodgroup', $newBloodGroup);
        $updateQuery->bindParam(':id', $id);
        $updateQuery->execute();

        // Redirect the user back to the profile page
        // header("Location: profile.php");
        exit();
    }
}
?>

<h1>Welcome, <?php echo $username; ?></h1>
<h2>Profile Information</h2>
<form action="profile.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>">
    <br>
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo $address; ?>">
    <br>
    <label for="age">Age:</label>
    <input type="number" id="age" name="age" value="<?php echo $age; ?>">
    <br>
    <label for="contact">Contact:</label>
    <input type="text" id="contact" name="contact" value="<?php echo $contact; ?>">
    <br>
    <label for="bloodgroup">Blood Group:</label>
    <input type="text" id="bloodgroup" name="bloodgroup" value="<?php echo $bloodgroup; ?>">
    <br>
    <!-- Add more fields as necessary for the profile editing form -->
    <input type="submit" name="submit1" value="Update">
</form>

    <?php
        include '../footer/footer.php';
    ?>
</body>
</html>
