<?php

require_once("db/db.php");

$value_freight = $_POST['valueFreight'];
$cod_product = $_POST['cod'];
$session_id = $_POST['sessionId'];
$quantity = $_POST['quantity'];

$value_freight = str_replace("SEDEX R$","",$value_freight);
$value_freight = str_replace(",",".",$value_freight);


$query = ("SELECT `name`, `value_item` FROM `products` WHERE `id` = $cod_product");
$result = mysqli_query($conn, $query);
$productInfo = mysqli_fetch_assoc($result);

$value_item = $productInfo['value_item'];
$name_product = $productInfo['name'];

$value_total = $value_item * $quantity;

$today = date('Y-m-d');
$query2 = "INSERT INTO `shopping_cart` ( `cod`, `name`, `amount_paid`, `amount_paid_total`, `quantity`, `value_freight`, `data_purchase`, `session_id`)
VALUES ( $cod_product, '$name_product', $value_item, $value_total, '$quantity', $value_freight, '$today', $session_id)";
$result2 = $conn->prepare($query2);
$result2->execute();


$arr = [
];

echo json_encode($arr);

