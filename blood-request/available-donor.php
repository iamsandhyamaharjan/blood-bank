<?php
// Include file2.php
include '../header/header.php';

// Include database connection
include('../connect.php');

// Function to fetch and display donors
function displayDonors($addressFilter = '', $bloodGroupFilter = '')
{
    global $db;

    try {
        $query = "SELECT * FROM donors WHERE ";
        $conditions = [];

        if (!empty($addressFilter)) {
            $conditions[] = "Address LIKE :address";
        }

        if (!empty($bloodGroupFilter)) {
            $conditions[] = "BloodGroup = :bloodGroup";
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

                echo '<td>' . $donor['BloodGroup'] . '</td>';
                
                echo '<td><button>Request</button></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            // No matching donors found
            echo '<h1>No donors available.</h1>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Donors</title>
    <link rel="stylesheet" type="text/css" href="../header/header.css">
    <link rel="stylesheet" type="text/css" href="../footer copy/footer.css">
    <link rel="stylesheet" type="text/css" href="blood-request.css">
    <link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
    <!-- Move script includes here -->
    <!-- ... -->

    <!-- Display donors -->
    <h2>Available Donors</h2>
   
    <div class="search-container">
        <input type="text" id="searchAddress" placeholder="Search by address...">
        <input type="text" id="searchBlood" placeholder="Search by blood type...">
        <button id="searchButton">Search</button>
    </div>

    <div id="content">
        <?php displayDonors(); ?>
    </div>

    <!-- Move script includes here -->
    <script src="../header/header.js"></script>
    <script src="../footer/footer.js"></script>
    <!-- <script src="blood-donate-list.js"></script> -->
    <script src="blood-request.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to be executed when the "Search" button is clicked
        function handleSearchButtonClick() {
            // Get the values of the input boxes
            var addressValue = document.getElementById("searchAddress").value;
            var bloodTypeValue = document.getElementById("searchBlood").value;

            // Clear the existing content
            document.getElementById("content").innerHTML = '';

            // Call displayDonors with the filter values
            $.ajax({
                type: "POST",
                url: "search-donor.php", // Create a separate PHP file for handling the AJAX request
                data: {
                    address: addressValue,
                    bloodGroup: bloodTypeValue
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
