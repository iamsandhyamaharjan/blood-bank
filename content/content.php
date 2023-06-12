<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Document</title>
          <link rel="stylesheet" type="text/css" href="../header/header.css">
          <link rel="stylesheet" type="text/css" href="content.css">
  <script src="../header/header.js"></script>
  <link rel="stylesheet" type="text/css" href="../footer/footer.css">
  <script src="../footer/footer.js"></script>j
</head>
<?php
  // Include file2.php
  include '../header/header.php';
  ?>
  
  <div class="search-container" style="text-align: center;">
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search..." style="padding: 10px; font-size: 18px; border: 2px solid #ccc; border-radius: 5px; margin:20px">
        <input type="submit" value="Search" style="padding: 10px 20px; font-size: 18px; background-color:#cf3d3c; color: white; border: none; border-radius: 5px; cursor: pointer;">
    </form>
</div>

  <?php

    // Sample data
    $donors = [
        [
            'name' => 'John Doe',
            'bloodType' => 'O+',
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSd_ui0Tekyz_0dDSltOAhUVas91ry8fKanqwLmoAiG&s'
        ],
        [
            'name' => 'Jane Smith',
            'bloodType' => 'A-',
            'image' => 'https://www.shutterstock.com/image-photo/smiling-confident-manipuri-north-east-260nw-1583713921.jpg'
        ],
        [
            'name' => 'Michael Johnson',
            'bloodType' => 'B+',
            'image' => 'michael-johnson.jpg'
        ],
        [
            'name' => 'Emily Davis',
            'bloodType' => 'AB-',
            'image' => 'emily-davis.jpg'
        ],
        // Add more donor data here if needed
    ];
    
    if (isset($_GET['search'])) {
          $search = $_GET['search'];
          $donors = array_filter($donors, function ($donor) use ($search) {
              return stripos($donor['name'], $search) !== false;
          });
      }
    // Generate cards
    foreach ($donors as $donor) {
        echo '<div class="card">';
        echo '<img src="' . $donor['image'] . '" alt="Donor Image">';
        echo '<div class="donor-info">';
        echo '<h3>' . $donor['name'] . '</h3>';
        echo '<p>Blood Type: ' . $donor['bloodType'] . '</p>';
        echo '</div>';
        echo '</div>';
    }
    ?>

  <?php
  // Include file2.php
  include '../footer copy/footer.php';
  ?> 
</body>
</html>