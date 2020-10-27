<?php

require_once("../db/db.php");

$name = $_POST['name'];
$email = $_POST['email'];
$telephone = $_POST['tel'];
$password = MD5($_POST['password']);


$hoje = date('Y-m-d');
$query = "INSERT INTO `user` (`name`, `email`,`telephone`, `password`, `data_register`)
VALUES ( '$name', '$email', '$telephone', '$password', '$hoje')";
$result = $conn->prepare($query);
$result->execute();

?>

