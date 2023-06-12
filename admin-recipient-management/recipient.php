<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" type="text/css" href="../admin/admin-home.css">
  <script src="../admin/admin-home.js"></script>
          <title>Document</title>
</head>
<body>


</body>
</html><!DOCTYPE html>
<html>
<head>
    <title>Blood Bank Management System</title>
    <link rel="stylesheet" type="text/css" href="admin-home.css">
    <link rel="stylesheet" type="text/css" href="recipient.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="admin-home.js"></script>
    <script src="recipient.js"></script>
</head>
<body>
<div class="header">
<img class="blood-logo" src="https://assets.rumsan.com/esatya/hlb-navbar-logo.png">
        <h1>Blood Bank Management System</h1>
        <h1?></h1>
    </div>
    <div class=body1 >
    <div class="sidebar">
        <ul>
            <li><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="../admin-donor-management/donor.php"><i class="fas fa-users"></i> Donor Management</a></li>
            <li><a href="../admin-recipient-management/recipient.php"><i class="fas fa-users"></i> Recipient Management</a></li>
            <li><a href="../admin-bloodlist/admin-bloodlist.php"><i class="fas fa-users"></i> List of bloods</a></li>
            <li><a href="#"><i class="fas fa-cubes"></i> Inventory Management</a></li>
            <li><a href="#"><i class="fas fa-list-alt"></i> Blood Requests</a></li>
            <li><a href="#"><i class="fas fa-chart-bar"></i> Reports</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>
    </div>


    <div class="content">
    <?php
include('../connect.php');
    function displayRecipients()
{
    global $db;

    try {
        $q = $db->query("SELECT * FROM recipient");
        $recipients = $q->fetchAll(PDO::FETCH_ASSOC);

        if (count($recipients) > 0) {
            echo '<table>';
            echo '<tr><th>Name</th><th>Address</th><th>Age</th><th>Contact</th><th>Blood Group</th><th>Action</th></tr>';
            foreach ($recipients as $recipient) {
                echo '<tr>';
                echo '<td>' . $recipient['Name'] . '</td>';
                echo '<td>' . $recipient['Address'] . '</td>';
                echo '<td>' . $recipient['Age'] . '</td>';
                echo '<td>' . $recipient['Contact'] . '</td>';
                echo '<td>' . $recipient['BloodGroup'] . '</td>';
                echo '<td><button onclick="deleteRecipient(' . $recipient['id'] . ')">Delete</button></td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No recipients found.';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_POST['delete_recipient'])) {
          $recipientId = $_POST['recipient_id'];
      
          try {
              $q = $db->prepare("DELETE FROM recipient WHERE id=:id");
              $q->bindParam(':id', $recipientId);
              $q->execute();
      
              echo "Recipient deleted successfully.";
          } catch (PDOException $e) {
              echo "Error: " . $e->getMessage();
          }
      }
      ?>
    <?php displayRecipients(); ?>
    </div>
    <div >

</body>
</html>
