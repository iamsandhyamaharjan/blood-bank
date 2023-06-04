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

<div class="button-container">
        <button onclick="createDonor()">Create Donor</button>
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
</body>
</html>