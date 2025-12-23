<?php
// Database connection details
$servername = "localhost";
// Determine if the server is localhost
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $username = "root";
    $dbname = "omesaishipyard";
    $password = "";
} else {
    $username = "u805775687_omesaishipyard";
    $dbname = "u805775687_omesaishipyard";
    $password = "Omesaishipyard01";
}
 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
