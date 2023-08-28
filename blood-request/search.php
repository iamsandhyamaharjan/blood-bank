<?php
include('../connect.php');

$search = $_POST['search'];

try {
    $stmt = $db->prepare("SELECT * FROM blood b INNER JOIN donors d ON b.DonorId = d.id WHERE d.BloodGroup LIKE :search");
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
        echo '<table class="content-table">';
        echo '<thead><tr><th>Name</th><th>Address</th><th>Age</th><th>Contact</th><th>Blood Group</th><th>Action</th></tr></thead>';
        echo '<tbody>';

        foreach ($results as $result) {
            echo '<tr>';
            echo '<td>' . $result['Name'] . '</td>';
            echo '<td>' . $result['Address'] . '</td>';
            echo '<td>' . $result['Age'] . '</td>';
            echo '<td>' . $result['Contact'] . '</td>';
            echo '<td>' . $result['BloodType'] . '</td>';
            echo '<td><button>Contact</button></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'No results found';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
