<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

require 'config.php'; // Include your database configuration file

if (isset($_POST['forgot_password'])) {
    $email = $_POST['email'];

    // Check if email exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));

        // Set token expiration time (e.g., 1 hour)
        $expiry = date("Y-m-d H:i:s", strtotime('+24 hour'));

        // Save the token and its expiry time in the database
        $sql = "UPDATE users SET reset_token = '$token', token_expiry = '$expiry' WHERE email = '$email'";
        if ($conn->query($sql) === TRUE) {
            // Send password reset email
            $resetLink = "http://localhost/one-ecommerce-php/reset_password.php?token=$token";
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                $mail->SMTPAuth = true;
                $mail->Username = 'saeedg8879@gmail.com'; // SMTP username
                $mail->Password = 'cndkocvphleepsmt'; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port = 587; // TCP port to connect to

                //Recipients
                $mail->setFrom('no-reply@yourdomain.com', 'Mailer');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Request';
                $mail->Body    = "Click on this link to reset your password: <a href='$resetLink'>$resetLink</a>";

                $mail->send();
                $_SESSION['message'] = 'Password reset link has been sent to your email.';
                $_SESSION['message_type'] = 'success';
            } catch (Exception $e) {
                $_SESSION['message'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                $_SESSION['message_type'] = 'error';
            }
        } else {
            $_SESSION['message'] = 'Failed to update token.';
            $_SESSION['message_type'] = 'error';
        }
    } else {
        $_SESSION['message'] = 'No account found with that email address.';
        $_SESSION['message_type'] = 'error';
    }
    header('Location: forgot-password.php');
    exit();
}