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
<html>

<head>
    <title>CV Templates</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="../../Portfolio-main/images/Logo-removebg-preview (1).png">
</head>

<body>
        <div class="container">
            <nav class="navbar">
                <div class="max-width">
                    <div class="logo1"><img src="../images/Logo-removebg-preview (1).png"
                            style="height: 70px; width: 70px;"></div>
                    <div class="logo"><a href="">Hold My <span>CV.</span></a></div>
                    <ul class="menu">
                        <li><a href="../index.php" class="menu-btn">Home</a></li>
                        <!-- <li><a href="#about" class="menu-btn">About</a></li> -->
                        <!-- <li><a href="#services" class="menu-btn">Services</a></li> -->
                        <!-- <li><a href="#teams" class="menu-btn">Teams</a></li> -->
                        <!-- <li><a href="#contact" class="menu-btn">Contact</a></li> -->
                        <!-- <li><a href="#template" class="menu-btn">Templates</a></li> -->
                        <!-- <li><a href="#login" class="menu-btn">Login</a></li> -->
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
        </div>

    <main>
        <section class="hero">
            <h1 class="hero-title">Best CV Templates for Your Industry</h1><br>
            <p class="hero-subtitle">Find the perfect template to showcase your skills and experience.</p>
            <a href="../cvinput/index.html"><button class="btn hero-btn">Submit Your Information</button></a>
        </section>

        <section class="templates">
            <h2 class="section-title">Pick a Template for Your CV</h2>
            <div class="template-grid">
                <div class="template professional">
                    <a href="../All_templates/template_1/template3.html">
                        <img src="../../Portfolio-main/Template_choose/images/template1.png" alt="Professional Template"
                            class="template-img"></a>
                    <a href="../All_templates/template_1/template3.html">
                        <button class="btn template-title">Professional</button></a>
                    <!-- <h3 class="template-title"><a href="">Professional</a></h3> -->
                </div>
                <div class="template modern">
                    <a href="../All_templates/template_1/resume2.html">
                        <img src="../../Portfolio-main/Template_choose/images/template3.png" alt="Modern Template"
                            class="template-img"></a>
                    <a href="../All_templates/template_1/resume2.html">
                        <button class="btn template-title">Modern</button></a>
                </div>
                <!-- <div class="template creative">
                    <a href="../All_templates/template_1/template4.html">
                        <img src="../Template_choose/images/template4.png" alt="Creative Template"
                            class="template-img"></a>
                    <a href="../All_templates/template_1/template4.html">
                        <button class="btn template-title">Creative</button></a>
                </div> -->
                <div class="template basic">
                    <a href="../All_templates/template_1/template1.html">
                        <img src="../../Portfolio-main/Template_choose/images/template2.png" alt="Basic Template"
                            class="template-img"></a>
                    <a href="../All_templates/template_1/template1.html">
                        <button class="btn template-title">Basic</button></a>
                </div>
            </div>
            <!-- <button class="btn see-all-btn">See All CV Templates</button> -->
        </section>
    </main>
    <!-- <script src="script.js"></script> -->
</body>


</html>