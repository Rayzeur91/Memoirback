<?php
ob_start();
session_start();
include 'config.php';

// Function to redirect and set session message
function redirectWithMessage($location, $message, $type = 'success') {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
    if($type == "success"){
        header("Location: profile.php");

    } else {
        header("Location: $location");

    }
    exit();
}

// Registration
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Check if passwords match
    if ($password != $password2) {
        redirectWithMessage('account.php', 'Passwords do not match!', 'error');
    }

    // Validate password complexity
    if (strlen($password) < 8 || !preg_match('/[^\w\s]/', $password)) {
        redirectWithMessage('account.php', 'Password must be at least 8 characters long and contain at least one symbol.', 'error');
    }

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        redirectWithMessage('account.php', 'Email already exists!', 'error');
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (full_name, email, password, role, address) VALUES ('$fullname', '$email', '$hashed_password', 'user', '')";

        if ($conn->query($sql) === TRUE) {
            redirectWithMessage('account.php', 'Registration successful! You can now log in.');
        } else {
            redirectWithMessage('account.php', 'Error: ' . $sql . '<br>' . $conn->error, 'error');
        }
    }
}


// Login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['full_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['id'];

            
            redirectWithMessage('account.php', 'Login successful!');
        } else {
            redirectWithMessage('account.php', 'Invalid credentails.', 'error');
        }
    } else {
        redirectWithMessage('account.php', 'No user found with this email.', 'error');
    }
}

$conn->close();
?>