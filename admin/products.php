<?php

require_once("../db/db.php");
$result = $pdo_connection->prepare('select * from categories');
$result->execute();
$categories = $result->fetchAll(PDO::FETCH_ASSOC);

$query = ("SELECT * FROM products");
$results = mysqli_query($conn, $query);
$count = $results->num_rows;


?>
<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loja Virtual</title>
    <!-- imports -->
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Open+Sans+Condensed:wght@300&family=PT+Sans+Narrow&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/3ebafaacf8.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container-universal">
        <div class="container-form" style="margin: 32px;">
            <form enctype="multipart/form-data" action="ajax-insert-product.php" method="POST">
                <div class="form-row">
                    <div class="col">
                        <label>Nome Item</label>
                        <input id="txt-name" type="text" class="form-control" placeholder="Nome" name="txt-name" required>
                        <br>
                    </div>
                    <div class="col">
                        <label>Descrição</label>
                        <input id="txt-description" type="text" class="form-control" placeholder="Descrição" name="txt-description" required>
                        <br>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label>Valor</label>
                        <input id="txt-value" type="text" class="form-control" placeholder="Valor" name="txt-value" required><br>
                    </div>
                    <div class="col">
                        <select id="txt-category" name="txt-category" class="form-control">
                            <?php
                            foreach ($categories as $description) {
                                $category = $description;
                            ?>
                                <option value='<? echo $category['id'] ?>' selected>
                                <?php
                                echo $category['description'];
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div>
                    <br>
                    <div class="form-row">
                        <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
                        <div>
                            <label>Imagem 1</label><br>
                            <input id="image-1" name="image-1" type="file" style="padding-right: 40px;" />
                        </div>
                        <div>
                            <label>Imagem 2</label><br>
                            <input id="image-2" name="image-2" type="file" style="padding-right: 40px;" />
                        </div>
                        <div>
                            <label>Imagem 3</label><br>
                            <input id="image-3" name="image-3" type="file" />
                        </div>
                    </div>

                    <div style="margin-top: 32px; display: flex; justify-content: center;">
                        <button type="submit" class="btn btn-success" value="Salvar" id="btnSalvar">
                            <i class="fa fa-save"></i>
                            Salvar
                        </button>
                    </div>
            </form>
        </div>
    </div>
</body>

</html>
<style>
    .container-universal {
        display: flex;
        justify-content: center;
    }

    .container-form {
        width: 90%;
        height: 400px;
    }

    #btnSalvar {
        width: 120px;
        height: 40px;
        font-size: 14px;
    }
</style>