<?php
// Include file2.php
include '../header/header.php';


// Start the session to access session variables


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form values
    $name = $_POST['name'];
    $bloodType = $_POST['bloodType'];
    $contact = $_POST['contact'];

    // Assuming you have a database connection named $db
    // Replace 'your_username_column' with the actual column name in your recipients table that stores the usernames
    if (isset($_SESSION['donors'])) {
        $username = $_SESSION['donors'];}
        echo $username;

    try {
        // Get the RecipientID from the database based on the username
        $recipientIdQuery = $db->prepare("SELECT id FROM donors WHERE name = :username");
        $recipientIdQuery->bindParam(':username', $username);
        $recipientIdQuery->execute();

        // Fetch the RecipientID
        $recipientIdResult = $recipientIdQuery->fetch();
        $recipientId = $recipientIdResult['id'];

        // Prepare and bind the SQL statement with placeholders
        $q = $db->prepare("INSERT INTO donation (r_id, Name, BloodGroup, Contact) VALUES (:recipientId, :name, :bloodType, :contact)");
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
        FROM donation r 
        INNER JOIN donors re ON re.id = r.d_id
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
    <link rel="stylesheet" type="text/css" href="../blood-request/blood-request.css">
    <link rel="stylesheet" type="text/css" href="../header/header.css">

<script src="../header/header.js"></script>
<link rel="stylesheet" type="text/css" href="../footer copy/footer.css">
<link rel="stylesheet" type="text/css" href="profile.css">
<script src="../footer/footer.js"></script>
<script src="blood-donate-list.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="child">
<h2>Requested Blood <h2>
<table class="content-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Blood Type</th>
                <th>Contact</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bloodRequests as $request) : ?>
                <tr>
                    <td><?php echo $request['Name']; ?></td>
                    <td><?php echo $request['BloodGroup']; ?></td>
                    <td><?php echo $request['Contact']; ?></td>
                    
                    <td>
                    <?php if (!$request['status']) : ?>
        <button type="submit" onclick="donate(this, <?php echo $request['id']; ?>)">Requested</button>
        <?php else : ?>
    <?php if ($request['status'] == 'Approved') : ?>
        <button type="submit">Approved by Admin</button>
    <?php else : ?>
        <button type="submit" onclick="donate()">Donated</button>
    <?php endif; ?>
    <?php endif; ?>

    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>
       
</body>
</html>

<?php
// Include file2.php
include '../footer copy/footer.php';
?>
