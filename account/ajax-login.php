<?php

require_once("../db/db.php");
session_start();

$email = $_POST['email'];
$password = MD5($_POST['password']);

$query = ("SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$password'");
$result = mysqli_query($conn, $query);
$userCredential = mysqli_fetch_assoc($result);

if (!$userCredential) {
    $id = 'id_not_found';
    unset($_SESSION["id"]);
    unset($_SESSION["name"]);
    session_destroy();
} else {
    $_SESSION["name"] = $userCredential['name'];
    $_SESSION["id"] = $userCredential['id'];
    $id = $_SESSION['id'];
}


$arr = [
    "id" => $id
];

echo json_encode($arr);
