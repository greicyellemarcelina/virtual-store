<?php

require_once("../db/db.php");
$name = $_POST['name'];
$email = $_POST['email'];
$telephone = $_POST['tel'];
$message = $_POST['message'];


$today = date('Y-m-d');
$query = "INSERT INTO `message_inbox` (`name`, `email`, `telephone`, `message`, `date_message`)
VALUES ('$name', '$email', '$telephone', '$message', '$today')";
$result = $conn->prepare($query);

$result->execute();

$arr = [
    "message" => $message
];

echo json_encode($arr);

