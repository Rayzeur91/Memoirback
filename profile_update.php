<?php
session_start();
include 'config.php';

if (isset($_POST['update_profile'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $user_id = $_SESSION['user_id'];

    $hashed_password = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

    if ($hashed_password) {
        $sql = "UPDATE users SET full_name='$fullname', email='$email', password='$hashed_password', address='$address' WHERE id='$user_id'";
    } else {
        $sql = "UPDATE users SET full_name='$fullname', email='$email', address='$address' WHERE id='$user_id'";
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION['username'] = $fullname;
        $_SESSION['email'] = $email;
        $_SESSION['address'] = $address;
        redirectWithMessage('profile.php', 'Profile updated successfully!');
    } else {
        redirectWithMessage('profile.php', 'Error updating profile: ' . $conn->error, 'error');
    }
}

$conn->close();
?>

<?php
// Helper function for redirecting with a message
function redirectWithMessage($location, $message, $type = 'success') {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
    header("Location: $location");
    exit();
}
?>
