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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="icon" href="/Portfolio-main/images/Logo-removebg-preview (1).png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div id="preloader">
    </div>
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
                <li><a href="/Portfolio-main/Template_choose/templates.php" class="menu-btn">Templates</a></li>
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
                <h2 class="text">
                    BUILD YOUR
                    <span>
                        CV With Us!
                    </span>
                </h2>
                <h2 class="text1">
                    Are you ready ??
                    <span>
                        Lets do this .
                    </span>
                </h2>
                <div class="container">
                    <div class="dropdown">
                        <button class="dropdown1"> Build CV </button>
                        <div class="dropdown2">
                            <a href="Template_choose/templates.html">Templates</a>
                            <a href="/Portfolio-main/Login/login.php">Log In</a>
                            <a href="/Portfolio-main/Login/registration.php">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <script type="text/javascript" src="vanilla-tilt.js"></script>
    <script type="text/javascript">
        VanillaTilt.init(document.querySelectorAll(".content"), {
            max: 15,
            speed: 500,
            glare: true,
            "max-glare": 1,
        });
    </script>

    <!-- about section start -->
    <section class="about" id="about">
        <div class="max-width">
            <h2 class="title">Why Choose Us?</h2>
            <div class="about-content">
                <div class="column left">
                    <img src="/Portfolio-main/images/pexels-veeterzy-303383.jpg" alt="">
                </div>
                <div class="column right">
                    <div class="text">We Provide <span class="typing-2"></span></div>
                    <p>"Empowerment through Precision: Our platform offers intuitive tools that streamline the creation
                        of professional CVs
                        tailored to your industry. From customizable templates to expert tips, we ensure your CV
                        reflects your unique strengths
                        and experiences with clarity and impact." </p>
                    <a href="#">Know more</a>
                </div>
            </div>
        </div>
    </section>

    <!-- services section start -->
    <section class="services" id="services">
        <div class="max-width">
            <h2 class="title">Our services</h2>
            <div class="serv-content">
                <div class="card">
                    <div class="box">
                        <i class="fas fa-code "></i>
                        <div class="text">Privacy</div>
                        <p>"Your Data, Our Privacy: We prioritize your privacy. We adhere to
                            stringent data protection
                            to ensure your personal data remains safe and secure." </p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-paint-brush"></i>
                        <div class="text">Variety</div>
                        <p>"Tailored Templates for Every Career Path: Choose from a diverse array of professionally
                            designed templates crafted to
                            suit various industries and career stages. "
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-chart-line"></i>
                        <div class="text">Work Assurance</div>
                        <p>"Guaranteed Results: We stand behind the quality of our CVs.You
                            can be confident in the
                            effectiveness of your resume. ."</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <!-- teams section start -->
    <section class="teams" id="teams">
        <div class="max-width">
            <h2 class="title"">About Us</h2>
            <div class=" carousel owl-carousel">
                <div class="card">
                    <div class="box">
                        <img src="/Portfolio-main/images/Rudranath.jpg" alt="">
                        <div class="text">Rudranath Nandi</div>
                        <p>A Computer Science Student.A full Stack Web Developer.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <img src="/Portfolio-main/images/Souvik Basu.jpg" alt="">
                        <div class="text">Souvik Basu</div>
                        <p>A Full Stack Web Developer,PC Game Developer,AR/VR developer and a Data Scientist Beginner
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <img src="images/abhi.jpeg" alt="">
                        <div class="text">Abhinaba Mukherjee</div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <img src="images/tanay.jpeg" alt="">
                        <div class="text">Tanay Kumar</div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <img src="images/sahil.jpg" alt="">
                        <div class="text"> Sk Sahil </div>
                        <p>Chief Executive of SpartanX.GS of BC Roy Engineering College. </p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <img src="images/prittish.jpg" alt="">
                        <div class="text">Prittish Roy</div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <img src="images/Indra.jpeg" alt="">
                        <div class="text">Indrajit Sadhu</div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
        </div>
        </div>
    </section>


    <script src="/app.js"></script>


    <!-- contact section start -->
    <section class="contact" id="contact" style="background-color: black; color: white;">
        <div class="max-width">
            <h2 class="title">Contact Us</h2>
            <div class="contact-content">
                <div class="column left">
                    <div class="text">Get in Touch</div>
                    <p>Get in touch With us. By mailing us or if you want to join our team for learning or helping any
                        purpose Juzt mail us your purpose along with your contact number. We will contact you shortly.
                    </p>
                    <div class="icons">
                        <div class="row">
                            <i class="fas fa-user"></i>
                            <div class="info">
                                <div class="head">Name</div>
                                <div class="sub-title" style="color: wheat;">Team SpartanX</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info">
                                <div class="head">Address</div>
                                <div class="sub-title" style="color: wheat;">Durgapur, West Bengal</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-envelope"></i>
                            <div class="info">
                                <div class="head">Email</div>
                                <div class="sub-title" style="color: wheat;">xyz123@gmail.com</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column right">
                    <div class="text">Contact Us</div>
                    <form method ="post">
                        <div class="fields">
                            <div class="field name">
                                <input type="text" placeholder="Name" name="name" id="name" required>
                            </div>
                            <div class="field email">
                                <input type="email" placeholder="Email" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="field">
                            <input type="text" placeholder="Subject"  name="subject" id="subject" required>
                        </div>
                        <div class="field textarea">
                            <textarea cols="30" rows="10" placeholder="Message" name="message" id="message" required></textarea>
                        </div>
                        <div class="button-area">
                            <button type="submit" name="submit" id="submit">Send message</button>
                        </div>
                    </form>

                    <!-- <form  method="post" >
                        
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
            
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
            
            <button  type="submit" name="submit" id="submit">Submit</button>
        </form> -->
                </div>
            </div>
        </div>
    </section>

    <script>
        var loader = document.getElementById("preloader");
        window.addEventListener("load", function () {
            loader.style.display = "none"

        })
    </script>

    <script src="/Portfolio-main/script.js"></script>


</body>

</html>

<?php
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
    echo "<script>alert('You message is Successfully Send, We will contact you soon'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='index.php';</script>";
}

    // Close statement and connection
    $stmt->close();
    $conn->close();

   
}
?>