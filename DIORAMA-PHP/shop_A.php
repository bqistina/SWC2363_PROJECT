<?php
include 'db_connection.php';  // Ensure the path to db_connection.php is correct

// Add new product
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $image_path = 'image/' . $image;

    if (move_uploaded_file($image_temp, $image_path)) {
        $stmt = $conn->prepare("INSERT INTO shop (name, description, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $name, $description, $price, $image);
        if ($stmt->execute()) {
            header('Location: shop_A.php');
            exit();
        } else {
            echo "Error adding product: " . $stmt->error;
        }
    } else {
        echo "Error uploading image.";
    }
}

// Update product
if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_query = '';  // Initialize image query string

    if (!empty($_FILES['image']['name'])) {
        // New image upload process
        $image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        $image_path = 'image/' . $image;
        
        // Move the uploaded image to the 'image/' directory
        if (move_uploaded_file($image_temp, $image_path)) {
            $image_query = ", image = ?"; // If image is updated, set the query to update image
        }
    }

    // Prepare the update query (update image only if a new image is uploaded)
    $stmt = $conn->prepare("UPDATE shop SET name = ?, description = ?, price = ? $image_query WHERE id = ?");
    if (!empty($image_query)) {
        $stmt->bind_param("ssisi", $name, $description, $price, $image, $product_id); // Bind new image to the query
    } else {
        $stmt->bind_param("ssii", $name, $description, $price, $product_id); // No image change
    }

    if ($stmt->execute()) {
        header('Location: shop_A.php');
        exit();
    } else {
        echo "Error updating product: " . $stmt->error;
    }
}

// Delete product
if (isset($_GET['delete'])) {
    $product_id = $_GET['delete'];
    $stmt = $conn->prepare("SELECT image FROM shop WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $image_path = 'image/' . $row['image'];

    $stmt = $conn->prepare("DELETE FROM shop WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    if ($stmt->execute()) {
        if (file_exists($image_path)) unlink($image_path);
        header('Location: shop_A.php');
        exit();
    } else {
        echo "Error deleting product: " . $stmt->error;
    }
}

// Search products
$search_term = '';
if (isset($_POST['search'])) {
    $search_term = $_POST['search_term'];
    $query = "SELECT ID, name, description, price, image FROM shop WHERE name LIKE ? OR description LIKE ?";
    $stmt = $conn->prepare($query);
    $search = '%' . $search_term . '%';
    $stmt->bind_param("ss", $search, $search);
} else {
    $query = "SELECT ID, name, description, price, image FROM shop";
    $stmt = $conn->prepare($query);
}
$stmt->execute();
$result = $stmt->get_result();

// Display products
function displayProducts($result) {
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="product-table">';
        echo '<tr><th>Name</th><th>Description</th><th>Price</th><th>Image</th><th>Actions</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = htmlspecialchars($row['ID']);
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['description']) . '</td>';
            echo '<td>' . htmlspecialchars($row['price']) . ' MYR</td>';
            echo '<td><img src="image/' . htmlspecialchars($row['image']) . '" style="width: 100px;"></td>';
            echo '<td>';
            echo '<a href="shop_A.php?view=' . $product_id . '">View</a> | ';
            echo '<a href="#" onclick="editProduct(' . $product_id . ', \'' . htmlspecialchars($row['name']) . '\', \'' . htmlspecialchars($row['description']) . '\', ' . htmlspecialchars($row['price']) . ', \'' . htmlspecialchars($row['image']) . '\')">Update</a> | ';
            echo '<a href="shop_A.php?delete=' . $product_id . '" onclick="return confirm(\'Are you sure?\')">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No products found.</p>';
    }
}

