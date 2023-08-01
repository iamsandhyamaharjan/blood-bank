
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="../admin/admin-home.css">
        <script src="../admin/admin-home.js"></script>

        <link rel="stylesheet" href="recipient.css">

        <!-- footer css -->
        <link rel="stylesheet" type="text/css" href="../footer/footer.css">

        <!-- font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

        <title>Document</title>
</head>
<body>

    <?php
        include '../admin/admin-header.php';
    ?>

    <main>
        <aside>
            <a href="../admin/admin-home.php"><i class="fas fa-home"></i>Dashboard</a>
            <a href="../admin-donor-management/donor.php"><i class="fas fa-users"></i>Donor Management</a>
            <a href="../admin-recipient-management/recipient.php"><i class="fas fa-users"></i>Recipient Management</a>
            <a href="../admin-donationlist/admin-donationlist.php"><i class="fas fa-list-alt"></i>Donation Lists</a>
            <a href="../admin-requestlist/admin-requestlist.php"><i class="fas fa-list-alt"></i>Request List</a>
            <a href="#"><i class="fas fa-chart-bar"></i>Reports</a>
            <a href="#"><i class="fas fa-cog"></i>Settings</a>
        </aside>


        <div class="content">

            <?php

                include('../connect.php');
                
                function displayRecipients()
                {
                    global $db;

                    try {
                        $q = $db->query("SELECT * FROM recipient");
                        $recipients = $q->fetchAll(PDO::FETCH_ASSOC);

                        if (count($recipients) > 0)
                        {
                            echo '<table class="content-table">';
                            echo '<tr><thead><th>Name</th><th>Address</th><th>Age</th><th>Contact</th><th>Blood Group</th><th>Action</th></thead></tr>';
                            foreach ($recipients as $recipient)
                            {
                                echo '<tbody><tr>';
                                echo '<td>' . $recipient['Name'] . '</td>';
                                echo '<td>' . $recipient['Address'] . '</td>';
                                echo '<td>' . $recipient['Age'] . '</td>';
                                echo '<td>' . $recipient['Contact'] . '</td>';
                                echo '<td>' . $recipient['BloodGroup'] . '</td>';
                                echo '<td> <button onclick="openEditForm(' . $recipient['id'] . ')">Edit</button> <button onclick="deleteRecipient(' . $recipient['id'] . ')">Delete</button> </td>';
                                echo '</tr></tbody>';
                            }
                            echo '</table>';
                        } 
                        else
                        {
                        echo 'No recipients found.';
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }

                if (isset($_POST['delete_recipient']))
                {
                    $recipientId = $_POST['recipient_id'];
                    
                    try
                    {
                        $q = $db->prepare("DELETE FROM recipient WHERE id=:id");
                        $q->bindParam(':id', $recipientId);
                        $q->execute();
                    
                        echo "Recipient deleted successfully.";
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }

            ?>
<div class="button-container">
                <button onclick="createDonor()">Receipient Lists</button>
            </div>
            <?php displayRecipients(); ?>

                <div id="editFormContainer">
                    <h2>Edit and Create recipient</h2>
                    <form id="editForm" action="update_recipient.php" method="POST">
                        <input type="hidden" name="recipient_id" id="editrecipientId">
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
                function openEditForm(id)
                {
                    // Fetch recipient details using AJAX
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'edit_recipient.php?id=' + id, true);
                    xhr.onload = function () {
                        if (xhr.status === 200)
                        {
                            var recipient = JSON.parse(xhr.responseText);
                
                            // Populate form fields with recipient details
                            document.getElementById('editrecipientId').value = recipient.id;
                            document.getElementById('editName').value = recipient.Name;
                            document.getElementById('editAddress').value = recipient.Address;
                            document.getElementById('editAge').value = recipient.Age;
                            document.getElementById('editContact').value = recipient.Contact;
                            document.getElementById('editBloodGroup').value = recipient.BloodGroup;
                
                            // Show the edit form
                            document.getElementById('editFormContainer').style.display = 'block';
                        }
                        else
                        {
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

    </main>

    <?php
        include '../footer/footer.php';
    ?>

</body>
</html>
