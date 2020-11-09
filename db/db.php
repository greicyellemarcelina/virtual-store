<?php
$servername = "localhost";
$database = "loja_virtual";
$username = "root";
$pass = "";

//Create connection PDO
try {
    $pdo_connection = new PDO("mysql:host=$servername;dbname=$database","$username","$pass");
    $pdo_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

//Create connection
$conn = mysqli_connect($servername, $username, $pass, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>