<?php
// Include file2.php
include '../header/header.php';

// Start the session to access session variables
// ...

include('../connect.php');

// Function to fetch and display donors
function displayDonors()
{
    global $db;

    try {
        $q = $db->query("SELECT * FROM blood b INNER JOIN donors d ON b.DonorId = d.id");
        $donors = $q->fetchAll(PDO::FETCH_ASSOC);

        if (count($donors) > 0) {
            echo '<table class="content-table">';
            echo '<thead><tr><th>Name</th><th>Address</th><th>Age</th><th>Contact</th><th>Blood Group</th><th>Action</th></tr></thead>';
            echo '<tbody>';

            foreach ($donors as $donor) {
                echo '<tr>';
                echo '<td>' . $donor['Name'] . '</td>';
                echo '<td>' . $donor['Address'] . '</td>';
                echo '<td>' . $donor['Age'] . '</td>';
                echo '<td>' . $donor['Contact'] . '</td>';
                echo '<td>' . $donor['BloodType'] . '</td>';
                echo '<td><button>Contact</button></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo 'No Blood available to show';
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
    <link rel="stylesheet" type="text/css" href="../header/header.css">
    <link rel="stylesheet" type="text/css" href="../footer copy/footer.css">
    <link rel="stylesheet" type="text/css" href="blood-request.css">
    <link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
    <!-- Move script includes here -->
    <!-- ... -->

    <!-- Display donors -->
    <h2>Available Blood</h2>
   
    <div class="search-container">
    <input type="text" id="searchInput" placeholder="Search by address...">
    <input type="text" id="searchInput" placeholder="Search by blood type...">
    <button id="searchButton">Search</button>
</div>


<?php displayDonors()?>
<div id="content"></div>

    <!-- Move script includes here -->
    <script src="../header/header.js"></script>
    <script src="../footer/footer.js"></script>
    <!-- <script src="blood-donate-list.js"></script> -->
    <script src="blood-request.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>

<?php
// Include file2.php
include '../footer copy/footer.php';
?>
