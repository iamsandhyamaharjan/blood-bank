<?php
// Include database connection
include('../connect.php');

// Function to search and display blood requests by blood type
function searchBloodRequests($bloodGroupFilter)
{
    global $db;

    try {
        $query = "SELECT * FROM request WHERE BloodGroup = :bloodGroup";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':bloodGroup', $bloodGroupFilter, PDO::PARAM_STR);
        $stmt->execute();

        $bloodRequests = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($bloodRequests) > 0) {
            // Display matching blood requests
            echo '<table class="content-table">';
            echo '<thead><tr><th>Name</th><th>Blood Type</th><th>Contact</th><th>Action</th></tr></thead>';
            echo '<tbody>';

            foreach ($bloodRequests as $request) {
                echo '<tr>';
                echo '<td>' . $request['Name'] . '</td>';
                echo '<td>' . $request['BloodGroup'] . '</td>';
                echo '<td>' . $request['Contact'] . '</td>';
                echo '<td>';
                if (!$request['status']) {
                    echo '<button type="submit" onclick="donate(this, ' . $request['id'] . ')">Donate</button>';
                } else {
                    if ($request['status'] == 'Approved') {
                        echo '<button type="submit">Approved</button>';
                    } else {
                        echo '<button type="submit" onclick="donate()">Donated</button>';
                    }
                }
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            // No matching blood requests found
            echo 'No blood requests available for this blood type.';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Check if the bloodGroup parameter is set in the GET request
if (isset($_GET['bloodGroup'])) {
    $bloodGroupFilter = $_GET['bloodGroup'];
    searchBloodRequests($bloodGroupFilter);
} else {
    echo "Invalid request.";
}
?>
