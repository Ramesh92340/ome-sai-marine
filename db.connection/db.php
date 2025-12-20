<?php
$host = 'localhost';
// Determine if the server is localhost
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $user = "root";
    $pass = "";
    $db = "ome_sai_marine";
} else {
    $user = "ome_sai_marine";
    $pass = "DEWzGnaO8rMVX3p";
    $db = "ome_sai_marine";
}



try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $db :" . $e->getMessage());
}
