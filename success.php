<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
   
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="container">
        <h1>Order Success</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>
        <p>Thank you for your order! You will receive a confirmation email shortly.</p>
        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
    </div>

    <?php include('includes/footer.php'); ?>
</body>
</html>
