<?php
session_start();
include('../connect.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $Password = $_POST['Password'];

        // Prepare the query using parameterized statements to avoid SQL injection
        $q = $db->prepare("SELECT * FROM admin WHERE uname=:username AND pass=:Password");
        $q->bindParam(':username', $username);
        $q->bindParam(':Password', $Password);
        $q->execute();

        // Fetch the result
        $res = $q->fetchAll(PDO::FETCH_OBJ);

        if ($res) {
            echo "<script>window.location.href = '../admin/admin-home.php';</script>";
            $_SESSION['admin'] = $username;
            exit(); // Make sure to exit after redirecting
        } else {
            echo "<script>alert('Wrong user');</script>";
        }
    } elseif (isset($_POST['signup'])) {
        // Get form data
        $name = $_POST['name'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $contact = $_POST['contact'];
        $bloodgroup = $_POST['bloodgroup'];
        $Password = $_POST['Password'];
        $role = $_POST['role'];

        // Check role and save data accordingly
        if ($role === 'recipient') {
            saveRecipientData($name, $address, $age, $contact, $bloodgroup, $Password);
        } elseif ($role === 'donor') {
            saveDonorData($name, $address, $age, $contact, $bloodgroup, $Password);
        }
    } elseif (isset($_POST['submit-login'])) {
        $username = $_POST['username'];
        $Password = $_POST['Password'];
        $role = $_POST['role'];

        try {
            if ($role === 'recipient') {
                $q = $db->prepare("SELECT * FROM recipient WHERE name=:username AND Password=:Password");
                $q->bindParam(':username', $username);
                $q->bindParam(':Password', $Password);
                $q->execute();

                // Fetch the result
                $res = $q->fetchAll(PDO::FETCH_OBJ);

                if ($res) {
                   
                    echo "<script>window.location.href = '../recipient/recipient.php';</script>";
                    $_SESSION['recipient'] = $username;
                    exit(); // Make sure to exit after redirecting
                } else {
                    echo "<script>alert('Wrong user');</script>";
                }
            } elseif ($role === 'donor') {
                $q = $db->prepare("SELECT * FROM donors WHERE name=:username AND Password=:Password");
                $q->bindParam(':username', $username);
                $q->bindParam(':Password', $Password);
                $q->execute();

                // Fetch the result
                $res = $q->fetchAll(PDO::FETCH_OBJ);

                if ($res) {
                  
                    echo "<script>window.location.href = '../donor/donor.php';</script>";
                    $_SESSION['donor'] = $username;
                    exit(); // Make sure to exit after redirecting
                } else {
                    echo "<script>alert('Wrong user');</script>";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

function saveRecipientData($name, $address, $age, $contact, $bloodgroup, $Password)
{
    global $db;
    try {
        // Prepare the query using parameterized statements to avoid SQL injection
        $q = $db->prepare("INSERT INTO recipient (name, address, age, contact, bloodgroup, Password) VALUES (:name, :address, :age, :contact, :bloodgroup, :Password)");
        $q->bindParam(':name', $name);
        $q->bindParam(':address', $address);
        $q->bindParam(':age', $age);
        $q->bindParam(':contact', $contact);
        $q->bindParam(':bloodgroup', $bloodgroup);
        $q->bindParam(':Password', $Password);
        $q->execute();

        echo "Recipient data saved successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function saveDonorData($name, $address, $age, $contact, $bloodgroup, $Password)
{
    global $db;
    try {
        // Prepare the query using parameterized statements to avoid SQL injection
        $q = $db->prepare("INSERT INTO donors (name, address, age, contact, bloodgroup, Password) VALUES (:name, :address, :age, :contact, :bloodgroup, :Password)");
        $q->bindParam(':name', $name);
        $q->bindParam(':address', $address);
        $q->bindParam(':age', $age);
        $q->bindParam(':contact', $contact);
        $q->bindParam(':bloodgroup', $bloodgroup);
        $q->bindParam(':Password', $Password);
        $q->execute();

        echo "Donor data saved successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$isDonorLoggedIn = isset($_SESSION['donor']);
$isRecipientLoggedIn = isset($_SESSION['recipient']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Responsive Navbar</title>
    <link rel="stylesheet" type="text/css" href="header.css">
    <script src="header.js"></script>
    <link rel="stylesheet" type="text/css" href="../content/content.css">
    <link rel="stylesheet" type="text/css" href="../footer/footer.css">
</head>

<body>

    <div class="navbar">
        <div>
            <ul class="navbar-nav">
                <img class="blood-logo" src="https://assets.rumsan.com/esatya/hlb-navbar-logo.png">

                <?php if ($isRecipientLoggedIn): ?>
                <li><a href="#"> Home</a></li>
                <li><a href="../profile/profile.php">Profile</a></li>
                <li><a href="../blood-request/blood-request.php">Requests Blood</a></li>
                <li><a href="../blood-donate-list/blood-donate-list.php">Blood Donation</a></li>
               
            <?php elseif ($isDonorLoggedIn): ?>
                <li><a href="#"> Home</a></li>
                <li><a href="../profile/profile.php">Profile</a></li>
                <li><a href="../blood-donate/blood-donate.php">Donate Blood</a></li>
                <li><a href="../blood-request-list/blood-request-list.php">Blood Requests</a></li>
                
            <?php else: ?>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
            <?php endif; ?>
            </ul>
        </div>
        <ul class="navbar-nav ml-auto">
            <?php if ($isDonorLoggedIn || $isRecipientLoggedIn): ?>
                <li><a href="../logout/logout.php" >Logout</a></li>
            <?php else: ?>
                <li><a href="#" onclick="openModal()">Admin</a></li>
                <li class="dropdown">
                    <a href="#" onclick="toggleDropdown()">User</a>
                    <div id="dropdown-content" class="dropdown-content">
                        <a href="#" style="color: black;" onclick="openSignModal()">Sign Up</a>
                        <a href="#" style="color: black;" onclick="openLoginModal()">Login</a>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form action="" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username">
                <br>
                <label for="Password">Password:</label>
                <input type="password" id="Password" name="Password" placeholder="Enter your password">
                <br>
                <input type="submit" name="submit" value="Login">
            </form>
        </div>
    </div>
    <div id="smodal" class="smodal">
        <div class="smodal-content">
            <span class="close" onclick="closeModal()">&times;</span>

            <form action="#" method="post">
    <table>
      <tr>
        <td><label for="name">Name:</label></td>
        <td><input type="text" id="name" name="name" placeholder="Enter your name"></td>
      </tr>
      <tr>
        <td style="padding-top: 10px;"><label for="address">Address:</label></td>
        <td style="padding-top: 10px;"><input type="text" id="address" name="address" placeholder="Enter your address"></td>
      </tr>
      <tr>
        <td style="padding-top: 10px;"><label for="age">Age:</label></td>
        <td style="padding-top: 10px;"><input type="number" id="age" name="age" placeholder="Enter your age"></td>
      </tr>
      <tr>
        <td style="padding-top: 10px;"><label for="contact">Contact:</label></td>
        <td style="padding-top: 10px;"><input type="text" id="contact" name="contact" placeholder="Enter your contact number"></td>
      </tr>
      <tr>
        <td style="padding-top: 10px;"><label for="bloodgroup">Blood Group:</label></td>
        <td style="padding-top: 10px;"><input type="text" id="bloodgroup" name="bloodgroup" placeholder="Enter your blood group"></td>
      </tr>
      <tr>
        <td style="padding-top: 10px;"><label for="signup-password">Password:</label></td>
        <td style="padding-top: 10px;"><input type="password" id="signup-password" name="password" placeholder="Enter your password"></td>
      </tr>
      <tr>
        <td style="padding-top: 10px;"><label for="role">Role:</label></td>
        <td style="padding-top: 10px;">
          <select id="role" name="role">
            <option value="donor">Donor</option>
            <option value="recipient">Recipient</option>
          </select>
        </td>
      </tr>
    </table>
    <br>
    <input type="submit" name="signup" value="Sign Up">
  </form>

        </div>
    </div>
    <div id="loginmodal" class="loginmodal">
        <div class="loginmodal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form action="#" method="post">
    <table>
      <tr>
        <td><label for="login-username">Username:</label></td>
        <td><input type="text" id="login-username" name="username" placeholder="Enter your username"></td>
      </tr>
      <tr>
        <td style="padding-top: 10px;"><label for="login-password">Password:</label></td>
        <td style="padding-top: 10px;><input type="password" id="login-password" name="password" placeholder="Enter your password"></td>
      </tr>
    </table>
    <br>
    <input type="submit" name="login" value="Login">
  </form>
        </div>
    </div>

</body>
</html>


