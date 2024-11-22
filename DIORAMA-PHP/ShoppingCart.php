<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Diorama: The Book Nook Emporium</title>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Reset body and html to take full height */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        /* Body becomes a flex container */
        body {
            display: flex;
            flex-direction: column;
        }

        /* Ensure the main content area takes up available space */
        .main-content {
            flex: 1;
            padding: 20px;
        }

        /* Header and navigation styling */
        header {
            background-color: #38040E;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo img {
            width: 150px;
            height: 50px;
        }
        nav {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        nav ul li a:hover {
            color: #8F3C55;
        }
        .icons {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .icons a {
            color: #fff;
            font-size: 1.2em;
        }
        .icons a:hover {
            color: #8F3C55;
        }

        /* Cart section */
        .cart-container {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #FFF;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .cart-header, .cart-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        .empty-cart {
            text-align: center;
            color: #555;
            padding: 50px 0;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            opacity: 0;
            transition: opacity 0.5s ease-in;
        }
        .cart-item.show {
            opacity: 1;
        }
        .item-details {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .btn-empty {
            background-color: #d9534f;
            color: #FFF;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-left: 10px;
        }
        .quantity-button {
            background-color: #6F213C;
            color: white;
            border: none;
            padding: 10px;
            width: 40px;
            height: 40px;
            cursor: pointer;
            font-size: 1.5em;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
        }
        .quantity-button:hover {
            background-color: #8F3C55;
        }
        .cart-item-quantity {
            font-size: 1em;
            min-width: 20px;
            text-align: center;
        }
        .remove-button {
            background-color: transparent;
            border: none;
            color: #d9534f;
            cursor: pointer;
            font-size: 1.5em;
        }
        .remove-button:hover {
            color: #c9302c;
        }
        .total-price-container {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 1.2em;
            font-weight: bold;
        }
        .btn-checkout, .btn-primary {
            background-color: #6F213C;
            color: white;
            border: none;
        }
        .btn-checkout:hover, .btn-primary:hover {
            background-color: #8F3C55;
        }

         /* Footer styles */
         footer {
            background-color: #38040E; /* Deep Maroon */
            color: white;
            padding: 20px;
            text-align: center;
        }

        footer p {
            margin: 0;
        }

        /* Modal Styling */
        .modal-header {
            background-color: #fff;
            color: black;
        }
        .modal-footer .btn-secondary {
            background-color: #8F3C55;
            color: white;
        }
        .modal-footer .btn-primary {
            background-color: #6F213C;
            color: white;
            border: none;
        }
        .modal-footer .btn-primary:hover {
            background-color: #8F3C55;
        }
    </style>
</head>
<body>

<?php
// db_connection.php

// Database connection parameters
$servername = "localhost";
$username = "root";  // Default username for local development
$password = "";      // Default password for local development
$dbname = "dioramas"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connected successfully!"; // This will print if the connection is successful
}

// Fetch products from the shop table
$sql = "SELECT ID, name, price, image, description FROM shop";
$result = $conn->query($sql);

// Close connection after fetching
$conn->close();
?>


<!-- Header Section -->
<header>
    <div class="logo">
        <a href="HomePage.html"><img src="image/Logo diorama.png" alt="Diorama Logo"></a>
    </div>

    <!-- Navigation in the center -->
    <nav>
        <ul>
            <li><a href="HomePage.php">Home</a></li>
            <li><a href="shop.php">Shop All</a></li>
            <li><a href="AboutUs.php">About Us</a></li>
        </ul>
    </nav>

    <div class="icons">
        <a href="ShoppingCart.php"><i class="fas fa-shopping-bag"></i></a>
        <a href="signInEngine.php"><i class="fas fa-user"></i></a>
    </div>
</header>

<!-- Main Content (Cart Section) -->
<div class="main-content">
    <div class="cart-container">
        <div class="cart-header">
            <h2>Your Shopping Cart</h2>
        </div>

        <!-- Empty Cart Message -->
        <div id="empty-cart-message" class="empty-cart">
            <p>Your cart is currently empty.</p>
            <a href="shop.php" class="btn btn-checkout">Continue Shopping</a>
        </div>

        <div id="cart-items" style="display: none;">
        </div>

        <div class="cart-footer" id="cart-footer" style="display: none;">
            <div class="total-price-container">
                <p><strong>Total Price: </strong><span id="total-price">MYR 0.00</span></p>
            </div>
            <button class="btn btn-danger btn-empty" onclick="emptyCart()">Empty Cart</button>
            <button class="btn btn-checkout" onclick="checkout()">Checkout</button>
        </div>
    </div>
</div>

<!-- Modal for Checkout Confirmation -->
<div class="modal" tabindex="-1" role="dialog" id="checkout-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Checkout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to proceed to checkout?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="processCheckout()">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Footer Section -->
<footer>
    <p>&copy; 2024 Diorama: Book Nook Emporium. All Rights Reserved.</p>
    <p>Contact us: <a href="mailto:info@diorama.com" style="color: white; text-decoration: underline;">info@diorama.com</a> | 
    <a href="tel:+60192664904" style="color: white; text-decoration: underline;">+(60)19-266 4904</a></p>
    <p>Follow us on:</p>
    <div class="social-icons" style="margin-top: 10px;">
        <a href="https://www.instagram.com" target="_blank" style="color: white; margin: 0 10px;">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="https://www.pinterest.com" target="_blank" style="color: white; margin: 0 10px;">
            <i class="fab fa-pinterest"></i>
        </a>
        <a href="https://www.x.com" target="_blank" style="color: white; margin: 0 10px;">
            <i class="fab fa-x"></i>
        </a>
    </div>
</footer>

<!-- Bootstrap and JQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
// JavaScript to manage the cart

function loadCartItems() {
    const cartItemsContainer = document.getElementById('cart-items');
    const emptyCartMessage = document.getElementById('empty-cart-message');
    const cartFooter = document.getElementById('cart-footer');
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    const totalPriceElement = document.getElementById('total-price');
    
    cartItemsContainer.innerHTML = '';  
    let totalPrice = 0;

    if (cartItems.length === 0) {
        emptyCartMessage.style.display = 'block';
        cartFooter.style.display = 'none';
        cartItemsContainer.style.display = 'none';
    } else {
        emptyCartMessage.style.display = 'none';
        cartFooter.style.display = 'block';
        cartItemsContainer.style.display = 'block';

        cartItems.forEach((item, index) => {
            const cartItemDiv = document.createElement('div');
            cartItemDiv.className = 'cart-item';
            cartItemDiv.innerHTML = `
                <div class="item-details">
                    <img src="${item.image}" alt="${item.name}" width="60">
                    <p>${item.name} - MYR ${item.price}</p>
                </div>
            `;

            const quantityControls = document.createElement('div');
            quantityControls.className = 'quantity-controls';

            const decreaseButton = document.createElement('button');
            decreaseButton.className = 'quantity-button';
            decreaseButton.textContent = '-';
            decreaseButton.onclick = () => changeQuantity(index, -1);
            quantityControls.appendChild(decreaseButton);

            const itemQuantity = document.createElement('span');
            itemQuantity.className = 'cart-item-quantity';
            itemQuantity.textContent = item.quantity || 1;
            quantityControls.appendChild(itemQuantity);

            const increaseButton = document.createElement('button');
            increaseButton.className = 'quantity-button';
            increaseButton.textContent = '+';
            increaseButton.onclick = () => changeQuantity(index, 1);
            quantityControls.appendChild(increaseButton);

            const removeButton = document.createElement('button');
            removeButton.className = 'remove-button';
            removeButton.innerHTML = '<i class="fas fa-trash"></i>';
            removeButton.onclick = () => removeItem(index);
            quantityControls.appendChild(removeButton);

            cartItemDiv.appendChild(quantityControls);
            cartItemsContainer.appendChild(cartItemDiv);

            setTimeout(() => {
                cartItemDiv.classList.add('show');
            }, 0);

            const itemPrice = parseFloat(item.price) || 0;
            const itemQuantityNumber = parseInt(item.quantity) || 1;
            totalPrice += itemPrice * itemQuantityNumber;
        });

        totalPriceElement.textContent = `MYR ${totalPrice.toFixed(2)}`;
    }
}

function changeQuantity(index, change) {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    
    if (cartItems[index]) {
        let newQuantity = cartItems[index].quantity + change;
        
        // Ensure quantity doesn't go below 1
        if (newQuantity < 1) {
            newQuantity = 1;
        }
        
        // Update the quantity for the item
        cartItems[index].quantity = newQuantity;

        // Save the updated cart back to localStorage
        localStorage.setItem('cartItems', JSON.stringify(cartItems));

        // Reload the cart to reflect the updated quantity
        loadCartItems();
    }
}

function removeItem(index) {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    cartItems.splice(index, 1);
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    loadCartItems();
}

function emptyCart() {
    localStorage.removeItem('cartItems');
    loadCartItems();
}

function checkout() {
    window.location.href = "checkout.php";  // Redirect to checkout.php
}

document.addEventListener('DOMContentLoaded', loadCartItems);

</script>
</body>
</html>
