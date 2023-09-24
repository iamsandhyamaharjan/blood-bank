<?php
// Include file2.php
include '../header/header.php';


// Start the session to access session variables

if (isset($_SESSION['donor'])) {
    $username = $_SESSION['donor'];

    try {
        // Assuming you have a valid PDO database connection ($db)
        $query = $db->prepare("
           SELECT * FROM donation d
           INNER JOIN donors de ON d.d_id = de.id
           WHERE de.name = :username
        ");

        // Bind the parameter
        $query->bindParam(':username', $username, PDO::PARAM_STR);

        // Execute the query
        $query->execute();

        // Check if there are results
        if ($query->rowCount() > 0) {
            $bloodRequests = $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // No results found
            echo "You haven't donated yet.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
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
<h2>My Donation <h2>
<?php if (!empty($bloodRequests)) : ?> 
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
    <?php endif; ?>
        </div>
       <div id="content"></div>
</body>

</html>

<?php
// Include file2.php
include '../footer copy/footer.php';
?>
