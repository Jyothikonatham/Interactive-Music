<?php
session_start();
require_once 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $payment_method = $conn->real_escape_string($_POST['payment-method']);

    // Additional fields based on payment method
    $card_number = isset($_POST['card-number']) ? $conn->real_escape_string($_POST['card-number']) : null;
    $expiry_date = isset($_POST['expiry-date']) ? $conn->real_escape_string($_POST['expiry-date']) : null;
    $cvv = isset($_POST['cvv']) ? $conn->real_escape_string($_POST['cvv']) : null;

    // Insert data into the database
    $sql = "INSERT INTO registrations (name, email, phone, password, payment_method, card_number, expiry_date, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $name, $email, $phone, $password, $payment_method, $card_number, $expiry_date, $cvv);

    if ($stmt->execute()) {
        echo "<h2>Thank you for registering!</h2>";
        echo "<p>Your registration was successful. We will contact you shortly with more details about the lessons.</p>";
    } else {
        echo "<h2>Error:</h2>";
        echo "<p>" . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Learning Platform</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #fff;
            background-color: rgba(150,200,150,0.2);    
        }
        .container h1{
    color:rgb(89, 43, 215);
}

    /* Header Styles */
header {
    background-color: rgba(143, 29, 91, 0.4); /* Semi-transparent blue */
    padding: 20px 0;
    text-align: center;
}

header h1 {
    font-size: 2.5rem;
    margin: 0;
}

header nav ul {
    list-style: none;
    padding: 0;
    margin: 10px 0 0;
    display: flex;
    justify-content: center;
    gap: 15px;
}

header nav ul li {
    margin: 0;
}

header nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 1.2rem;
    padding: 10px 20px;
    background: #555;
    border-radius: 5px;
    transition: background 0.3s ease;
}

header nav ul li a:hover {
    background: #777;
}

        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .registration-form {
            background: #fff;
            color: #333;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
        }

        .registration-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4c6ef5;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .form-group input:focus, 
        .form-group select:focus {
            border-color: #4c6ef5;
            outline: none;
        }

        .form-group button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background: linear-gradient(135deg, #4c6ef5, #3b3dbf);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .form-group button:hover {
            background: linear-gradient(135deg, #3b3dbf, #4c6ef5);
        }

        .payment-method-details {
            display: none;
            font-size: 14px;
            color: #555;
        }

        #confirmation-message {
            text-align: center;
            padding: 20px;
        }

        #confirmation-message h2 {
            color: #4c6ef5;
        }
/* Footer Styles */
footer {
    background-color:rgba(143, 29, 91, 0.4);
    text-align: center;
    padding: 10px;
    margin-top: 40px;
}
h2,p{
    background-color:skyblue;
}
    </style>
   
</head>
<body>
    <header>
        <div class="container">
            <h1>Music Learning Platform</h1>
            <nav>
                <ul>
                    <li><a href="instrument.html">Instruments</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="registration.php">Registration</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <form action="registration.php" method="POST">

    <main>
        <section class="registration-form">
            <h2 style = "color=pink">Register for Music Lessons</h2>
            <form id="registerForm" action="submit_form.php" method="POST">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="form-group">
                    <label for="payment-method">Choose Payment Method:</label>
                    <select id="payment-method" name="payment-method" required>
                        <option value="paypal">PayPal</option>
                        <option value="credit-card">Credit/Debit Card</option>
                        <option value="bank-transfer">Bank Transfer</option>
                    </select>
                </div>

                <div id="paypal-info" class="payment-method-details">
                    <p>Pay securely with PayPal.</p>
                </div>

                <div id="credit-card-info" class="payment-method-details">
                    <label for="card-number">Card Number</label>
                    <input type="text" id="card-number" name="card-number" placeholder="Enter your card number">
                    <label for="expiry-date">Expiry Date</label>
                    <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/YY">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="Enter CVV">
                </div>

                <div id="bank-transfer-info" class="payment-method-details">
                    <p>Please contact us at support@musicplatform.com for bank transfer details.</p>
                </div>

                <div class="form-group">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </section>

        <section id="confirmation-message" style="display: none;">
            <h2>Thank you for registering!</h2>
            <h3>Your registration was successful. We will contact you shortly with more details about the lessons.</h3>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Music Learning Platform</p>
    </footer>

    <script>
        const paymentMethod = document.getElementById('payment-method');
        const paypalInfo = document.getElementById('paypal-info');
        const creditCardInfo = document.getElementById('credit-card-info');
        const bankTransferInfo = document.getElementById('bank-transfer-info');

        paymentMethod.addEventListener('change', function () {
            paypalInfo.style.display = 'none';
            creditCardInfo.style.display = 'none';
            bankTransferInfo.style.display = 'none';

            if (this.value === 'paypal') {
                paypalInfo.style.display = 'block';
            } else if (this.value === 'credit-card') {
                creditCardInfo.style.display = 'block';
            } else if (this.value === 'bank-transfer') {
                bankTransferInfo.style.display = 'block';
            }
        });

        document.getElementById('registerForm').addEventListener('submit', function (event) {
            event.preventDefault();
            document.querySelector('.registration-form').style.display = 'none';
            document.getElementById('confirmation-message').style.display = 'block';
        });
    </script>
</body>
</html>
