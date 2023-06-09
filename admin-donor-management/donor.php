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
    <link rel="stylesheet" type="text/css" href="donor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="admin-home.js"></script>
    <script src="donor.js"></script>
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
            <li><a href="../admin/admin-home.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="../admin-donor-management/donor.php"><i class="fas fa-users"></i> Donor Management</a></li>
            <li><a href="../admin-recipient-management/recipient.php"><i class="fas fa-users"></i> Recipient Management</a></li>
            <li><a href="../admin-donationlist/admin-donationlist.php"><i class="fas fa-list-alt"></i> Donation Lists</a></li>
            <li><a href="../admin-requestlist/admin-requestlist.php"><i class="fas fa-list-alt"></i> Request List</a></li>
           
            <li><a href="#"><i class="fas fa-chart-bar"></i> Reports</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>
    </div>


    <div class="content">
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
            print_r($donors[1]); 
            foreach ($donors as $donor) {
                echo '<tbody><tr>';
                echo '<td>' . $donor['Name'] . '</td>';
                echo '<td>' . $donor['Address'] . '</td>';
                echo '<td>' . $donor['Age'] . '</td>';
                echo '<td>' . $donor['Contact'] . '</td>';
                echo '<td>' . $donor['BloodGroup'] . '</td>';
                echo '<td><button onclick="deleteDonor(' . $donor['id'] . ')">Delete</button>
                <button onclick="openEditForm(' . $donor['id'] . ')">Edit</button>
                
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

// Delete donor
if (isset($_POST['delete_donor'])) {
    $donorId = $_POST['donor_id'];

    try {
        $q = $db->prepare("DELETE FROM donors WHERE id=:id");
        $q->bindParam(':id', $donorId);
        $q->execute();

        echo "Donor deleted successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
    <?php displayDonors(); ?>
    <div id="editFormContainer">
        <h2>Edit and Create Donor</h2>
        <form id="editForm" action="update_donor.php" method="POST">
            <input type="hidden" name="donor_id" id="editDonorId">
            <label for="editName">Name:</label>
            <input type="text" name="name" id="editName" required>
            <label for="editAddress">Address:</label>
            <input type="text" name="address" id="editAddress" required>
            <label for="editAge">Age:</label>
            <input type="number" name="age" id="editAge" required>
            <label for="editContact">Contact:</label>
            <input type="text" name="contact" id="editContact" required>
            <label for="editBloodGroup">Blood Group:</label>
            <input type="text" name="blood_group" id="editBloodGroup" required>
            <button type="submit">Save</button>
            <button type="button" onclick="closeEditForm()">Cancel</button>
        </form>
    </div>
  <script>   
function openEditForm(id) {
        // Fetch donor details using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'edit_donor.php?id=' + id, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                var donor = JSON.parse(xhr.responseText);
    
                // Populate form fields with donor details
                document.getElementById('editDonorId').value = donor.id;
                document.getElementById('editName').value = donor.Name;
                document.getElementById('editAddress').value = donor.Address;
                document.getElementById('editAge').value = donor.Age;
                document.getElementById('editContact').value = donor.Contact;
                document.getElementById('editBloodGroup').value = donor.BloodGroup;
    
                // Show the edit form
                document.getElementById('editFormContainer').style.display = 'block';
            } else {
                console.error('Error:', xhr.status);
            }
        };
        xhr.send();
    }
    
    function closeEditForm() {
        // Hide the edit form
        document.getElementById('editFormContainer').style.display = 'none';
    }
    </script>
    </div>
    <div >

</body>
</html>
