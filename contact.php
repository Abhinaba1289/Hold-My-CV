<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hold My CV - Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="contact.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="nav">
        <a href="home.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact Us</a>
        <a style="background-color:#231c8f; color:white; border-radius: 40px;" href="login.php">Log in<i style="padding:0px 5px" class="fa-solid fa-right-to-bracket"></i></a>
    </div>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="container-contact">
            <h2 class="title">Get In Touch</h2>
            <div class="contact-content">
                <div class="column left">
                    <div class="text">Contact Information</div>
                    <p>Get in touch with us. Whether you want to join our team, learn, or help, just send us your purpose along with your contact number, and we’ll get back to you shortly.</p>
                    <div class="icons">
                        <div class="row">
                            <i class="fas fa-user"></i>
                            <div class="info">
                                <div class="head">Name</div>
                                <div class="sub-title">Team SpartanX</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info">
                                <div class="head">Address</div>
                                <div class="sub-title">Durgapur, West Bengal</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-envelope"></i>
                            <div class="info">
                                <div class="head">Email</div>
                                <div class="sub-title">xyz123@gmail.com</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column right">
                    <div class="text">Send Us a Message</div>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" placeholder="Name" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Email" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Subject" name="subject" id="subject" required>
                        </div>
                        <div class="form-group">
                            <textarea cols="30" rows="10" placeholder="Message" name="message" id="message" required></textarea>
                        </div>
                        <div class="button-area">
                            <button type="submit" name="submit" id="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
            
