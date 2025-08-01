<?php
session_start();
$title = "Register | Hold My CV";
require './assets/includes/header.php';
$fn->nonAuthPage();
?>

<style>
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
    --primary-light: rgba(110, 69, 226, 0.1);
    --secondary: #88d3ce;
    --gradient: linear-gradient(135deg, var(--primary), var(--secondary));

    /* Current Theme Defaults */
    --bg: var(--light);
    --text: var(--dark-gray);
    --card-bg: var(--light);
    --border: rgba(0, 0, 0, 0.05);
    --input-bg: var(--light-gray);
}

body.dark-mode {
    --bg: var(--darker);
    --text: var(--light);
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
    transition: all 0.3s ease;
}

.auth-card {
    width: 100%;
    max-width: 480px;
    background: var(--card-bg);
    border-radius: 16px;
    padding: 2.5rem;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border);
    text-align: center;
}

.logo-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 2rem;
}

.logo {
    height: 80px;
    width: auto;
    margin-bottom: 1rem;
}

.auth-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0 0 0.5rem;
    color: var(--text);
    background: var(--gradient);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    display: inline-block;
}

.auth-subtitle {
    margin: 0;
    color: var(--gray);
    font-size: 1rem;
}

.auth-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-top: 2rem;
}

.form-group {
    position: relative;
    text-align: left;
}

.form-group input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: var(--input-bg);
    color: var(--text);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-group input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-light);
}

.form-group i {
    position: absolute;
    left: 1rem;
    top: 1rem;
    color: var(--text);
    opacity: 0.7;
}

.password-toggle {
    position: absolute;
    right: 1rem;
    top: 1rem;
    cursor: pointer;
    color: var(--text);
    opacity: 0.5;
    transition: opacity 0.3s ease;
}

.password-toggle:hover {
    opacity: 1;
}

.auth-btn {
    background: var(--gradient);
    color: white;
    border: none;
    padding: 1rem;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.auth-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 7px 20px rgba(110, 69, 226, 0.4);
}

.auth-links {
    display: flex;
    justify-content: space-between;
    margin-top: 1.5rem;
    font-size: 0.9rem;
}

.auth-link {
    color: var(--gray);
    text-decoration: none;
    transition: color 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.auth-link:hover {
    color: var(--primary);
}

.auth-terms {
    margin-top: 1.5rem;
    font-size: 0.8rem;
    color: var(--gray);
    line-height: 1.5;
}

.auth-terms a {
    color: var(--primary);
    text-decoration: none;
}

@media (max-width: 576px) {
    .auth-card {
        padding: 1.5rem;
    }
    
    .auth-links {
        flex-direction: column;
        gap: 0.5rem;
        align-items: center;
    }
}
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="logo-container">
            <img src="./assets/images/logo.png" alt="Hold My CV" class="logo">
            <h1 class="auth-title">Create Account</h1>
            <p class="auth-subtitle">Join our professional community</p>
        </div>

        <form method="POST" action="actions/register.action.php" class="auth-form">
            <div class="form-group">
                <i class="bi bi-person"></i>
                <input type="text" name="full_name" placeholder="Full Name" required>
            </div>

            <div class="form-group">
                <i class="bi bi-envelope"></i>
                <input type="email" name="email_id" placeholder="Email Address" required>
            </div>

            <div class="form-group">
                <i class="bi bi-key"></i>
                <input type="password" name="password" id="registerPassword" placeholder="Password" required>
                <span class="password-toggle" id="togglePassword">
                    <i class="bi bi-eye"></i>
                </span>
            </div>

            <button type="submit" class="auth-btn">
                <i class="bi bi-person-plus-fill"></i> Register Now
            </button>

            <div class="auth-links">
                <a href="login.php" class="auth-link">
                    <i class="bi bi-box-arrow-in-right"></i> Already have an account?
                </a>
                <a href="forgot-password.php" class="auth-link">
                    <!-- <i class="bi bi-question-circle"></i> Forgot password? -->
                </a>
            </div>

            <p class="auth-terms">
                By registering, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
            </p>
        </form>
    </div>
</div>

<script>
// Theme handling
document.addEventListener("DOMContentLoaded", () => {
    const savedTheme = localStorage.getItem("theme") || "light";
    document.body.classList.toggle("dark-mode", savedTheme === "dark");
    
    // Password toggle functionality
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#registerPassword');
    const icon = togglePassword.querySelector('i');
    
    togglePassword.addEventListener('click', () => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    });
});
</script>

<?php require './assets/includes/footer.php'; ?>