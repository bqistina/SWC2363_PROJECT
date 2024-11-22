<?php
require_once 'db_connection.php';
ob_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check for required POST data
    if (!isset($_POST['total_price'], $_POST['payment_method'], $_POST['signUpName']) || empty($_POST['cart_items'])) {
        echo "Error: Missing required information.";
        exit;
    }

    // Sanitize and retrieve POST data
    $user_name = htmlspecialchars($_POST['signUpName']);
    $total_price = floatval($_POST['total_price']);
    $payment_method = htmlspecialchars($_POST['payment_method']);
    $receipt_date = date('Y-m-d H:i:s');
    $cart_items = json_decode($_POST['cart_items'], true);

    // Start a transaction to ensure atomicity
    $conn->begin_transaction();

    try {
        // Fetch user_id based on signUpName
        $stmt_user = $conn->prepare("SELECT ID FROM user WHERE signUpName = ?");
        $stmt_user->bind_param("s", $user_name);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();

        if ($result_user->num_rows > 0) {
            $row_user = $result_user->fetch_assoc();
            $user_id = $row_user['ID'];
        } else {
            throw new Exception("Error: User not found.");
        }

        // Insert into the `orders` table
        $stmt_order = $conn->prepare("INSERT INTO orders (user_id, total_price, payment_method, order_date) VALUES (?, ?, ?, ?)");
        $stmt_order->bind_param("idss", $user_id, $total_price, $payment_method, $receipt_date);
        $stmt_order->execute();
        $order_id = $stmt_order->insert_id;

        if (!$order_id) {
            throw new Exception("Error: Failed to insert order.");
        }

        // Insert items into the `order_items` table
        $stmt_items = $conn->prepare("INSERT INTO order_items (order_id, name, price, quantity) VALUES (?, ?, ?, ?)");
        foreach ($cart_items as $item) {
            $product_name = htmlspecialchars($item['name']);
            $product_price = floatval($item['price']);
            $quantity = intval($item['quantity']);
            $stmt_items->bind_param("isdi", $order_id, $product_name, $product_price, $quantity);
            $stmt_items->execute();
        }

        // Insert into the `receipts` table
        $stmt_receipts = $conn->prepare("INSERT INTO receipts (order_id, total_price, payment_method, receipt_date) VALUES (?, ?, ?, ?)");
        $stmt_receipts->bind_param("idss", $order_id, $total_price, $payment_method, $receipt_date);
        $stmt_receipts->execute();

        // Commit the transaction
        $conn->commit();

        // Redirect to the receipt page
        header("Location: Receipt.php?order_id=" . $order_id);
        exit;

    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
        exit;
    }

    $conn->close();
}

ob_end_flush();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Diorama: The Book Nook Emporium</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #800000; /* Maroon color */
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 1.1rem;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"], select {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
            width: 100%;
        }

        button {
            padding: 12px;
            font-size: 1rem;
            color: white;
            background-color: #800000; /* Maroon color */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #6b0000;
        }

        .items-list {
            list-style: none;
            padding: 0;
        }

        .items-list li {
            background-color: #f4f4f4;
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
        }

        .total-price {
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Checkout</h1>

    <ul id="cart-items-list" class="items-list">
        <!-- Cart items will be populated here by JavaScript -->
    </ul>

    <p class="total-price" id="total-price">Total: MYR 0.00</p>

    <form action="checkout.php" method="POST">
        <label for="signUpName">Your Name:</label>
        <input type="text" name="signUpName" id="signUpName" required><br><br>

        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" id="payment_method" required>
            <option value="Credit Card">Credit Card</option>
            <option value="PayPal">PayPal</option>
            <option value="Cash on Delivery">Cash on Delivery</option>
        </select><br><br>

        <!-- Hidden Fields for Cart Data -->
        <input type="hidden" name="total_price" id="total-price-input" value="0.00">
        <input type="hidden" name="cart_items" id="cart-items-input" value='[]'>

        <button type="submit">Place Order</button>
    </form>
</div>

<script>
    // Load cart items from localStorage
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    let totalPrice = 0;

    // Validate cart items before processing
    if (Array.isArray(cartItems) && cartItems.length > 0) {
        // Display the items
        const cartItemsList = document.getElementById('cart-items-list');
        cartItems.forEach(item => {
            const itemName = item.name || 'Unknown Item';
            const itemPrice = parseFloat(item.price) || 0;  // Ensure price is a number
            const itemQuantity = parseInt(item.quantity) || 1;  // Ensure quantity is a valid integer

            totalPrice += itemPrice * itemQuantity;  // Update the total price

            // Append item to the list
            const li = document.createElement('li');
            li.textContent = `${itemName} - MYR ${itemPrice.toFixed(2)} (Qty: ${itemQuantity})`;
            cartItemsList.appendChild(li);
        });
    } else {
        console.error('Invalid cart data or empty cart');
    }

    // Update the total price and hidden cart data for submission
    document.getElementById('total-price').textContent = `Total: MYR ${totalPrice.toFixed(2)}`;
    document.getElementById('total-price-input').value = totalPrice.toFixed(2);
    document.getElementById('cart-items-input').value = JSON.stringify(cartItems);
</script>

</body>
</html>
