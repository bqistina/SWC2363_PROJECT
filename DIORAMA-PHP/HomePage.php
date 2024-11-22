<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diorama: The Book Nook Emporium</title>

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

        /* Search and Bag Icons aligned to the right */
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

        /* Hero Section */
        .hero {
            padding: 20px;
            text-align: center;
            color: #38040E; /* Deep Maroon */
        }

        .hero h1 {
            font-size: 3em;
        }

        .hero p {
            font-size: 1.5em;
        }

        .hero a {
            padding: 10px 20px;
            background-color: #6F213C; /* Burgundy */
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            display: inline-block;
        }

        .hero a:hover {
            background-color: #8F3C55; /* Muted Rose */
        }

        /* Button Theme */
        .btn-primary {
            background-color: #6F213C; /* Burgundy */
            border-color: #6F213C;     /* Border matches the background */
        }

        .btn-primary:hover {
            background-color: #8F3C55; /* Muted Rose */
            border-color: #8F3C55;     /* Border changes on hover */
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

        /* Custom Carousel Styles */
        .carousel-caption {
            background: rgba(255, 230, 230, 0.7); /* Light pink overlay with transparency */
            padding: 20px;
            border-radius: 10px;
            color: #38040E; /* Deep Maroon text */
        }

        .carousel-caption h2, .carousel-caption h3, .carousel-caption p {
            color: #38040E; /* Deep Maroon for readability */
        }

        /* Match Learn More buttons to Shop Now button */
        .carousel-caption a.btn-primary {
            background-color: #6F213C; /* Match Shop Now color */
            border-color: #6F213C;
        }

        .carousel-caption a.btn-primary:hover {
            background-color: #8F3C55; /* Lighter on hover */
            border-color: #8F3C55;
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

<!-- Hero Section -->
<div class="hero">
    <h1>Welcome to Diorama: The Book Nook Emporium</h1>
    <img src="image/DIORAMA.png" alt="Welcome Image" style="width: 1500px; height: 600px;">
    <p>Your gateway to captivating book nooks!</p>
    <a href="shop.php">Shop Now</a>
</div>

<!-- Slideshow Section using Bootstrap Carousel -->
<div class="container mt-5">
  <div class="row">
    <div class="col-12">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleControls" data-slide-to="1"></li>
          <li data-target="#carouselExampleControls" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <!-- Bestseller Slide -->
          <div class="carousel-item active">
            <img class="d-block w-100" src="image/pharmacist magic nook.png" alt="Bestseller Book Nook">
            <div class="carousel-caption text-center">
              <h2>Bestsellers</h2>
              <h3>Bestseller: Magic Pharmacist Book Nook</h3>
              <p>Step into a magical world inspired by the enchanting landscapes of 'Harry Potter'.</p>
              <a href="shop.php" class="btn btn-primary">View Details</a>
            </div>
          </div>

          <!-- New Arrival Slide -->
          <div class="carousel-item">
            <img class="d-block w-100" src="image/rose detective nook.png" alt="New Arrival">
            <div class="carousel-caption text-center">
              <h2>New Arrivals</h2>
              <h3>New Arrival: Detective Book Nook</h3>
              <p>Unravel mysteries inspired by 'Sherlock Holmes' with this detective-themed book nook.</p>
              <a href="shop.php" class="btn btn-primary">View Details</a>
            </div>
          </div>

          <!-- Monthly Collection Slide -->
          <div class="carousel-item">
            <img class="d-block w-100" src="image/coffee shop dollhouse.png" alt="Monthly Collection">
            <div class="carousel-caption text-center">
              <h2>Monthly Collection</h2>
              <h3>JUNE : Coffee Shop Wooden Dollhouse</h3>
              <p>Modeled after a cozy café, this charming dollhouse captures the warmth of shared stories and comforting coffee moments.</p>
              <a href="shop.php" class="btn btn-primary">View Details</a>
            </div>
          </div>
        </div>

        <!-- Carousel Controls -->
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  <hr>
</div>

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
