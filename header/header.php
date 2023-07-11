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
    <link rel="stylesheet" type="text/css" href="blood-donate-list.css">
</head>

<body>

    <header>
        <div class="logo">
            <img src="https://assets.rumsan.com/esatya/hlb-navbar-logo.png" alt="Logo">
        </div>
        <nav>
            <?php if ($isRecipientLoggedIn): ?>
                <a href="#"> Home</a>
                <a href="../profile/profile.php">Profile</a>
                <a href="../blood-request/blood-request.php">Requests Blood</a>
                <a href="../blood-donate-list/blood-donate-list.php">Blood Donation</a>
               
            <?php elseif ($isDonorLoggedIn): ?>
                <a href="#"> Home</a>
                <a href="../profile/profile.php">Profile</a>
                <a href="../blood-donate/blood-donate.php">Donate Blood</a>
                <a href="../blood-request-list/blood-request-list.php">Blood Requests</a>
                
            <?php else: ?>
                <a href="#">Home</a>
                <a href="#">About Us</a>

            <?php endif; ?>
        </nav>
        <div class="user">
            <?php if ($isDonorLoggedIn || $isRecipientLoggedIn): ?>
                <a href="../logout/logout.php" >Logout</a>
            <?php else: ?>
                <a href="#" onclick="openModal()">Admin</a>
                <div class="dropdown">
                    <a href="#" onclick="toggleDropdown()">User</a>
                    <div id="dropdown-content" class="dropdown-content">
                        <a href="#" style="color: black;" onclick="openSignModal()">Sign Up</a>
                        <a href="#" style="color: black;" onclick="openLoginModal()">Login</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form action="" method="post">
                <label for="username"></label>
                <input type="text" id="username" name="username" placeholder="Username">
                <br>
                <label for="Password"></label>
                <input type="password" id="Password" name="Password" placeholder="Password">
                <br>
                <input type="submit" name="submit" value="Login">
            </form>
        </div>
    </div>

    <div id="smodal" class="smodal">
        <div class="smodal-content">
            <span class="close" onclick="closeModal()">&times;</span>

            <form action="#" method="post" class="register">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Full Name">
                <br>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Full Address">
                <br>
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" placeholder="Age">
                <br>
                <label for="contact">Contact:</label>
                <input type="tel" id="contact" name="contact" placeholder="Contact Number">
                <br>
                <label for="bloodgroup">Blood Group:</label>
                <input type="text" id="bloodgroup" name="bloodgroup" placeholder="Blood Group">
                <br>
                <label for="Password">Password:</label>
                <input type="password"  name="Password" placeholder="Password">
                <br>
                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="donor">Donor</option>
                    <option value="recipient">Recipient</option>
                </select>
                <br>
                <input type="submit" name="signup" value="Sign Up">
            </form>
        </div>
    </div>


    <div id="loginmodal" class="loginmodal">
        <div class="loginmodal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form action="" method="post">
                <!-- Your form fields here -->
                <label for="username"></label>
                <input type="text" id="username" name="username" placeholder="Username">
                <br>
                <label for="Password"></label>
                <input  id="Password" name="Password" placeholder="Password">
                <div class="role">
                    <label for="role">Role:</label>&nbsp;&nbsp;
                    <select id="role" name="role">
                        <option value="donor">Donor</option>
                        <option value="recipient">Recipient</option>
                    </select>
                </div>
                <input type="submit" name="submit-login" value="Login">
            </form>
        </div>
    </div>     

</body>
</html>