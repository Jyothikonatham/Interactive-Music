<?php
session_start();
require_once 'db.php'; // Database connection

// Handle Signup
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Encrypt password

        // Check if email already exists
        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {
            // Insert user into database
            $query = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$hashed_password')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['user_id'] = mysqli_insert_id($conn); // Store user session
                header('Location: login.php'); // Redirect to welcome page after successful signup
            } else {
                echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
            }
        } else {
            echo "<p style='color:red;'>Email already exists!</p>";
        }
    } else {
        echo "<p style='color:red;'>Passwords do not match!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Learning Platform - Signup</title>
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
            background-image: url('signup image.avif'); 
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

        <!-- Signup Form Section -->
        <div class="form-container">
            <div class="form-box">
                <h2>Create an account</h2>
                <form action="signup.php" method="POST">
                    <input type="text" class="input-field" name="full_name" placeholder="Full Name" required>
                    <input type="email" class="input-field" name="email" placeholder="Email" required>
                    <input type="password" class="input-field" name="password" placeholder="Password" required>
                    <input type="password" class="input-field" name="confirm_password" placeholder="Confirm Password" required>
                    <button type="submit" class="button" name="signup">Sign Up</button>
                </form>
                <div class="toggle-link">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
