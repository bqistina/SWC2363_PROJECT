<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Diorama: The Book Nook Emporium</title>

    <!-- Adding Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F8F8F8;
        }

        /* Updated Header styles */
        header {
            background-color: #38040E; /* Deep Maroon */
            color: white;
            padding: 10px 20px; /* Reduced padding */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Smaller logo aligned to the left */
        .logo img {
            width: 150px;  /* Reduced width */
            height: 50px;  /* Reduced height */
        }

        /* Navigation bar centered */
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
            align-items: center;
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
            color: #8F3C55; /* Muted Rose */
        }

        /* Search and Bag Icons */
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
            color: #8F3C55; /* Muted Rose */
        }

        /* About Us Section */
        .about-us {
            padding: 50px;
            background-color: #fff;
            text-align: center;
        }

        .about-us h1 {
            color: #38040E; /* Deep Maroon */
            font-size: 3em;
            margin-bottom: 20px;
        }

        .about-us p {
            font-size: 1.2em;
            color: #666;
            line-height: 1.8;
            max-width: 900px;
            margin: 0 auto;
        }

        /* Vision, Mission, and Values Section */
        .values-section {
            background-color: #F8F8F8;
            padding: 50px;
        }

        .values-section h2 {
            color: #38040E;
            text-align: center;
            margin-bottom: 40px;
        }

        .card {
            background-color: #38040E; /* Dark theme based on the website */
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #fff; /* Text color to contrast with dark background */
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%; /* Ensures equal height */
            padding: 20px;
        }

        .card h3 {
            color: #fff; /* Lighter theme color for heading */
            font-size: 1.5em;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 1.1em;
            color: #E0E0E0; /* Light grey for text readability */
            line-height: 1.6;
        }

        /* Ensure all cards have the same height */
        .row {
            display: flex;
        }

        .col {
            flex: 1; /* Equal width and height for columns */
            padding: 15px;
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
    </style>
</head>
<body>

<!-- Header -->
<header>
    <!-- Logo on the left -->
    <div class="logo">
        <a href="HomePage.php"><img src="image/Logo diorama.png" alt="Diorama Logo"></a> <!-- Wrap the logo with a link -->
    </div>

    <!-- Navigation in the center -->
    <nav>
        <ul>
            <li><a href="HomePage.php">Home</a></li>
            <li><a href="shop.php">Shop All</a></li>
            <li><a href="AboutUs.php">About Us</a></li>
        </ul>
    </nav>

    <!-- Shopping Bag on the right -->
    <div class="icons">
        <a href="ShoppingCart.php"><i class="fas fa-shopping-bag"></i></a> <!-- Shopping Bag Icon -->
		<span id="cart-counter" style="color: white; font-size: 1.2em; margin-left: 5px;">0</span><!-- Added a cart counter-->
		<a href="signInEngine.php"><i class="fas fa-user"></i></a> <!-- User Account Icon -->
    </div>
</header>

<!-- About Us Section -->
<section class="about-us">
    <h1>About Diorama: The Book Nook Emporium</h1>
    <p>
        At Diorama, we are passionate about storytelling and bringing books to life in a new and exciting way. 
        Our book nooks are not just beautiful miniature scenes but gateways into the magical worlds that exist 
        between the pages of your favorite books. Our mission is to create artistic and detailed dioramas that 
        enhance your reading experience and enrich your bookshelves.
    </p>
</section>

<!-- Vision, Mission, and Values Section with Cards -->
<section class="values-section">
    <div class="container">
        <h2>Our Vision, Mission, and Values</h2>
        <div class="row">
            <!-- Vision Card -->
            <div class="col-md-4">
                <div class="card">
                    <h3>Vision</h3>
                    <p>
                        To become the premier destination for book lovers seeking immersive, handcrafted book nooks that
                        inspire imagination and creativity.
                    </p>
                </div>
            </div>

            <!-- Mission Card -->
            <div class="col-md-4">
                <div class="card">
                    <h3>Mission</h3>
                    <p>
                        Our mission is to craft exquisite and unique book nooks that connect readers with the stories they 
                        love. Each diorama is designed with care, capturing the essence of beloved books, movies, and 
                        worlds.
                    </p>
                </div>
            </div>

            <!-- Values Card -->
            <div class="col-md-4">
                <div class="card">
                    <h3>Values</h3>
                    <p>
                        We value creativity, craftsmanship, and community. We strive to create pieces that celebrate the 
                        love of books and foster a deep connection between readers and their favorite literary worlds.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer>
    <p>&copy; 2024 Diorama: Book Nook Emporium. All Rights Reserved.</p>
    <p>Contact us: <a href="mailto:info@diorama.com" style="color: white; text-decoration: underline;">info@diorama.com</a> | 
    <a href="tel:+60192664904" style="color: white; text-decoration: underline;">+(60)19-266 4904</a></p>
    <p>Follow us on:</p>
    <!-- Social Media Icons -->
    <div class="social-icons" style="margin-top: 10px;">
        <a href="https://www.instagram.com" target="_blank" style="color: white; margin: 0 10px;">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="https://www.pinterest.com" target="_blank" style="color: white; margin: 0 10px;">
            <i class="fab fa-pinterest"></i>
        </a>
		<a href="https://www.x.com" target="_blank" style="color: white; margin: 0 10px;">
            <i class="fab fa-x"></i> <!-- X Icon -->
        </a>
    </div>
</footer>

<!-- JavaScript for Add to Cart functionality -->
<script>
// Function to update cart counter
function updateCartCounter() {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    const cartCounter = document.getElementById('cart-counter');
    cartCounter.textContent = cartItems.length;
}

// Function to add to cart
function addToCart(name, price, image) {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    const newItem = { name, price, image };
    cartItems.push(newItem);
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    
    // Update UI
    updateCartCounter();
    
    // Optionally, display the added item in a cart section
    displayCartItem(newItem);
}

// Function to display the cart item in a designated area
function displayCartItem(item) {
    const cartItemsContainer = document.getElementById('cart-items');
    const cartItemDiv = document.createElement('div');
    cartItemDiv.className = 'cart-item';
    cartItemDiv.innerHTML = `
        <div class="item-details">
            <img src="${item.image}" alt="${item.name}" width="60">
            <p>${item.name} - MYR ${item.price}</p>
            <span class="remove-item" onclick="removeCartItem('${item.name}')">
                <i class="fas fa-trash-alt"></i>
            </span>
        </div>
    `;
    cartItemsContainer.appendChild(cartItemDiv);
}

// Function to remove an item from the cart
function removeCartItem(name) {
    let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    cartItems = cartItems.filter(item => item.name !== name);
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    loadCartItems(); // Refresh the displayed cart items
    updateCartCounter(); // Update the cart counter
}

// Initialize the cart counter on page load
document.addEventListener('DOMContentLoaded', updateCartCounter);
</script>
	
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</body>
</html>
