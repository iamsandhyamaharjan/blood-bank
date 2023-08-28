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
<link rel="stylesheet" type="text/css" href="blood-request-list.css">
<script src="../footer/footer.js"></script>
<script src="blood-request-list.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<body>

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
<body >
    <h2>Blood Requests</h2>
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
        <button type="submit" onclick="donate(this, <?php echo $request['id']; ?>)">Donate</button>
        <?php else : ?>
    <?php if ($request['status'] == 'Approved') : ?>
        <button type="submit">Approved</button>
    <?php else : ?>
        <button type="submit" onclick="donate()">Donated</button>
    <?php endif; ?>
    <?php endif; ?>

    </td>
                </tr>
            <?php endforeach; ?>






            
        </tbody>
    </table>
    <div  id="content"></div>
</body>
</html>

<?php
// Include file2.php
include '../footer copy/footer.php';
?>
