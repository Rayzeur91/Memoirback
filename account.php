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
            <div class="tabs-listing">
                <nav>
                    <div class="nav nav-tabs d-flex justify-content-center border-dark-subtle mb-3" id="nav-tab"
                        role="tablist">
                        <button
                            class="nav-link mx-3 fs-3 border-bottom border-dark-subtle border-0 text-uppercase active"
                            id="nav-sign-in-tab" data-bs-toggle="tab" data-bs-target="#nav-sign-in" type="button"
                            role="tab" aria-controls="nav-sign-in" aria-selected="true">Log In</button>
                        <button class="nav-link mx-3 fs-3 border-bottom border-dark-subtle border-0 text-uppercase"
                            id="nav-register-tab" data-bs-toggle="tab" data-bs-target="#nav-register" type="button"
                            role="tab" aria-controls="nav-register" aria-selected="false">Sign Up</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="nav-sign-in" role="tabpanel"
                        aria-labelledby="nav-sign-in-tab">
                        <div class="col-lg-8 offset-lg-2 mt-1">
                            <p class="mb-0">Log-In With Email</p>
                            <hr class="my-1">
                            <form id="form1" class="form-group flex-wrap" method="post" action="auth.php">
                                <div class="form-input col-lg-12 my-4">
                                    <input type="text" name="email" placeholder="Enter email address"
                                        class="form-control mb-3 p-4">
                                    <input type="password" name="password" placeholder="Enter password"
                                        class="form-control mb-3 p-4" aria-describedby="passwordHelpBlock">
                                    <label class="py-3 d-flex flex-wrap justify-content-between">
                                        <div>
                                            <input type="checkbox" class="d-inline">
                                            <span class="label-body">Remember Me</span>
                                        </div>
                                        <div id="passwordHelpBlock" class="form-text">
                                            <a href="forgot-password.php" class="text-primary fw-bold">Forgot
                                                Password?</a>
                                        </div>
                                    </label>
                                    <div class="d-grid my-3">
                                        <button type="submit" name="login" class="btn btn-dark btn-lg rounded-1">Log
                                            In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab">
                        <div class="col-lg-8 offset-lg-2 mt-1">
                            <p class="mb-0">Sign-Up With Email</p>
                            <hr class="my-1">
                            <form id="form2" class="form-group flex-wrap" method="post" action="auth.php">
                                <div class="form-input col-lg-12 my-4">
                                    <input type="text" name="fullname" placeholder="Your full name"
                                        class="form-control mb-3 p-4" required>
                                    <input type="text" name="email" placeholder="Your email address"
                                        class="form-control mb-3 p-4" required>
                                    <input type="password" name="password" placeholder="Set your password"
                                        class="form-control mb-3 p-4" required>
                                    <input type="password" name="password2" placeholder="Retype your password"
                                        class="form-control mb-3 p-4" require>
                                    <label class="py-3 d-flex flex-wrap justify-content-between">
                                        <div>
                                            <input type="checkbox" name="is_accept" class="d-inline" required>
                                            <span class="label-body">I accept the terms and conditions!</span>
                                        </div>
                                    </label>
                                    <div class="d-grid my-3">
                                        <button type="submit" name="register" class="btn btn-dark btn-lg rounded-1">Sign
                                            Up</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>