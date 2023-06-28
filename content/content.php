<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Document</title>
          <link rel="stylesheet" type="text/css" href="../header/header.css">
          <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caprasimo&display=swap" rel="stylesheet">
          <link rel="stylesheet" type="text/css" href="content.css">
  <script src="../header/header.js"></script>
  <link rel="stylesheet" type="text/css" href="../footer/footer.css">
  <script src="../footer/footer.js"></script>
</head>
<?php
  include '../header/header.php';
  ?>
<div style="position: relative;">
    <img style="width: 100%; height: 10%;" src="https://assets.rumsan.com/esatya/hlb-banner.jpg" alt="Full Width Image">
    <h2 style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: left; color: white; font-size: 49px; font-weight: bold;font-family:'Dancing Script', cursive;">Unleash the Hero Within: Donate Blood, Inspire Hope, and Be the Lifesaver Someone Desperately Needs. Donate Blood, Save Lives!</h2>
</div>

  <div class="search-container" style="text-align: center;">
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search..." style="padding: 10px; font-size: 18px; border: 2px solid #ccc; border-radius: 5px; margin:20px">
        <input type="submit" value="Search" style="padding: 10px 20px; font-size: 18px; background-color:#cf3d3c; color: white; border: none; border-radius: 5px; cursor: pointer;">
    </form>

</div>

  <!-- <?php

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
?> -->

<h2>About Us</h2>
    <p>
        The Blood Bank Management System is a platform designed to streamline the process of managing and tracking blood donations, requests, and inventory. Our system helps connect blood donors with those in need and ensures efficient blood supply management.
    </p>

    <h2>Services</h2>
    <ul>
        <li>Blood Donation: Find information about blood donation, eligibility criteria, and schedule your donation.</li>
        <li>Blood Requests: Place requests for required blood types and connect with potential donors.</li>
        <li>Inventory Management: Keep track of available blood units, expiration dates, and update inventory levels.</li>
        <li>Donor Management: Maintain a database of registered donors, their contact information, and donation history.</li>
        <li>Reports and Analytics: Generate reports and analyze blood donation patterns to optimize operations.</li>
    </ul>

    <h2>Why Choose Us</h2>
    <ul>
        <li>Reliable Blood Supply: We ensure a constant supply of safe and quality blood for medical emergencies.</li>
        <li>User-Friendly Interface: Our user-friendly system simplifies the donation and request processes.</li>
        <li>Privacy and Security: We prioritize the confidentiality and security of donor and patient information.</li>
        <li>Efficient Management: Our system automates various tasks, reducing manual effort and improving efficiency.</li>
        <li>Community Engagement: Join a community of blood donors and recipients, making a positive impact on society.</li>
    </ul>

    <h2>Contact Us</h2>
    <p>
        If you have any questions or need assistance, please feel free to contact our support team at <a href="mailto:support@bloodbank.com">support@bloodbank.com</a>.
    </p>
</body>
</html>


  <?php
  // Include file2.php
  include '../footer copy/footer.php';
  ?> 
</body>
</html>