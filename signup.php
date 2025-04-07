<?php
$servername = "localhost";
$username = "root"; // Default username for WAMP
$password = ""; // Default password is empty
$database = "user_dbs";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Signup 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $name = trim($_POST['name']);
     $email = trim($_POST['email']);
     $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password
 
     // Prepare SQL statement to prevent SQL injection
     $stmt = $conn->prepare("INSERT INTO user_table (name, email, password) VALUES (?, ?, ?)");
     $stmt->bind_param("sss", $name, $email, $password);
}
 
     if ($stmt->execute()) {
         echo "User registered successfully!";
     } else {
         echo  $stmt->error;
     }
?>