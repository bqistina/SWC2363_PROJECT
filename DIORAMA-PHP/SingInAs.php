<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In as User or Admin</title>

    <!-- Adding Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F8F8;
            text-align: center;
            margin-top: 50px;
        }

        .btn-option {
            width: 250px;
            margin: 20px;
            padding: 15px;
            font-size: 1.2em;
            color: white;
            background-color: #6F213C; /* Burgundy */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-option:hover {
            background-color: #8F3C55; /* Muted Rose on hover */
        }

        h1 {
            font-size: 2.5em;
            color: #38040E; /* Deep Maroon */
        }

        .btn-back {
            margin-top: 30px;
            font-size: 1.2em;
            color: #6F213C;
            background-color: transparent;
            border: none;
        }
    </style>
</head>
<body>

    <h1>Sign In as</h1>

    <!-- Sign In Options -->
    <div>
        <button class="btn-option" onclick="window.location.href='signInEngine.php'">User</button>
        <button class="btn-option" onclick="window.location.href='SignIn_A.php'">Admin</button>
    </div>

    <!-- Back button -->
    <div>
        <button class="btn-back" onclick="window.history.back();">
            <i class="fas fa-arrow-left"></i> Back to Mainpage
        </button>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</body>
</html>
