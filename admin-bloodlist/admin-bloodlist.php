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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="admin-home.js"></script>
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
    <div class="button-container">
        <button onclick="createDonor()">Blood lists</button>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Blood Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John Doe</td>
                <td>O+</td>
                <td>
                    <button onclick="editDonor(1)">Edit</button>
                    <button onclick="deleteDonor(1)">Delete</button>
                </td>
            </tr>
            <tr>
                <td>Jane Smith</td>
                <td>A-</td>
                <td>
                    <button onclick="editDonor(2)">Edit</button>
                    <button onclick="deleteDonor(2)">Delete</button>
                </td>
            </tr>
            <!-- Add more donor rows here if needed -->
        </tbody>
    </table>
    </div>
    <div >

</body>
</html>
