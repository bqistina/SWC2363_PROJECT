<?php
// Database credentials
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "dioramas"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the shop table
$sql = "SELECT ID, name, price, image, description FROM shop";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Diorama: The Book Nook Emporium</title>

    <!-- Adding Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F8F8;
            margin: 0;
            padding: 0;
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

        .logo img {
            width: 150px;  /* Reduced width */
            height: 50px;  /* Reduced height */
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

        /* Main Shop Section */
        .shop {
            padding: 40px 20px;
            text-align: center;
        }

        .shop h1 {
            color: #38040E;
            margin-bottom: 40px;
        }

        .shop-item {
            margin-bottom: 30px;
            transition: transform 0.2s; /* Smooth transition for hover effect */
        }

        .shop-item:hover {
            transform: scale(1.05); /* Scale up on hover */
        }

        .shop-item img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .shop-item h3 {
            color: #6F213C; /* Burgundy */
            margin-top: 15px;
        }

        .shop-item p {
            font-size: 1.1em;
            color: #333;
        }

        .shop-item .btn {
            margin-top: 10px;
            background-color: #6F213C;
            color: white;
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
    <div class="logo">
        <a href="HomePage.php"><img src="image/Logo diorama.png" alt="Diorama Logo"></a>
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
        <span id="cart-counter" style="color: white; font-size: 1.2em; margin-left: 5px;">0</span>
        <a href="signInEngine.php"><i class="fas fa-user"></i></a>
    </div>
</header>

<!-- Shop Section -->
<div class="container shop">
    <h1>Our Book Nooks</h1>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="col-md-4 shop-item">
                <img src="image/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo isset($row['description']) && !empty($row['description']) ? $row['description'] : 'No description available'; ?></p>
                <p><strong>Price: MYR <?php echo $row['price']; ?></strong></p>
                <button class="btn btn-primary" onclick="addToCart('<?php echo $row['name']; ?>', <?php echo $row['price']; ?>, 'image/products/<?php echo $row['image']; ?>')">Add To Cart</button>
            </div>
        <?php endwhile; ?>
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

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for Add to Cart functionality -->
<script>
function updateCartCounter() {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    const cartCounter = document.getElementById('cart-counter');
    cartCounter.textContent = cartItems.length;
}

function addToCart(name, price, image) {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    const newItem = { name, price, image };
    cartItems.push(newItem);
    localStorage.setItem('cartItems', JSON.stringify(cartItems));

    updateCartCounter();
}

document.addEventListener('DOMContentLoaded', updateCartCounter);
</script>

</body>
</html>
