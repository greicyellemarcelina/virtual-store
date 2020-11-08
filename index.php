<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loja Virtual</title>
    <link rel="stylesheet" type="text/css" href="css/universal.css">
    <link rel="stylesheet" type="text/css" href="css/top.css">
    <link rel="stylesheet" type="text/css" href="css/body.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="account/css/register.css">
    <!-- imports -->
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Open+Sans+Condensed:wght@300&family=PT+Sans+Narrow&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/3ebafaacf8.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<?php
//db
require_once("db/db.php");
$time = 2 * 60 * 60; // time in session
session_set_cookie_params($time);
session_start();
$id = $_SESSION['id'];

/**************************************************/
/******************** get products ****************/
$query = ("SELECT * FROM products");
$results = mysqli_query($conn, $query);
$count = $results->num_rows;
if ($count > 16) {
    $count = 16;
}
/***************** end get prducts ****************/
/**************************************************/

function calculation_negotiate_2x(
    $amount_item,
    $quantity_parcel
) {
    $value_of_parcel = $amount_item / $quantity_parcel;
    $value_of_parcel = number_format($value_of_parcel, 2, ',', '.');
    $amount_item = number_format($amount_item, 2, ',', '.');

    $array_result = [
        'quantity_parcel' => $quantity_parcel,
        'value_of_parcel' => $value_of_parcel,
        'amount_payable' => $amount_item
    ];

    return $array_result;
}
try {
    if ($id !== NULL) {
        $query1 = ("SELECT * FROM `user` WHERE `id` = $id");
        $result1 = mysqli_query($conn, $query1);
        $userInfo = mysqli_fetch_assoc($result1);
        $_SESSION["name"] = $userInfo['name'];
    }
} catch (Exception $e) {
    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
}

?>

