<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer files
require 'PhpMailer/Exception.php';
require 'PhpMailer/PHPMailer.php';
require 'PhpMailer/SMTP.php';

// Only process POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    // Validate inputs
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    if (empty($message)) {
        $errors[] = "Message is required";
    }

    if (empty($errors)) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'abhinabaofficial2048@gmail.com';
            $mail->Password   = 'usjg zgaj eyjl lmfm';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            // Recipients
            $mail->setFrom($email, 'Hold My CV');
            $mail->addAddress('abhinabaofficial2048@gmail.com', 'Hold My CV');
            $mail->addReplyTo($email, $name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'New Contact Form Submission from ' . $name;
            
            $mail->Body    = '
                <h2>New Contact Form Submission</h2>
                <p><strong>Name:</strong> ' . $name . '</p>
                <p><strong>Email:</strong> ' . $email . '</p>
                <p><strong>Message:</strong></p>
                <p>' . nl2br($message) . '</p>
                <p><em>This email was sent from your website contact form.</em></p>
            ';
            
            $mail->AltBody = "
                New Contact Form Submission\n
                Name: $name\n
                Email: $email\n
                Message:\n
                $message\n\n
                This email was sent from your website contact form.
            ";

            $mail->send();
            echo 'Thank you for your message! We will get back to you soon.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo implode("<br>", $errors);
    }
} else {
    echo "Invalid request method.";
}
?>