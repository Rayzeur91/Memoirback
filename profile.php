<?php
ob_start();
session_start();

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'success';
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: account.php');
    exit();
}

include('includes/header.php');

// Initialize session variables if they are not set
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$address = isset($_SESSION['address']) ? $_SESSION['address'] : '';
?>

<?php if (isset($message)) : ?>
<div class="container my-2 py-2">
    <div class="row">
        <div class="alert alert-<?php echo $message_type == 'error' ? 'danger' : 'success'; ?>">
            <?php echo $message; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<section class="profile-tabs padding-large">
    <div class="container my-2 py-2">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 mt-1">
                <h2 class="mb-4">Your Profile</h2>
                <?php if (isset($_SESSION['message'])) : ?>
                <div class="alert alert-info">
                    <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        ?>
                </div>
                <?php endif; ?>
                <form id="profileForm" class="form-group flex-wrap" method="post" action="profile_update.php">
                    <div class="form-input col-lg-12 my-4">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" id="fullname" name="fullname"
                            value="<?php echo htmlspecialchars($username); ?>" placeholder="Your full name"
                            class="form-control mb-3 p-4" required>

                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"
                            placeholder="Your email address" class="form-control mb-3 p-4" required>

                        <label for="password" class="form-label">New Password</label>
                        <input type="password" id="password" name="password"
                            placeholder="New password (leave blank if not changing)" class="form-control mb-3 p-4">

                        <label for="address" class="form-label">Address</label>
                        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>"
                            placeholder="Your address" class="form-control mb-3 p-4" required>

                        <div class="d-grid my-3">
                            <button type="submit" name="update_profile" class="btn btn-dark btn-lg rounded-1">Update
                                Profile</button>
                        </div>
                        <div class="d-grid my-3">
                            <a href="delete-profile.php?destroy=true" class="btn btn-danger btn-lg rounded-1">Delete
                                Profile</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>