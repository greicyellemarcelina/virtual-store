<?php

require_once("../db/db.php");
/*
$name = $_POST['txt-name'];
$email = $_POST['txt-email'];
$cpf = $_POST['txt-cpf'];
$telephone = $_POST['txt-tel'];
$password = MD5($_POST['txt-password']);
*/
//$status = 'default';

$name = $_POST['name'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$telephone = $_POST['tel'];
$password = MD5($_POST['password']);


/*
$array = [
    $name,
    $email,
    $cpf,
    $telephone,
    $password
];

var_dump($array);
*/
//if ($status = 'default') {

    //} else {
    $today = date('Y-m-d');
    $query = "INSERT INTO `user` (`name`, `email`, `cpf`, `telephone`, `password`, `data_register`)
    VALUES ( '$name', '$email', '$cpf','$telephone', '$password', '$today')";
    $result = $conn->prepare($query);
    $result->execute();

    $id = $result->insert_id;

    $status = 'created';

    $query2 = ("SELECT * FROM `user` WHERE `id` = $id");
    $result2 = mysqli_query($conn, $query2);
    $userInfo = mysqli_fetch_assoc($result2);

    $query3 = "INSERT INTO `user_address` (`street`, `number`, `district`, `city`, `state`, `zip_code`, `user_id_pk`)
    VALUES ( '', '', '', '', '', '', $id)";
    $result3 = $conn->prepare($query3);
    $result3->execute();

$arr = [
    "status" => $id
];

echo json_encode($arr);
