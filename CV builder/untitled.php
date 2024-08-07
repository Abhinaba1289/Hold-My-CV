<?php
// Start the session and output buffering
session_start();
ob_start();

// Configuration for the database
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'registrationpage';

// Create a connection to the database
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOLD MY CV</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="icon" href="/Portfolio-main/images/Logo-removebg-preview (1).png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div id="preloader"></div>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
    <nav class="navbar">
        <div class="max-width">
            <div class="logo1"><img src="/Portfolio-main/images/Logo-removebg-preview (1).png" style="height: 70px; width: 70px;"></div>
            <div class="logo"><a href="">Hold My <span>CV.</span></a></div>
            <ul class="menu">
                <li><a href="#home" class="menu-btn">Home</a></li>
                <li><a href="#about" class="menu-btn">About</a></li>
                <li><a href="#services" class="menu-btn">Services</a></li>
                <li><a href="#teams" class="menu-btn">Teams</a></li>
                <li><a href="#contact" class="menu-btn">Contact</a></li>
                <li><a href="/Portfolio-main/Template_choose/templates.html" class="menu-btn">Templates</a></li>
                <?php 
                if (isset($_SESSION['username']) && $_SESSION['username'] != "") {
                    ?>
                    <!-- // echo "<li><a href='#' class='menu-btn'>" . $_SESSION['username'] . "</a></li>";? -->
                    <li><a href="#" class="menu-btn">My Profile</a></li> 
                    <li><a href='logout.php' class='menu-btn'>Logout</a></li>
                <?php
                } else { 
                    
                ?>
                    <li><a href='/Portfolio-main/Login/login.php' class='menu-btn'>Login</a></li>
                    <li><a href='/Portfolio-main/Login/registration.php' class='menu-btn'>Register</a></li>
                <?php
                }
                ?>
            </ul>
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- PlaceHolder section start -->
    <section class="home" id="home">
        <div class="front">
            <div class="content">
                <h2 class="text">BUILD YOUR <span>CV With Us!</span></h2>
                <h2 class="text1">Are you ready ?? <span>Lets do this.</span></h2>
                <div class="container">
                    <div class="dropdown">
                        <button class="dropdown1">Build CV</button>
                        <div class="dropdown2">
                            <a href="Template_choose/templates.html">Templates</a>
                            <a href="/Portfolio-main/Login/login.php">Log In</a>
                            <a href="/Portfolio-main/Login/registration.php">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Other sections omitted for brevity -->

    <script type="text/javascript" src="vanilla-tilt.js"></script>
    <script type="text/javascript">
        VanillaTilt.init(document.querySelectorAll(".content"), {
            max: 15,
            speed: 500,
            glare: true,
            "max-glare": 1,
        });
    </script>
    <script src="/Portfolio-main/script.js"></script>
</body>

</html>

<?php
// Database configuration for contact form
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "contactus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact (Name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Your message was successfully sent. We will contact you soon.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='index.php';</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
