<?php
header('Content-Type: application/json');

// Load Composer-style PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library files
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

// Config
$to = 'info@amanicoaching.org'; // Recipient (usually same as sender)
$fromEmail = 'info@amanicoaching.org';
$fromName = 'Amani Coaching and Consulting LLC';
$emailPassword = 'Amanicoaching1!'; // 🔐 Replace with actual email password

// Sanitize input
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validation
if (empty($name) || empty($email) || empty($message)) {
    echo json_encode([
        'status' => 'error',
        'alert' => 'alert-danger',
        'message' => 'All fields are required. Please fill out the form.'
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'status' => 'error',
        'alert' => 'alert-danger',
        'message' => 'Please enter a valid email address.'
    ]);
    exit;
}

$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->Username = $fromEmail;
    $mail->Password = $emailPassword;
    $mail->SMTPSecure = 'ssl'; // or 'tls'
    $mail->Port = 465; // 587 if using 'tls'

    // Recipients
    $mail->setFrom($fromEmail, $fromName);
    $mail->addAddress($to); // recipient

    // Content
    $mail->isHTML(true);
    $mail->Subject = "New Message from $fromName";
    $mail->Body    = "
        <h3>Contact Form Submission</h3>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Message:</strong><br>{$message}</p>
    ";

    $mail->send();
    echo json_encode([
        'status' => 'success',
        'alert' => 'alert-success',
        'message' => 'We have received your details. <strong>Thank you!</strong>'
    ]);
} catch (Exception $e) {
    error_log("Mailer Error: " . $mail->ErrorInfo);
    echo json_encode([
        'status' => 'error',
        'alert' => 'alert-danger',
        'message' => 'Failed to send email. Please try again later.'
    ]);
}
?>