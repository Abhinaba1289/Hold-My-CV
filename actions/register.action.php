<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ==============================================
// DATABASE CONNECTION (Self-contained)
// ==============================================
$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = '';
$db_name = 'resume';

$db = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($db->connect_error) {
    die("Database connection failed: " . $db->connect_error);
}

// ==============================================
// ESSENTIAL FUNCTIONS (Self-contained)
// ==============================================
class SimpleFunctions {
    public function redirect($url) {
        header("Location: $url");
        exit();
    }
    
    public function setError($message) {
        $_SESSION['error'] = $message;
    }
    
    public function setAlert($message) {
        $_SESSION['alert'] = $message;
    }
}

$fn = new SimpleFunctions();

// ==============================================
// REGISTRATION PROCESSING
// ==============================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // 1. Validate required fields
        $required = ['full_name', 'email_id', 'password'];
        $missing = array_filter($required, fn($field) => empty($_POST[$field] ?? ''));
        
        if (!empty($missing)) {
            throw new Exception('Missing fields: ' . implode(', ', $missing));
        }

        // 2. Sanitize inputs
        $full_name = $db->real_escape_string(trim($_POST['full_name']));
        $email_id = $db->real_escape_string(trim($_POST['email_id']));
        $password = md5($db->real_escape_string(trim($_POST['password'])));
        $created_at = date('Y-m-d H:i:s');

        // 3. Validate email format
        if (!filter_var($email_id, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        // 4. Check if email exists
        $check = $db->query("SELECT id FROM details WHERE email_id = '$email_id' LIMIT 1");
        if ($check && $check->num_rows > 0) {
            throw new Exception("Email already registered");
        }

        // 5. Insert new user
        $insert = $db->query("INSERT INTO details 
                            (full_name, email_id, password, created_at) 
                            VALUES ('$full_name', '$email_id', '$password', '$created_at')");
        
        if (!$insert) {
            throw new Exception("Registration failed: " . $db->error);
        }

        // 6. Success
        $fn->setAlert('Registration successful! Please login');
        $fn->redirect('../login.php');

    } catch (Exception $e) {
        $fn->setError($e->getMessage());
        $fn->redirect('../register.php');
    }
} else {
    $fn->setError('Invalid request');
    $fn->redirect('../register.php');
}