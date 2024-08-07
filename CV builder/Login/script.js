// Get the login form and error message elements
const loginForm = document.getElementById('login-form');
const errorMessage = document.getElementById('error-message');

// Add an event listener to the login form submission
loginForm.addEventListener('submit', (e) => {
    // Prevent the default form submission behavior
    e.preventDefault();

    // Get the username and password input values
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Check if the username and password are not empty
    if (username && password) {
        // Submit the form data to the server using AJAX
        fetch('login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `username=${username}&password=${password}`,
        })
            .then((response) => response.text())
            .then((message) => {
                // Check if the login was successful
                if (message.includes('Login successful!')) {
                    // Redirect to the main page
                    window.location.href = '../index.php';
                } else {
                    // Display an error message
                    errorMessage.textContent = 'Invalid username or password';
                }
            })
            .catch((error) => console.error('Error:', error));
    } else {
        // Display an error message if the username or password is empty
        errorMessage.textContent = 'Please fill in both username and password';
    }
});