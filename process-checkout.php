<?php
session_start();
require 'config.php'; // Include your database configuration file
require 'vendor/autoload.php'; // Include Composer's autoloader for Stripe

\Stripe\Stripe::setApiKey('sk_test_Jsz1cY1tX30BRtbWf5Nem4WY00lPjV2pjy'); // Replace with your Stripe secret key

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $token = $_POST['stripeToken'];
    $customerId = $_SESSION['user_id']; // Assuming customer_id is stored in session

    // Calculate total amount in cents
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    $totalInCents = $total * 100;

    // Create a charge
    try {
        $charge = \Stripe\Charge::create([
            'amount' => $totalInCents,
            'currency' => 'usd',
            'description' => 'Order from ' . $fullname,
            'source' => $token,
            'metadata' => ['order_id' => uniqid(), 'address' => $address],
        ]);

        // Store order in the database
        $orderDetails = json_encode($_SESSION['cart']);
        $paymentStatus = $charge->status;
        $stripeId = $charge->id;

        // Prepare SQL statement using prepared statements
        $stmt = $conn->prepare("INSERT INTO orders (customer_id, total_amount, products, payment_status, stripe_id, order_date) 
                                VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param('idsss', $customerId, $total, $orderDetails, $paymentStatus, $stripeId);

        // Execute SQL query
        if ($stmt->execute()) {
            // Clear the cart
            unset($_SESSION['cart']);
            $_SESSION['message'] = "Your order has been placed successfully!";
            header('Location: success.php'); // Redirect to success page
            exit();
        } else {
            $_SESSION['message'] = "Error: " . $stmt->error;
            header('Location: checkout.php'); // Redirect back to cart page
            exit();
        }
    } catch (\Stripe\Exception\CardException $e) {
        $_SESSION['message'] = "Your card was declined!";
        header('Location: checkout.php'); // Redirect back to cart page
        exit();
    }
}

$conn->close();