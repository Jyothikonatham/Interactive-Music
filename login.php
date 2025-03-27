<?php
session_start();
require_once 'db.php'; // Database connection

// Handle Login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize input
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Check if user exists
    $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: instrument.html'); // Redirect to welcome page after successful login
    } else {
        echo "<p style='color:red;'>Invalid login details!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Learning Platform - Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }
        .container {
            display: flex;
            flex: 1;
        }
        .image-container {
            flex: 1;
            background-image: url('login image.jpg'); 
            background-size: cover;
            background-position: center;
        }
        .form-container {
            flex: 1;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        .form-box {
            background-color: #fff;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .input-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #2980b9;
        }
        .toggle-link {
            text-align: center;
            margin-top: 15px;
        }
        .toggle-link a {
            color: #3498db;
            text-decoration: none;
        }
        .toggle-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Image Section -->
        <div class="image-container"></div>

        <!-- Login Form Section -->
        <div class="form-container">
            <div class="form-box">
                <h2> USER LOGIN</h2>
                <form action="login.php" method="POST">
                    <input type="email" class="input-field" name="email" placeholder="Email" required>
                    <input type="password" class="input-field" name="password" placeholder="Password" required>
                    <button type="submit" class="button" name="login">Login</button>
                </form>
                <div class="toggle-link">
                    <p>New user? <a href="signup.php">Create an account</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
