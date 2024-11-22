<?php
session_start();
include('db_connection.php');

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "dioramaS");

if (!$conn) {
    die('ERROR: ' . mysqli_connect_error());
}

if (isset($_POST['login'])) {
    // Capture form data
    $signUpEmail_A = mysqli_real_escape_string($conn, $_POST['signUpEmail_A']);
    $signUpPassword_A = mysqli_real_escape_string($conn, $_POST['signUpPassword_A']);

    // SQL query to select user data from the admin table
    $sql = "SELECT * FROM admin WHERE signUpEmail_A = ?";  // Adjust column names here
    
    // Prepare the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $signUpEmail_A); // Bind the email as a string
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // Fetch the user data
        $admin = $result->fetch_assoc();

        // Directly compare the submitted password with the stored password (plain text)
        if ($signUpPassword_A === $admin['signUpPassword_A']) {  // Adjust column name here
            // If password is correct, store ID in session and redirect to HomePage_A.html
            $_SESSION['ID_A'] = $admin['id'];  // Assuming 'id' is the admin's unique identifier
            $_SESSION['signUpEmail_A'] = $admin['signUpEmail_A'];  // Storing email
            header("Location: HomePage_A.php");  // Redirect to HomePage_A.php
            exit;  // Stop the script after redirection
        } else {
            // If password is incorrect
            echo "<script>alert('Invalid password!'); window.location.href='SignIn_A.php';</script>";
        }
    } else {
        // If admin account not found
        echo "<script>alert('Admin not found!'); window.location.href='SignIn_A.php';</script>";
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
		<a href="SingInAs.html"><i class="fas fa-user"></i></a> <!-- User Account Icon -->
    </div>
</header>

<!-- Centered container -->
    <div class="container">
        <div class="form-box">
            <h2>Sign In to Diorama as Admin</h2>
            <form action="SignIn_A.php" method="POST">
                <input type="email" name="signUpEmail_A" id="signUpEmail_A" placeholder="Email" required>
                <input type="password" name="signUpPassword_A" id="signUpPassword_A" placeholder="Password" required>
                <button type="submit" name="login">Sign In</button>
            </form>            
            <div id="error-message" style="color: red; display: none;">Admin account not found or incorrect password. Please try again.</div>
            <div class="signup-option">
                <p>Don't have an admin account? <a href="SignUp_A.php">Sign Up</a></p>
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
	
<script>
    // Function to check if the passwords match before submitting the form
    function validateForm(event) {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;
        if (password !== confirmPassword) {
            document.getElementById("message").textContent = "Passwords do not match!";
            event.preventDefault();
            return false;
        }
        return true;
    }
</script>
	
</body>
</html>
