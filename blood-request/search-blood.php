<?php
include('../connect.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Get the filter parameters from the AJAX request
          $addressFilter = isset($_POST['address']) ? $_POST['address'] : '';
          $bloodGroupFilter = isset($_POST['bloodGroup']) ? $_POST['bloodGroup'] : '';
      
          // Call the displayDonors function with the filter parameters
          displayDonors($addressFilter, $bloodGroupFilter);
      }

    
// Start the session to access session variables
// ...


// Function to fetch and display donors
function displayDonors($addressFilter = '', $bloodGroupFilter = '')
{
    global $db;

    try {
        $query = "SELECT * FROM blood b INNER JOIN donors d ON b.DonorId = d.id WHERE ";
        $conditions = [];

        if (!empty($addressFilter)) {
            $conditions[] = "d.Address LIKE :address";
        }

        if (!empty($bloodGroupFilter)) {
            $conditions[] = "b.BloodType = :bloodGroup";
        }

        if (empty($conditions)) {
            // No filters applied, display all donors
            $query .= "1"; // Dummy condition to retrieve all records
        } else {
            // Apply filters
            $query .= implode(" AND ", $conditions);
        }

        $stmt = $db->prepare($query);

        if (!empty($addressFilter)) {
            $stmt->bindValue(':address', '%' . $addressFilter . '%', PDO::PARAM_STR);
        }

        if (!empty($bloodGroupFilter)) {
            $stmt->bindValue(':bloodGroup', $bloodGroupFilter, PDO::PARAM_STR);
        }

        $stmt->execute();

        $donors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($donors) > 0) {
            // Display matching donors
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
            // No matching donors found
            echo 'No Blood available to show';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>  

