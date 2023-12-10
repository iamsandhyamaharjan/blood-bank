<?php
// Include file2.php
include '../header/header.php';

// Include database connection
include('../connect.php');

// Function to fetch and display blood requests
function displayBloodRequests($bloodGroupFilter = '')
{
    global $db;

    try {
        $query = "SELECT * FROM request WHERE ";
        $conditions = [];

        if (!empty($bloodGroupFilter)) {
            $conditions[] = "BloodGroup = :bloodGroup";
        }

        if (empty($conditions)) {
            // No filters applied, display all blood requests
            $query .= "1"; // Dummy condition to retrieve all records
        } else {
            // Apply filters
            $query .= implode(" AND ", $conditions);
        }

        $stmt = $db->prepare($query);

        if (!empty($bloodGroupFilter)) {
            $stmt->bindValue(':bloodGroup', $bloodGroupFilter, PDO::PARAM_STR);
        }

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
                if ($request['status']== 'Approved') {
                    echo '<td>' . $request['Contact'] . '</td>';
                }
                else{
                    echo '<td>Need Approval</td>';
                }
                
                echo '<td>';
                if (!$request['status']) {
                    echo '<button type="submit" onclick="donate(this, ' . $request['id'] . ')">Donate</button>';
                } else {
                    if ($request['status'] == 'Approved') {
                        echo '<button type="submit">Approved</button>';
                    } 
                    else if($request['status'] == 'RequestedToDonate'){
                        echo '<button type="submit">Requested to Donate</button>';
                    }
                    else {
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
            echo '<h1>No blood requests available</h1>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blood Requests List</title>
    <link rel="stylesheet" type="text/css" href="../header/header.css">
    <link rel="stylesheet" type="text/css" href="../footer copy/footer.css">
    <link rel="stylesheet" type="text/css" href="../blood-request/blood-request.css">
    <link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
    <!-- Move script includes here -->
    <!-- ... -->

    <!-- Display blood requests -->
    <h2>Blood Requests List</h2>
   
    <div class="search-container">
        <input type="text" id="searchBlood" placeholder="Search by blood type...">
        <button id="searchButton">Search</button>
    </div>

    <div id="content">
        <?php displayBloodRequests(); ?>
    </div>

    <!-- Move script includes here -->
    <script src="../header/header.js"></script>
    <script src="../footer/footer.js"></script>
    <script src="blood-request-list.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to be executed when the "Search" button is clicked
        function handleSearchButtonClick() {
            // Get the value of the input box
            var bloodTypeValue = document.getElementById("searchBlood").value;

            // Clear the existing content
            document.getElementById("content").innerHTML = '';

            // Make an AJAX request to fetch blood requests based on the blood type
            $.ajax({
                type: "POST",
                url: "search-blood-requests.php", // Create a separate PHP file for handling the AJAX request
                data: {
                    bloodType: bloodTypeValue
                },
                success: function (response) {
                    // Update the content with the fetched data
                    document.getElementById("content").innerHTML = response;
                },
                error: function () {
                    console.error("An error occurred during the AJAX request.");
                }
            });
        }

        // Attach an event listener to the "Search" button when the DOM is ready
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("searchButton").addEventListener("click", handleSearchButtonClick);
        });
    </script>
</body>
</html>

<?php
// Include file2.php
include '../footer copy/footer.php';
?>
