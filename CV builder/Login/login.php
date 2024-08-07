<?php
session_start(); // Start the session at the beginning

// Configuration
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

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the username and password
    if (empty($username) || empty($password)) {
        echo "<script>alert('Please enter both username and password');</script>";
        exit;
    }

    // Query the database to verify the credentials
    $query = "SELECT * FROM users WHERE username = '".$username."'";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query returns a result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Check if the password is correct
        if (password_verify($password, $hashedPassword)) {
            // Login successful, display a success message
            $_SESSION['username'] = $username;
            header('Location: ../index.php');
            exit;
        } else {
            // Login failed, display an error message
            echo "<script>alert('Invalid username or password');</script>";
        }
    } else {
        // Login failed, display an error message
        echo "<script>alert('Invalid username or password');</script>";
    }

    // Close statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form id="login-form" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p id="error-message"></p>
    </div>

    <!-- <script src="script.js"></script> -->
</body>
</html>
