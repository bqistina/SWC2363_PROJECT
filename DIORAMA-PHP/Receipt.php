<?php
// Include the database connection
require_once 'db_connection.php';

// Fetch the order details from the database
if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $order_result = $stmt->get_result()->fetch_assoc();

    $stmt_items = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt_items->bind_param("i", $order_id);
    $stmt_items->execute();
    $items_result = $stmt_items->get_result();
} else {
    echo "Error: Order ID not provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>

    <style>
        /* General reset and box-sizing */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #6F213C;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            font-size: 1.1em;
            margin: 10px 0;
        }

        /* Box styling */
        .info-box {
            margin-top: 20px;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .info-box p {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .items-list {
            margin-top: 20px;
        }

        .items-list ul {
            list-style-type: none;
            padding-left: 0;
        }

        .items-list li {
            font-size: 1.1em;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .items-list li:last-child {
            border-bottom: none;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #777;
        }

        .footer a {
            color: #6F213C;
            text-decoration: none;
            font-weight: 500;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Receipt</h1>

        <!-- Order details in a box -->
        <div class="info-box">
            <p><strong>Order ID:</strong> <?php echo $order_id; ?></p>
            <p><strong>Total Price:</strong> MYR <?php echo number_format($order_result['total_price'], 2); ?></p>
            <p><strong>Payment Method:</strong> <?php echo $order_result['payment_method']; ?></p>
        </div>

        <!-- Items purchased in a box -->
        <div class="info-box items-list">
            <h3>Items Purchased:</h3>
            <ul>
                <?php while ($item = $items_result->fetch_assoc()): ?>
                    <li>
                        <?php echo $item['name']; ?> - MYR <?php echo number_format($item['price'], 2); ?> (Qty: <?php echo $item['quantity']; ?>)
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>

        <div class="footer">
            <p>Thank you for your purchase! <a href="shop.php" id="continue-shopping">Continue Shopping</a></p>
        </div>
    </div>

    <script>
        // Clear the shopping cart in localStorage when 'Continue Shopping' is clicked
        document.getElementById('continue-shopping').addEventListener('click', function() {
            // Clear the cart from localStorage
            localStorage.removeItem('cartItems'); // Remove the cartItems from localStorage
            
            // Debugging log to check if the cart exists before clearing
            console.log('Cart before clearing:', localStorage.getItem('cartItems'));
            
            // Redirect the user to the shop page after clearing the cart
            window.location.href = 'shop.php'; // Redirect to shop page or another page as needed
            
            // Confirm cart is cleared
            console.log('Cart after clearing:', localStorage.getItem('cartItems'));
        });
    </script>
</body>
</html>
