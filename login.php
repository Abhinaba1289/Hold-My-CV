<?php
session_start();

$title = "Login | Hold My CV";
require './assets/includes/header.php';
$fn->nonAuthPage();

if(isset($_SESSION['user'])) {
    header("Location: myresumes.php");
    exit();
}

?>

<style>
/* Inherit theme variables from home.php */
:root {
    /* Light Mode Colors */
    --light: #ffffff;
    --lighter: #f9fafb;
    --light-gray: #f3f4f6;
    --gray: #6b7280;
    --dark-gray: #374151;

    /* Dark Mode Colors */
    --dark: #121212;
    --darker: #0a0a0a;
    --dark-border: rgba(255, 255, 255, 0.1);

    /* Brand Colors */
    --primary: #6e45e2;
    --secondary: #88d3ce;
    --gradient: linear-gradient(135deg, var(--primary), var(--secondary));

    /* Current Theme Defaults */
    --bg: var(--light);
    --text: var(--dark-gray);
    --nav-bg: rgba(255, 255, 255, 0.95);
    --card-bg: var(--light);
    --border: rgba(0, 0, 0, 0.05);
    --input-bg: var(--light-gray);
}

body.dark-mode {
    --bg: var(--darker);
    --text: var(--light);
    --nav-bg: rgba(10, 10, 10, 0.95);
    --card-bg: rgba(255, 255, 255, 0.05);
    --border: var(--dark-border);
    --input-bg: rgba(255, 255, 255, 0.1);
}

.auth-container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background: var(--bg);
    padding: 2rem;
    transition: background 0.3s ease;
}

.auth-wrapper {
    width: 100%;
    max-width: 420px;
}

.auth-card {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border);
    transition: all 0.3s ease;
}

.logo-container {
    display: flex;
    gap: 1rem;
    align-items: center;
    margin-bottom: 2rem;
    justify-content: center;
}

.logo {
    height: 70px;
    width: auto;
}

.logo-text h1 {
    font-size: 1.8rem;
    font-weight: 800;
    margin: 0;
    color: var(--text);
}

.logo-text p {
    margin: 0;
    color: var(--gray);
    font-size: 0.9rem;
}

.auth-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    position: relative;
}

.form-group input {
    width: 100%;
    padding: 1rem 1rem 1rem 2.5rem;
    border: 1px solid var(--border);
    border-radius: 8px;
    background: var(--input-bg);
    color: var(--text);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-group input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(110, 69, 226, 0.1);
}

.form-group label {
    position: absolute;
    left: 2.5rem;
    top: 1rem;
    color: var(--text);
    opacity: 0.7;
    transition: all 0.3s ease;
    pointer-events: none;
}

.form-group input:focus + label,
.form-group input:not(:placeholder-shown) + label {
    transform: translate(-1.5rem, -1.8rem) scale(0.85);
    opacity: 1;
    color: var(--primary);
}

.password-toggle {
    position: absolute;
    right: 1rem;
    top: 1rem;
    cursor: pointer;
    color: var(--text);
    opacity: 0.5;
}

.auth-btn {
    background: var(--gradient);
    color: white;
    border: none;
    padding: 1rem;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(110, 69, 226, 0.3);
}

.auth-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 7px 20px rgba(110, 69, 226, 0.4);
}

.auth-links {
    display: flex;
    justify-content: space-between;
    margin-top: 1rem;
}

.link {
    color: var(--gray);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.link:hover {
    color: var(--primary);
}

.back-home-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 1.5rem;
    padding: 0.75rem;
    border-radius: 8px;
    background: var(--input-bg);
    color: var(--text);
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    border: 1px solid var(--border);
}

.back-home-btn:hover {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

@media (max-width: 576px) {
    .auth-card {
        padding: 1.5rem;
    }
    
    .logo-container {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<div class="auth-container">
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo-container">
                    <img src="./assets/images/logo.png" alt="Hold My CV Logo" class="logo">
                    <div class="logo-text">
                        <h1>Hold My CV</h1>
                        <p>Access your professional dashboard</p>
                    </div>
                </div>
            </div>

            <form method="post" action="actions/login.action.php" class="auth-form">
                <div class="form-group floating">
                    
                    <input type="email" name="email_id" id="floatingEmail" placeholder="Email address" required>
                </div>
                
                <div class="form-group floating">
                    <input type="password" name="password" id="floatingPassword" placeholder="Password" required>
                </div>

                <button type="submit" class="auth-btn">
                    <span>Login</span>
                    <i class="bi bi-box-arrow-in-right"></i>
                </button>

                <div class="auth-links">
                    <!-- <a href="forgot-password.php" class="link">Forgot Password?</a> -->
                    <a href="register.php" class="link">Create Account</a>
                </div>

                <a href="index.php" class="back-home-btn">
                    <i class="bi bi-arrow-left"></i> Back to Home
                </a>
            </form>
        </div>
    </div>
</div>

<script>
  // 1. Apply theme from localStorage
  document.addEventListener("DOMContentLoaded", () => {
    const savedTheme = localStorage.getItem("theme") || "light";
    if (savedTheme === "dark") {
      document.body.classList.add("dark-mode");
    } else {
      document.body.classList.remove("dark-mode");
    }
  });

  // 2. Password show/hide toggle
  document.querySelectorAll('.password-toggle').forEach(toggle => {
    toggle.addEventListener('click', () => {
      const passwordInput = toggle.previousElementSibling;
      const icon = toggle.querySelector('i');
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
      } else {
        passwordInput.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
      }
    });
  });
</script>
<script>
    // Only run this if you specifically want to prevent back navigation
    // to certain pages (like after login)

    // Store the current page as the "new" history entry
    history.pushState(null, null, window.location.href);

    // Handle back/forward button
    window.addEventListener('popstate', function(event) {
        // Redirect to index.php when back button is pressed
        history.pushState(null, null, 'index.php');
        window.location.href = 'index.php';
    });

    // Optional: Additional protection against cached page loads
    window.onpageshow = function(event) {
        if (event.persisted) {
            window.location.href = "index.php";
        }
    };
</script>


<?php require './assets/includes/footer.php'; ?>



