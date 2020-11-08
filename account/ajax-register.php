<?php

require_once("../db/db.php");

$name = $_POST['name'];
$email = $_POST['email'];
$telephone = $_POST['tel'];
$password = MD5($_POST['password']);

$today = date('Y-m-d');
$query = "INSERT INTO `user` (`name`, `email`, `telephone`, `password`, `data_register`)
VALUES ( '$name', '$email', '$telephone', '$password', '$today')";
$result = $conn->prepare($query);
$result->execute();

$id = $result->insert_id;

$query2 = ("SELECT * FROM `user` WHERE `id` = $id");
$result2 = mysqli_query($conn, $query2);
$userInfo = mysqli_fetch_assoc($result2);


$query3 = "INSERT INTO `user_address` (`street`, `number`, `district`, `city`, `state`, `zip_code`, `user_id_pk`)
VALUES ( '', '', '', '', '', '', $id)";
$result3 = $conn->prepare($query3);
$result3->execute();

$arr = [];

echo json_encode($arr);

