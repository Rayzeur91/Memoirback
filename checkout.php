<?php
session_start();
include 'config.php'; // Include your database configuration file

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}

// Check if cart is empty or not
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {

    $_SESSION['message'] = 'Your cart is empty. Please add items to your cart.';
    $_SESSION['message_type'] = 'error';
    // Cart is empty, redirect to home page or any other appropriate page
    header('Location: cart.php');
    exit();
}

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>
<?php include('includes/header.php'); ?>
<section id="banner" class="py-3" style="background: #F9F3EC;">
    <div class="container">
        <div class="hero-content py-5 my-3">
            <h2 class="display-1 mt-3 mb-0">Checkout</h2>
            <nav class="breadcrumb">
                <a class="breadcrumb-item nav-link" href="#">Home</a>
                <a class="breadcrumb-item nav-link" href="#">Pages</a>
                <span class="breadcrumb-item active" aria-current="page">Checkout</span>
            </nav>
        </div>
    </div>
</section>
<section class="shopify-cart checkout-wrap">
    <div class="container py-5 my-5" id="checkout-page">
        <form action="process-checkout.php" method="post" id="payment-form">
            <div class="row d-flex flex-wrap">
                <div class="col-lg-6">
                    <h2 class="text-dark pb-3">Billing Details</h2>
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" name="fullname" class="form-control"
                            value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" class="form-control"
                            value="<?php echo htmlspecialchars($user['address']); ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="card-element">Credit or Debit Card</label>
                        <div id="card-element" class="">
                            <!-- Stripe Element will be inserted here -->
                        </div>
                        <div id="card-errors" role="alert"></div>
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="your-order">
                        <h2 class="display-7 text-dark pb-3">Cart Totals</h2>
                        <div class="total-price">
                            <?php $total = 0; ?>
                            <?php foreach ($_SESSION['cart'] as $item) : ?>
                            <?php $total += $item['price'] * $item['quantity']; ?>
                            <?php endforeach; ?>
                            <table cellspacing="0" class="table">
                                <tbody>
                                    <tr class="subtotal border-top border-bottom pt-2 pb-2 text-uppercase">
                                        <th>Subtotal</th>
                                        <td data-title="Subtotal">
                                            <span class="price-amount amount ps-5">
                                                <bdi>
                                                    <span
                                                        class="price-currency-symbol">$</span><?php echo number_format($total, 2); ?>
                                                </bdi>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="order-total border-bottom pt-2 pb-2 text-uppercase">
                                        <th>Total</th>
                                        <td data-title="Total">
                                            <span class="price-amount amount ps-5">
                                                <bdi>
                                                    <span
                                                        class="price-currency-symbol">$</span><?php echo number_format($total, 2); ?>
                                                </bdi>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-dark btn-lg rounded-1 w-100">Place an
                                order</button>
                        </div>
                    </div>

        </form>
    </div>
</section>
<style>
#card-element {
    height: 52px;
    color: #908F8D;
    line-height: normal;
    border-radius: 0.25rem;
    border: 1px solid rgba(65, 64, 62, 0.20);
    background: #FFF;
    padding: 1.0rem 0rem 1.0rem 1.0rem;
}
</style>
<?php include('includes/footer.php'); ?>