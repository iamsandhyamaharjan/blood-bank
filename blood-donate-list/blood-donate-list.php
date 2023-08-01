<?php
// Include file2.php
include '../header/header.php';

// Retrieve blood requests from the database
try {
    // Assuming you have a valid PDO database connection ($db)
    $query = $db->query("SELECT * FROM donation");
    $bloodDonations = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <!-- Add your CSS stylesheets and other header elements -->
</head>
<link rel="stylesheet" type="text/css" href="../header/header.css">
<link rel="stylesheet" type="text/css" href="blood-donate-list.css">
<script src="../header/header.js"></script>
<link rel="stylesheet" type="text/css" href="../footer copy/footer.css">
<link rel="stylesheet" type="text/css" href="profile.css">
<script src="../footer/footer.js"></script>
<body>
 
    <title>Donated Blood</title>
</head>
<body>
    <h2>Blood Donation</h2>
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
            <?php foreach ($bloodDonations as $donation) : ?>
                <tr>
                    <td><?php echo $donation['Name']; ?></td>
                    <td><?php echo $donation['BloodGroup']; ?></td>
                    <td><?php echo $donation['Contact']; ?></td>
                    <td>
                        <form method="POST" action="donate.php">
                            <input type="hidden" name="request_id" value="<?php echo $donation['id']; ?>">
                            <button type="submit"  value="Donate">Donate1</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Include file2.php
include '../footer copy/footer.php';
?>
