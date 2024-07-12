<?php 
ob_start();
session_start();

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'success';
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
include('includes/header.php');
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
<section class="login-tabs padding-large">
    <div class="container my-2 py-2">
        <div class="row">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade active show" id="nav-forgot-password" role="tabpanel">
                    <div class="col-lg-8 offset-lg-2 mt-1">
                        <p class="mb-0">Forgot Password</p>
                        <hr class="my-1">
                        <form id="forgotPasswordForm" class="form-group flex-wrap" method="post"
                            action="forgot_password.php">
                            <div class="form-input col-lg-12 my-4">
                                <input type="email" name="email" placeholder="Enter email address"
                                    class="form-control mb-3 p-4" required>
                                <div class="d-grid my-3">
                                    <button type="submit" name="forgot_password"
                                        class="btn btn-dark btn-lg rounded-1">Submit</button>
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