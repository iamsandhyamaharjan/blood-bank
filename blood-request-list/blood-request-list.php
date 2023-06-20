<?php
// Include file2.php
include '../header/header.php';

// Retrieve blood requests from the database
try {
    // Assuming you have a valid PDO database connection ($db)
    $query = $db->query("SELECT * FROM request");
    $bloodRequests = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blood Requests</title>
</head>
<body>
    <h2>Blood Requests</h2>
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
            <?php foreach ($bloodRequests as $request) : ?>
                <tr>
                    <td><?php echo $request['Name']; ?></td>
                    <td><?php echo $request['BloodGroup']; ?></td>
                    <td><?php echo $request['Contact']; ?></td>
                    <td>
                        <form method="POST" action="donate.php">
                            <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
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
