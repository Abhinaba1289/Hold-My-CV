<!DOCTYPE html>
<html class="light-mode" lang="en">
<!-- <html lang="en"> -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hold My CV - Modern Resume Builder</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
   
</head>
<body>
    <!-- Navigation Bar -->
    <div class="nav">
        <div class="nav-container">
            <a href="#" class="nav-logo">Hold <span>MyCV</span></a>
            <div class="hamburger" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="nav-links">
                <a href="#home">Home</a>
                <a href="#features">Features</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
                <a class="btn btn-primary login-btn" href="login.php">Log in <i class="fa-solid fa-right-to-bracket"></i></a>
                <div class="theme-toggle">
                    <input type="checkbox" id="darkModeToggle" class="toggle-checkbox">
                    <label for="darkModeToggle" class="toggle-label">
                        <i class="fas fa-sun"></i>
                        <i class="fas fa-moon"></i>
                        <span class="toggle-ball"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

     <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="content">
                <h1 class="hero-title">Craft Your Perfect <span class="gradient-text">Resume</span> in Minutes</h1>
                <p class="subtitle">Stand out from the crowd with our professionally designed templates that get results.</p>
                <a class="cta-btn" href="register.php">Get started - It's free✨<i class="fas fa-sparkle"></i></a>
            </div>
            <div class="resume-preview">
                <div class="gradient-border floating">
                    <img src="./assets/class/main-img.jpg" alt="Resume Sample" class="resume-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="section-header">
            <h2>Why Choose <span class="gradient-text">Hold My CV</span></h2>
            <p class="section-subtitle">Everything you need to land your dream job</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-magic"></i>
                </div>
                <h3>Professional Templates</h3>
                <p>ATS-friendly designs that get your resume noticed by recruiters. Currently Single template available.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Quick & Easy</h3>
                <p>Create a polished resume in minutes with our intuitive builder.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-cloud-arrow-down"></i>
                </div>
                <h3>Multiple Formats</h3>
                <p>Download in PDF, Word, or plain text with one click. Currenly PDF version is available.</p>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="section-header">
                    <h2>About <span class="gradient-text">Our Mission</span></h2>
                </div>
                <div class="about-grid">
                    <div class="about-text">
                        <p>We're revolutionizing the job search process with tools that help candidates present their best professional selves.</p>
                        <p>Our platform combines cutting-edge design with data-driven optimization to maximize your interview chances.</p>
                        <div class="stats">
                            <div class="stat-item">
                                <div class="stat-number">10K+</div>
                                <div class="stat-label">Resumes Created</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">95%</div>
                                <div class="stat-label">User Satisfaction</div>
                            </div>
                        </div>
                    </div>
                    <div class="about-image">
                        <div class="gradient-border">
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Our Team">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="section-header">
                <h2>Get In <span class="gradient-text">Touch</span></h2>
                <p class="section-subtitle">We'd love to hear from you</p>
            </div>
            <div class="contact-container">
                <div class="contact-info">
                    <div class="info-card">
                        <div>
                            <i class="fas fa-envelope"></i>
                            <h3>Email Us</h3>
                        </div>
                        <p>support@holdmycv.com</p>
                    </div>
                    <div class="info-card">
                        <div>
                            <i class="fas fa-phone"></i>
                            <h3>Call Us</h3>
                        </div>
                        <p>+1 (555) 123-4567</p>
                    </div>
                    <div class="info-card">
                        <div>
                            <i class="fas fa-map-marker-alt"></i>
                            <h3>Visit Us</h3>
                        </div>
                        <p>123 Resume Street, Career City</p>
                    </div>
                </div>
                <!-- <div class="contact-form">
                    <form action="sendmsg.php"  method="POST" id="contactForm">
                        <div class="form-group">
                            <input type="text" id="name" name="name" required placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" required placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <textarea id="message" name="message" rows="5" required placeholder="Your Message"></textarea>
                        </div>
                        
                        <button type="submit" name="send" class="submit-btn">Send Message <i class="fas fa-paper-plane"></i></button>
                        <div id="formResponse" style="margin-top: 15px;"></div>
                    </form>
                </div> -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <div class="f-logo">Hold <span>MyCV</span></div>
                <p>Crafting resumes that get results</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                </div>
            </div>
            <div class="footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h3>Legal</h3>
                <ul>
                    <li><a href="">Privacy Policy</a></li>
                    <li><a href="">Terms of Service</a></li>
                    <li><a href="">Cookie Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Hold My CV. All rights reserved.</p>
        </div>
    </footer>

    
    <script>
        // Theme Toggle Functionality
        const darkModeToggle = document.getElementById('darkModeToggle');
        const body = document.body;
        const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');

        // Check for saved user preference or use system preference
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme === 'dark') {
            body.classList.add('dark-mode');
            darkModeToggle.checked = true;
        } else if (currentTheme === 'light') {
            body.classList.remove('dark-mode');
            darkModeToggle.checked = false;
        } else if (prefersDarkScheme.matches) {
            body.classList.add('dark-mode');
            darkModeToggle.checked = true;
        }

        // Toggle theme on button click
        darkModeToggle.addEventListener('change', function() {
            if (darkModeToggle.checked) {
                body.classList.add('dark-mode');
                localStorage.setItem('theme', 'dark');
            } else {
                body.classList.remove('dark-mode');
                localStorage.setItem('theme', 'light');
            }
        });

        // Mobile Menu Toggle
        function toggleMenu() {
            const hamburger = document.querySelector('.hamburger');
            const navLinks = document.querySelector('.nav-links');
            
            hamburger.classList.toggle('open');
            navLinks.classList.toggle('active');
            
            // Toggle body scroll when menu is open
            if (navLinks.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'auto';
            }
        }
        
        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 992) {
                    toggleMenu();
                }
            });
        });
        
        // Logo click handler - reloads page or goes to home
        document.querySelector('.nav-logo').addEventListener('click', function(e) {
            if (window.location.hash !== '#home') {
                e.preventDefault();
                window.location.href = '#home';
                window.scrollTo(0, 0);
            }
        });




        window.history.pushState(null, null, window.location.href);
    
        // Handle back/forward button
        window.addEventListener('popstate', function(event) {
            
            
            // Alternative: You could also redirect to home.php
            window.location.href = window.location.href;
        });



        // Form Submission Handling

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('contactForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const form = this;
                const formData = new FormData(form);
                const responseDiv = document.getElementById('formResponse');
                responseDiv.innerHTML = '<p style="color: blue;">Sending your message...</p>';
                
                fetch(form.action, {
                    method: form.method,
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    // Check for success message (now matches PHP output)
                    if (data.includes('Thank you')) {
                        responseDiv.innerHTML = `<p style="color: green;">${data}</p>`;
                        form.reset();
                    } else {
                        responseDiv.innerHTML = `<p style="color: red;">${data}</p>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    responseDiv.innerHTML = '<p style="color: red;">Sorry, there was an error submitting your form. Please try again.</p>';
                });
            });
        });
      
    </script>
    
</body>
</html>


  



