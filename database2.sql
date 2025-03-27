CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    card_number VARCHAR(20),
    expiry_date VARCHAR(10),
    cvv VARCHAR(5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
