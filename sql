CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    fullname VARCHAR(100),
    role ENUM('admin','user','customer','employee') NOT NULL
);
