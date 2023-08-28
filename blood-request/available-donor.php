<?php
// Include file2.php
include '../header/header.php';


// Start the session to access session variables







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

<!-- <div class="content"> -->

<?php
include('../connect.php');

// Function to fetch and display donors


function displayDonors()
{
global $db;

try {
$q = $db->query("SELECT * FROM donors");
$donors = $q->fetchAll(PDO::FETCH_ASSOC);

if (count($donors) > 0) {
echo '<table class="content-table">';
echo '<thead><tr><th>Name</th><th>Address</th><th>Age</th><th>Contact</th><th>Blood Group</th><th>Action</th></tr></thead>';

foreach ($donors as $donor) {
    echo '<tbody><tr>';
    echo '<td>' . $donor['Name'] . '</td>';
    echo '<td>' . $donor['Address'] . '</td>';
    echo '<td>' . $donor['Age'] . '</td>';
    echo '<td>' . $donor['Contact'] . '</td>';
    echo '<td>' . $donor['BloodGroup'] . '</td>';
    echo '<td><button>Contact</button>
  
    
    </td>';
    echo '</tr></tbody>';
}
echo '</table>';
} else {
echo 'No donors found.';
}
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}
}
// echo'<h1>.Available Donors. echo</h1>';
//  displayDonors(); ?>    
<h2>Available Donors</h2>

<?php displayDonors()?>
    
       
</body>
</html>
<div  id="content"></div>
<?php
// Include file2.php
include '../footer copy/footer.php';
?>
