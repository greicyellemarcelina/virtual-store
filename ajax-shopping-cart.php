<?php

require_once("db/db.php");

//$session_id = $_POST['sessionId'];
$session_id = $_POST['txt-id'];

$query = ("SELECT * FROM `shopping_cart` WHERE `session_id` = $session_id");
$result = mysqli_query($conn, $query);
$num_rows = $result->num_rows;

for ($i = 0; $i < $num_rows; $i++) {
    $productInfo = mysqli_fetch_assoc($result);
    var_dump($productInfo);

}
$arr = [
];

echo json_encode($arr);

