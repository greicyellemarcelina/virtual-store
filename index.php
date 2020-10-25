<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/universal.css">
    <link rel="stylesheet" type="text/css" href="css/top.css">
    <link rel="stylesheet" type="text/css" href="css/body.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <!-- imports -->
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Open+Sans+Condensed:wght@300&family=PT+Sans+Narrow&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/3ebafaacf8.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">




</head>
<?php
//db
require_once("db/db.php");
?>

<body>
    <div class="container-universal">
        <div class="container-top">
            <div class="container-top-1">
                <span class="color-white font-size-12 font-balsamiq " id="span-top-1">
                    Mínimo de compras R$400 | Prazo para postagem: 20 a 30 dias úteis
                </span>
            </div>
            <div class="container-top-2">
                <div class="container-search">
                    <input type="text" id="input-search" name="input-search" placeholder="Buscar">
                    <i class="fa fa-search" aria-hidden="true" id="icon-search"></i>
                </div>
                <div class="container-logo">
                    <img src="img/logo.png" id="img-logo-width">

                </div>
                <div class="container-register">
                    <div class="register-child-1">
                        <a href="register.php" class="font-condensed color-black">CADASTRE-SE</a>
                    </div>
                    <span>|</span>
                    <div class="register-child-2">
                        <a href="login.php" class="font-condensed color-black"> INICIAR SESSÃO</a>
                    </div>
                    <div class="register-child-3">
                        <i class="fa fa-cart-arrow-down font-size-24" aria-hidden="true"></i>
                        <div class="number-items-layout">
                            <p class="color-white font-size-12 padding-left-6">0</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-top-3">
                <div class="top-3-child-1 margin-right-18">
                    <a href="index.php" class="font-narrow color-f27092 color-hover">INÍCIO</a>
                </div>
                <div class="top-3-child-2 margin-right-18">
                    <a href="index.php" class="font-narrow color-black color-hover">PRODUTOS</a>
                </div>
                <div class="top-3-child-3">
                    <a href="index.php" class="font-narrow color-black color-hover">CONTATO</a>
                </div>
            </div>

        </div>
        <div class="container-body">

        </div>
        <div class="container-footer">

        </div>

    </div>

</body>

</html>