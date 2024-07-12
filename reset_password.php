<?php
session_start();
require 'config.php'; // Include your database configuration file

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token is valid and not expired
    $sql = "SELECT * FROM users WHERE reset_token = '$token' AND token_expiry > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        $_SESSION['message'] = "Invalid or expired token.";
        $_SESSION['message_type'] = 'error';
        header('Location: forgot-password.php');
        exit();
    }
} else {
    $_SESSION['message'] = "No token provided.";
    $_SESSION['message_type'] = 'error';
    header('Location: forgot-password.php');
    exit();
}

if (isset($_POST['reset_password'])) {
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password != $password2) {
        $_SESSION['message'] = "Passwords do not match!";
        $_SESSION['message_type'] = 'error';
    } elseif (strlen($password) < 8 || !preg_match('/[^\w\s]/', $password)) {
        $_SESSION['message'] = "Password must be at least 8 characters long and contain at least one symbol.";
        $_SESSION['message_type'] = 'error';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = '$hashed_password', reset_token = NULL, token_expiry = NULL WHERE id = " . $user['id'];

        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Your password has been reset successfully!";
            $_SESSION['message_type'] = 'success';
            header('Location: account.php');
            exit();
        } else {
            $_SESSION['message'] = "Error: " . $conn->error;
            $_SESSION['message_type'] = 'error';
        }
    }
}
?>
<?php include('includes/header.php'); ?>

<?php if (isset($_SESSION['message'])) : ?>
<div class="container my-2 py-2">
    <div class="row">
        <div class="alert alert-<?php echo $_SESSION['message_type'] == 'error' ? 'danger' : 'success'; ?>">
            <?php echo $_SESSION['message']; ?>
        </div>
    </div>
</div>
<?php endif; ?>
<section class="login-tabs padding-large">
    <div class="container my-2 py-2">
        <div class="row">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade active show" id="nav-reset-password" role="tabpanel">
                    <div class="col-lg-8 offset-lg-2 mt-1">
                        <p class="mb-0">Reset Password</p>
                        <hr class="my-1">
                        <form id="resetPasswordForm" class="form-group flex-wrap" method="post" action="">
                            <div class="form-input col-lg-12 my-4">
                                <input type="password" name="password" placeholder="Enter new password"
                                    class="form-control mb-3 p-4" required>
                                <input type="password" name="password2" placeholder="Confirm new password"
                                    class="form-control mb-3 p-4" required>
                                <div class="d-grid my-3">
                                    <button type="submit" name="reset_password"
                                        class="btn btn-dark btn-lg rounded-1">Reset Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>