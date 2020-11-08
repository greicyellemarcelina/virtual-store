<?php 
require_once("../db/db.php");

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$zip_code = $_POST['zipcode'];
$street = $_POST['street'];
$number = $_POST['number'];
$district = $_POST['district'];
$city = $_POST['city'];
$state = $_POST['state'];

try {
    $query = "UPDATE `user` SET `name`='$name', `email`='$email', `telephone`='$telephone'
                WHERE `id` = $id";
     $result = $conn->prepare($query);
     $result->execute();
} catch (Exception $e) {
    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
}

try {
    $query = "UPDATE `user_address` SET `street`='$street', `number`='$number', `district`='$district',
    `city`='$city', `state`='$state', `zip_code`='$zip_code'
                WHERE `user_id_pk` = $id";
     $result = $conn->prepare($query);
     $result->execute();
} catch (Exception $e) {
    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
}


$arr = [
];


echo json_encode($arr);



