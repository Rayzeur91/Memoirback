<?php
session_start();
require 'config.php'; // Include your database configuration file

if (!isset($_SESSION['loggedin'])) {
    header('Location: account.php');
    exit();
}

if (isset($_GET['destroy'])) {
    $user_id = $_SESSION['user_id'];
    
    // Delete user's profile from the database
    $sql = "DELETE FROM users WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        // Logout the user and redirect to a confirmation page
        session_destroy(); // Destroy all sessions
        header('Location: index.php'); // Redirect to a confirmation page
        exit();
    } else {
        $_SESSION['message'] = "Error deleting profile: " . $conn->error;
        $_SESSION['message_type'] = 'error';
        header('Location: profile.php'); // Redirect back to delete profile page
        exit();
    }
}
?>