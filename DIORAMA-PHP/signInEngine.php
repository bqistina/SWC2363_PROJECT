<?php
session_start();
include('db_connection.php');

// Connection to the server
$conn = mysqli_connect("localhost", "root", "", "dioramas");

if (!$conn) {
    die('ERROR: ' . mysqli_connect_error());
}

if (isset($_POST['login'])) {
    // Capture form data
    $signInEmail = mysqli_real_escape_string($conn, $_POST['signInEmail']);
    $signInPassword = mysqli_real_escape_string($conn, $_POST['signInPassword']);

    // SQL query to select user data from the user table
    $sql = "SELECT * FROM user WHERE signUpEmail = ?";

    // Prepare the query
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("s", $signInEmail); // 's' means the parameter is a string
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Compare the provided password with the stored password (plain text comparison)
        if ($signInPassword === $user['signUpPassword']) {
            // If password is correct, start a session and redirect to home.php
            $_SESSION['ID'] = $user['id'];  // Assuming 'id' is the user's unique identifier
            header("Location: HomePage.php");  // Redirect to home.php
            exit;  // Stop the script after redirection
        } else {
            // If password is incorrect
            echo "<script>alert('Invalid password!'); window.location.href='signInEngine.php';</script>";
        }
    } else {
        // If user not found
        echo "<script>alert('User not found!'); window.location.href='signInEngine.php';</script>";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In to Diorama</title>

    <!-- Adding Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F8F8F8; /* Light background */
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
		
        /* Centered container */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
        }

        /* Form styling */
        .form-box {
            background-color: #38040E; /* Deep Maroon */
            color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px; /* Max width for the form */
        }

        h2 {
            color: #fff; /* White text for heading */
            margin-bottom: 20px;
            text-align: center;
        }

        input {
            border: none;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
        }

        input[type="email"], input[type="password"] {
            background-color: #E0E0E0; /* Light Grey */
            color: #000; /* Black text for input */
        }

        button {
            background-color: #8F3C55; /* Muted Rose */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            cursor: pointer;
        }

        button:hover {
            background-color: #a76b8a; /* Slightly lighter on hover */
        }

        .signup-option {
            text-align: center;
            margin-top: 15px;
        }

        .signup-option a {
            color: #8F3C55; /* Muted Rose */
            text-decoration: none;
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
        <a href="MainPage.php"><img src="image/Logo diorama.png" alt="Diorama Logo"></a> <!-- Wrap the logo with a link -->
    </div>

    <!-- Navigation in the center -->
    <nav>
        <ul>
            <li><a href="MainPage.php">Home</a></li>
            <li><a href="MainPage.php">Shop All</a></li>
            <li><a href="MainPage.php">About Us</a></li>
        </ul>
    </nav>

    <!-- Shopping Bag on the right -->
    <div class="icons">
        <a href="MainPage.php"><i class="fas fa-shopping-bag"></i></a> <!-- Shopping Bag Icon -->
		<span id="cart-counter" style="color: white; font-size: 1.2em; margin-left: 5px;">0</span><!-- Added a cart counter-->
		<a href="SignInAs.php"><i class="fas fa-user"></i></a> <!-- User Account Icon -->
    </div>
</header>

<!-- Centered container -->
    <div class="container">
        <div class="form-box">
            <h2>Sign In to Diorama</h2>
            <form action="signInEngine.php" method="POST" onsubmit="return validateForm(event)">
                <input type="email" id="signInEmail" name="signInEmail" placeholder="Email" required>
                <input type="password" id="signInPassword" name="signInPassword" placeholder="Password" required>
                <button type="submit" name="login">Sign In</button>
            </form>            
            <div id="error-message" style="color: red; display: none;">Account not found or incorrect password. Please try again.</div>
            <div class="signup-option">
                <p>Don't have an account? <a href="signUpEngine.php">Sign Up</a></p>
            </div>
        </div>
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
</body>
</html>
