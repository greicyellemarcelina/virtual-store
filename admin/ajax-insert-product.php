<?php

require_once("../db/db.php");

$name = $_POST['txt-name'];
$description = $_POST['txt-description'];
$value_item = $_POST['txt-value'];
$id_category = $_POST['txt-category'];

//images
$image_1 = $_FILES['image-1']['tmp_name'];
$image_2 = $_FILES['image-2']['tmp_name'];
$image_3 = $_FILES['image-3']['tmp_name'];

if (isset($_FILES["image-1"]["tmp_name"])){
    $image_1 =  addslashes(file_get_contents($_FILES["image-1"]["tmp_name"]));
}
if (isset($_FILES["image-2"]["tmp_name"])){
    $image_2 =  addslashes(file_get_contents($_FILES["image-2"]["tmp_name"]));
}
if (isset($_FILES["image-3"]["tmp_name"])){
    $image_3 =  addslashes(file_get_contents($_FILES["image-3"]["tmp_name"]));
}

try {
    $query = "INSERT INTO products (`name`, `description`, `value_item`, `image_01`, `image_02`, `image_03`, `id_category_pk`) 
                VALUES ('$name','$description','$value_item','$image_1','$image_2', '$image_3', '$id_category')";
    $result = $conn->prepare($query);
    $result->execute();
} catch (Exception $e) {
    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
}

?>
<script>//
    alert('Inserido com sucesso!');
    window.location.href = 'products.php';

</script>