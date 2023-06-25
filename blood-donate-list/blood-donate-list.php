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
    <title>Donated Blood</title>
</head>
<body>
    <h2>Blood Donation</h2>
    <table>
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
                            <input type="submit" value="Donate">
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