<body>
    <div class="container-universal">
        <div class="container-top transition-soft head-fix">
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
                <div class="container-register" id="container-register">
                    <div class="register-child-4">
                        <a class="link-my-account color-f27092" href="account/my_account.php">
                            <div class="register-child-4-icon padding-right-6">
                                <i class="fa fa-user-circle-o icon-user-name font-size-14" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="txt-user-name font-size-16 font-narrow">
                                    Olá,
                                    <?php
                                    if ($id == NULL) {
                                    ?> <script>
                                            document.getElementById("container-register").innerHTML = '<div class="register-child-1" id="register-child-1"><a href="account/register.php" class="font-condensed color-black">CADASTRE-SE</a></div><span>|</span><div class="register-child-2"><a href="account/login.php" class="font-condensed color-black"> INICIAR SESSÃO</a></div><div class="register-child-3"><i class="fa fa-cart-arrow-down font-size-24" aria-hidden="true"></i><div class="number-items-layout"><p class="color-white font-size-12 padding-left-6">0</p></div></div><div class="register-child-3"><div class=""><p class="color-black font-size-12 padding-left-6"></p></div></div>';
                                        </script>
                                    <?php } else {
                                        echo $userInfo['name'];
                                    } ?>
                                </p>
                            </div>
                        </a>
                        <div class="padding-left-4 padding-right-4 color-d2d2d2">
                            |
                        </div>
                        <form method="POST" action="account/ajax-signout.php">
                            <div class="padding-left-4 padding-top-2 font-size-14 font-narrow">
                                <button type="submit" class="link-signout color-black btn-not-border" id="btn-ajax-signout">
                                    Sair
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container-top-3">
                <div class="top-3-child-1 margin-right-18">
                    <a href="index.php" class="font-narrow color-f27092 color-hover">INÍCIO</a>
                </div>
                <div class="top-3-child-2 margin-right-18">
                    <a href="products.php" class="font-narrow color-black color-hover">PRODUTOS</a>
                </div>
                <div class="top-3-child-3">
                    <a href="contact/index.php" class="font-narrow color-black color-hover">CONTATO</a>
                </div>
            </div>

        </div>
        <div class="container-body">
            <div class="body-1">
                <p class="txt-body-1-info color-black font-size-11 font-balsamiq">
                    Pague em até 2x sem juros no cartão de crédito ou em até 12x com juros, <br>ou a vista com 5% de desconto por
                    depósito/transferência bancaria. Boas Compras 🛒
                </p>
            </div>
            <div class="container-products">
                <?php for ($i = 0; $i < $count; $i++) {
                    $products = mysqli_fetch_assoc($results);
                    $value_item = $products['value_item'];
                    $value_item = number_format($value_item, 2, ',', '.');

                    $parcel_2 = calculation_negotiate_2x($products['value_item'], 2, 1);

                ?>
                    <div class="product-item">
                        <a class="link-item-product" href="product.php?cod=<?= $products['id'] ?>">
                            <div class="product-item-img">
                                <?php echo '<img id="product-item-img" src="data:image/jpeg;base64,' . base64_encode($products['image_01']) . '" />'; ?>
                            </div>
                            <div class="product-item-desc">
                                <p class="txt-product-item font-size-12 font-narrow color-black">
                                    <?= $products['name']; ?>
                                </p>
                            </div>
                            <div class="product-item-price">
                                <p class="txt-product-price font-size-16 font-narrow color-black">
                                    <?php echo 'R$' . $value_item ?>
                                </p>
                            </div>
                            <div class="product-item-parc">
                                <p class="txt-product-parc font-size-14 font-narrow color-rosybrown">
                                    <strong>2x de
                                        <?php echo 'R$' . $parcel_2['value_of_parcel'] ?>
                                    </strong>
                                    sem juros
                                </p>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="container-btn-view-all">
                <div class="btn-view-all">
                    <a href="products.php" class="btn-products">
                        <p class="txt-view-all font-size-16 color-white font-narrow">
                            VER TODOS OS PRODUTOS
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="container-footer">
            <div class="container-footer-1">

                <div class="footer-navigation-1">
                    <label class="color-white font-size-16 font-narrow">
                        NAVEGAÇÃO
                    </label>

                    <div class="footer-navigation-home">
                        <a href="index.php" class="txt-footer-home font-condensed font-size-16 color-white">
                            INÍCIO
                        </a>
                    </div>
                    <div class="footer-navigation-products">
                        <a href="products.php" class="txt-footer-product font-condensed font-size-16 color-white">
                            PRODUTOS
                        </a>
                    </div>
                    <div class="footer-navigation-contact">
                        <a href="contact/index.php" class="txt-footer-contact font-condensed font-size-16 color-white">
                            CONTATO
                        </a>
                    </div>

                </div>
                <div class="footer-payment-post">
                    <label class="color-white font-size-16 font-narrow">
                        FORMAS DE PAGAMENTO
                    </label>
                    <div class="footer-payment">
                        <div class="footer-payment-item">
                            <img src="img/payment/visa.png" class="img-footer-payment">

                        </div>
                        <div class="footer-payment-item">
                            <img src="img/payment/master.jpg" class="img-footer-payment">
                        </div>
                        <div class="footer-payment-item">
                            <img src="img/payment/mercado-pago.png" class="img-footer-payment">
                        </div>
                    </div>

                    <label class="color-white font-size-16 font-narrow" id="txt-post">
                        FORMAS DE ENVIO
                    </label>
                    <div class="footer-post">
                        <div class="footer-post-item">
                            <img src="img/post/correios.jpg" class="img-footer-post">
                        </div>
                        <div class="footer-post-item">
                            <img src="img/post/sedex.png" class="img-footer-post">

                        </div>
                    </div>
                </div>
                <div class="footer-contact">
                    <label class="color-white font-size-16 font-narrow">
                        CONTATO
                    </label>
                    <div class="footer-contact-tel">
                        <i class="fa fa-whatsapp color-white" aria-hidden="true"></i>
                        <span class="color-white font-size-14 font-narrow">
                            (11) 9999-9999
                        </span>
                    </div>
                    <div class="footer-contact-email">
                        <i class="fa fa-envelope-o color-white" aria-hidden="true"></i>
                        <span class="color-white font-size-14 font-narrow">
                            contact@emmail.com
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>