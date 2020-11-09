<?php

require_once("../db/db.php");

$email = $_POST['email'];

$query = ("SELECT `id`,`email` FROM `user` WHERE `email` = '$email'");
$result = mysqli_query($conn, $query);
$userCredential = mysqli_fetch_assoc($result);

if (!$userCredential) {
    $id = 'id_not_found';
    $password = 'nao';
    $new_password = 'nao nao ';
} else {
    $id_user = $userCredential['id'];
    $password =  mt_rand(00000000, 99999999);
    $new_password = MD5($password);
    $query = "UPDATE `user` SET `password`='$new_password'
                WHERE `id` = $id_user";
    $result = $conn->prepare($query);
    $result->execute();
    $id = 'id_found';
}


$arr = [
    "id" => $id,
    "password" => $password,
    "new_password" => $new_password
];
echo json_encode($arr);