// View product details
if (isset($_GET['view'])) {
    $product_id = $_GET['view'];
    $stmt = $conn->prepare("SELECT * FROM shop WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    echo '<div class="view-product">';
    echo '<h2>Product Details</h2>';
    echo '<p><strong>Name:</strong> ' . htmlspecialchars($row['name']) . '</p>';
    echo '<p><strong>Description:</strong> ' . htmlspecialchars($row['description']) . '</p>';
    echo '<p><strong>Price:</strong> ' . htmlspecialchars($row['price']) . ' MYR</p>';
    echo '<p><img src="image/' . htmlspecialchars($row['image']) . '" style="width: 150px;"></p>';
    echo '</div>';
}
?>

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
        line-height: 1.6;
        margin: 0;
        padding: 0;
        background-color: #FFFFFF; /* White background */
        color: #333;
    }

    /* Header Styles */
    header {
        background-color: #38040E; /* Deep Maroon */
        color: white;
        padding: 10px 20px; /* Adjusted padding for compact design */
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional shadow for depth */
    }

    /* Logo Styles */
    .logo img {
        width: 150px;  /* Adjust logo width */
        height: 50px;  /* Adjust logo height */
    }

    /* Navigation Styles */
    nav {
        flex-grow: 1;
        display: flex;
        justify-content: center; /* Center the navigation */
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        gap: 20px; /* Spacing between items */
    }

    nav ul li a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        font-size: 1em; /* Adjust font size */
        transition: color 0.3s ease; /* Smooth color transition */
    }

    nav ul li a:hover {
        color: #8F3C55; /* Muted Rose hover effect */
    }

    /* Icon Styles */
    .icons {
        display: flex;
        align-items: center;
        gap: 15px; /* Spacing between icons */
    }

    .icons a {
        color: white;
        font-size: 1.5em; /* Adjust icon size */
        transition: color 0.3s ease; /* Smooth color transition */
    }

    .icons a:hover {
        color: #8F3C55; /* Muted Rose hover effect */
    }

    /* Optional Header Responsiveness */
    @media (max-width: 768px) {
        header {
            flex-wrap: wrap; /* Allow elements to wrap on smaller screens */
        }
        nav ul {
            flex-wrap: wrap;
            justify-content: center;
        }
        .icons {
            justify-content: flex-end;
            width: 100%;
        }
    }

    /* Admin Section Styles */
    .admin-section {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background: #FFFFFF; /* White */
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .admin-section h2 {
        color: #38040E; /* Deep Maroon */
        margin-bottom: 20px;
        font-size: 1.8rem;
    }

    form {
        margin-bottom: 20px;
    }

    form input, form textarea, form button {
        display: block;
        width: 100%;
        margin-bottom: 10px;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #DDD;
        border-radius: 4px;
    }

    form button {
        background-color: #38040E; /* Deep Maroon (Burgundy) */
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        padding: 10px;
        font-size: 1rem;
        transition: background 0.3s ease;
    }

    form button:hover {
        background-color: #5A1C29; /* Slightly lighter shade for hover effect */
    }

    /* Product Table Styles */
    .product-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #FFFFFF; /* White */
    }

    .product-table th, .product-table td {
        text-align: left;
        padding: 10px;
        border: 1px solid #DDD;
    }

    .product-table th {
        background-color: #E6E6E6; /* Light Gray for headers */
        color: #38040E; /* Deep Maroon */
    }

    .product-table td {
        background-color: #FFFFFF; /* White */
    }

    .product-table img {
        max-width: 100px;
        height: auto;
        border-radius: 4px;
    }

    .product-table a {
        text-decoration: none;
        color: #8F3C55; /* Muted Rose */
        padding: 5px;
    }

    .product-table a:hover {
        color: #38040E; /* Deep Maroon */
    }

    /* View Product Section */
    .view-product {
        padding: 20px;
        background-color: #FFFFFF; /* White */
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 20px auto;
    }

    .view-product h2 {
        color: #38040E; /* Deep Maroon */
    }

    .view-product p {
        color: #333;
    }
</style>

<script>
        function editProduct(id, name, description, price, currentImage) {
            document.getElementById('updateProductId').value = id;
            document.getElementById('updateName').value = name;
            document.getElementById('updateDescription').value = description;
            document.getElementById('updatePrice').value = price;

            // Display the current image in the preview section
            const imagePreview = document.getElementById('imagePreview');
            if (imagePreview) {
                imagePreview.src = 'image/' + currentImage;
                imagePreview.style.display = 'block';
            }

            // Show the update product form
            document.getElementById('updateProduct').style.display = 'block';
        }
    </script>

</head>
<body>
    <!-- Header -->
    <header>
        <!-- Logo on the left -->
        <div class="logo">
            <a href="HomePage_A.php"><img src="image/Logo diorama.png" alt="Diorama Logo"></a>
        </div>

        <!-- Navigation in the center -->
        <nav>
            <ul>
                <li><a href="HomePage_A.php">Home</a></li>
                <li><a href="shop_A.php">Shop All</a></li>
                <li><a href="AboutUs.php">About Us</a></li>
            </ul>
        </nav>

        <!-- Shopping Bag and User Icons on the right -->
        <div class="icons">
            <a href="ShoppingCart.php"><i class="fas fa-shopping-bag"></i></a>
            <span id="cart-counter" style="color: white; font-size: 1.2em; margin-left: 5px;">0</span>
            <a href="SignIn_A.php"><i class="fas fa-user"></i></a>
        </div>
    </header>

    <div class="admin-section">
        <!-- Add New Product Form -->
        <h2>Add New Product</h2>
        <form action="shop_A.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Name" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="number" name="price" placeholder="Price (MYR)" required>
            <input type="file" name="image" required>
            <button type="submit" name="add_product">Add Product</button>
        </form>

        <hr>

        <!-- Search Form -->
        <form action="shop_A.php" method="POST">
            <input type="text" name="search_term" placeholder="Search...">
            <button type="submit" name="search">Search</button>
        </form>

        <!-- Update Product Form (Initially Hidden) -->
        <div id="updateProduct" style="display: none;">
            <h2>Update Product</h2>
            <form action="shop_A.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="product_id" id="updateProductId">
                <input type="text" name="name" id="updateName" required>
                <textarea name="description" id="updateDescription" required></textarea>
                <input type="number" name="price" id="updatePrice" required>

                <!-- Image Preview (Shows current image before updating) -->
                <div>
                    <label>Current Image:</label><br>
                    <img id="imagePreview" style="width: 100px; display: none;" alt="Current Image Preview">
                </div>

                <input type="file" name="image">
                <button type="submit" name="update_product">Update</button>
            </form>
        </div>

        <!-- Existing Products -->
        <h2>Existing Products</h2>
        <?php displayProducts($result); ?>
    </div>

    <script>
        // JavaScript to handle showing the update form with current product details
        function editProduct(id, name, description, price, currentImage) {
            document.getElementById('updateProductId').value = id;
            document.getElementById('updateName').value = name;
            document.getElementById('updateDescription').value = description;
            document.getElementById('updatePrice').value = price;

            // Display the current image in the preview section
            const imagePreview = document.getElementById('imagePreview'); 
            if (imagePreview) {
                imagePreview.src = 'image/products/' + currentImage;
                imagePreview.style.display = 'block';
            }


            // Show the update product form
            document.getElementById('updateProduct').style.display = 'block';
        }
    </script>
</body>

</html>