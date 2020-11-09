<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loja Virtual</title>
    <link rel="stylesheet" type="text/css" href="css/universal.css">
    <link rel="stylesheet" type="text/css" href="css/top.css">
    <link rel="stylesheet" type="text/css" href="css/body.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/product.css">
    <link rel="stylesheet" type="text/css" href="account/css/register.css">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@700&display=swap" rel="stylesheet">
    <!-- imports -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Open+Sans+Condensed:wght@300&family=PT+Sans+Narrow&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/3ebafaacf8.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- -Javascript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<?php
//db
require_once("db/db.php");
########################################################################
$time = 2 * 60 * 60; // 
session_set_cookie_params($time);
session_start();

try {
    $id = $_SESSION["id"];
    if ($id !== NULL) {
        $query1 = ("SELECT * FROM `user` WHERE `id` = $id");
        $result1 = mysqli_query($conn, $query1);
        $userCredential = mysqli_fetch_assoc($result1);

        $_SESSION["id"] = $userCredential['id'];
        $_SESSION["name"] = $userCredential['name'];
        $id = $_SESSION["id"];
    }
} catch (Exception $e) {
    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
}

$cod = $_GET['cod'];
$query = ("SELECT * FROM products WHERE id = $cod");
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);
$value_item = $product['value_item'];
$value_item = number_format($value_item, 2, ',', '.');



/**************************************************/
/*********** get quant item in cart ***************/
$query2 = ("SELECT COUNT(`session_id`) AS numberOfItens FROM shopping_cart WHERE `session_id` = $id");
$result2 = mysqli_query($conn, $query2);
$cartInfo = mysqli_fetch_assoc($result2);
$quantity_item_cart = $cartInfo['numberOfItens'];

if ($quantity_item_cart == NULL) {
    $quantity_item_cart = 0;
}
/***************** end get item ******************/
/**************************************************/


function calculation_negotiate(
    $amount_item,
    $quantity_parcel,
    $juros
) {
    $juros_float = $juros / 100;

    $amount_juros_total = $amount_item * $juros_float;
    $value_of_parcel = ($amount_item + $amount_juros_total) / $quantity_parcel;

    $amount_payable = $amount_item + $amount_juros_total;

    $amount_payable = number_format($amount_payable, 2, ',', '.');
    $value_of_parcel = number_format($value_of_parcel, 2, ',', '.');
    $amount_item = number_format($amount_item, 2, ',', '.');
    $amount_juros_total = number_format($amount_juros_total, 2, ',', '.');

    $array_result = [
        'amount_item' => $amount_item,
        'juros' => $juros,
        'quantity_parcel' => $quantity_parcel,
        'amount_juros_total' => $amount_juros_total,
        'value_of_parcel' => $value_of_parcel,
        'amount_payable' => $amount_payable
    ];

    return $array_result;
}

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

$parcel_2 = calculation_negotiate_2x($product['value_item'], 2, 1);
$parcel_3 = calculation_negotiate($product['value_item'], 3, 3.5);
$parcel_4 = calculation_negotiate($product['value_item'], 4, 4.5);
$parcel_5 = calculation_negotiate($product['value_item'], 5, 6.5);
$parcel_6 = calculation_negotiate($product['value_item'], 6, 10);
$parcel_7 = calculation_negotiate($product['value_item'], 7, 13);
$parcel_8 = calculation_negotiate($product['value_item'], 8, 14);
$parcel_9 = calculation_negotiate($product['value_item'], 9, 15);
$parcel_10 = calculation_negotiate($product['value_item'], 10, 19.5);
$parcel_11 = calculation_negotiate($product['value_item'], 11, 26);
$parcel_12 = calculation_negotiate($product['value_item'], 12, 30);

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
                        <a class="link-my-account color-f27092" href="my_account.php">
                            <div class="register-child-4-icon padding-right-6">
                                <i class="fa fa-user-circle-o icon-user-name font-size-14" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="txt-user-name font-size-16 font-narrow">
                                    Olá,
                                    <?php
                                    if ($id == NULL) { ?>
                                        <script>
                                            document.getElementById("container-register").innerHTML = '<div class="register-child-1" id="register-child-1"><a href="account/register.php" class="font-condensed color-black">CADASTRE-SE</a></div><span>|</span><div class="register-child-2"><a href="account/login.php" class="font-condensed color-black"> INICIAR SESSÃO</a></div><div class="register-child-3"><div class=""><p class="color-black font-size-12 padding-left-6"></p></div></div>';
                                        </script>
                                    <?php } else {
                                        echo $userCredential['name'];
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
                    <div class="register-child-3">
                        <i class="fa fa-cart-arrow-down font-size-32" aria-hidden="true"></i>
                        <div class="number-items-layout">
                            <p class="color-white font-size-12 padding-left-6">
                                <?= $quantity_item_cart ?>
                            </p>
                        </div>
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
                    Pague em até 2x sem juros no cartão de crédito ou em até 12x com juros. <br>
                    Boas Compras 🛒
                </p>
            </div>
            <div class="container-product-2">
                <div class="product-item-2">
                    <div class="product-left">
                        <div class="product-item-img-2">
                            <?php echo '<img id="product-item-img-2" src="data:image/jpeg;base64,' . base64_encode($product['image_01']) . '" />'; ?>
                        </div>
                    </div>
                    <div class="product-right">
                        <div class="product-item-desc-2">
                            <p class="txt-product-item-2 font-size-32 font-weight-1000 font-narrow color-black">
                                <?= $product['name']; ?>
                            </p>
                        </div>
                        <div class="product-item-price-2">
                            <p class="txt-product-price-2 font-narrow font-size-42 color-black">
                                <? echo 'R$' . $value_item ?>
                            </p>
                        </div>
                        <div class="product-item-parc-2">
                            <button class="btn-parc" data-toggle="modal" data-target="#modalExemplo">
                                <p class="txt-product-parc-2 font-size-14 font-narrow color-f27092">
                                    <strong>2x de
                                        <?php echo 'R$' . $parcel_2['value_of_parcel'] ?>
                                    </strong>
                                    sem juros
                                </p>
                            </button>
                        </div>
                        <div class="product-item-card">
                        </div>
                        <div class="product-descount">
                            <p class="txt-product-descount color-515050 font-narrow">
                                <strong class="color-black">5% de desconto </strong> para pagamento á vista
                            </p>
                        </div>
                        <div class="product-payments">
                            <!-- Botão para acionar modal -->
                            <button class="btn-payments" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">
                                <p class="txt-product-payments color-f27092 font-narrow">
                                    VER MEIOS DE PAGAMENTO
                                </p>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <div class="container-modal-top">
                                                <div class="div-mercado-pago">
                                                    <a class="link-top-mercado-pago color-f27092 font-narrow font-size-14" font-size-12 href="#">
                                                        MERCADO PAGO
                                                    </a>
                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="margin-botton-12">
                                                <p class="txt-card-credit font-size-14 font-narrow font-weight-1000">
                                                    Cartões de crédito
                                                </p>
                                            </div>
                                            <div class="img-payments">
                                                <img src="img/payment/visa.png" class="img-modal-payment">
                                                <img src="img/payment/master-product.png" class="img-modal-payment">
                                                <img src="img/payment/hipercard.png" class="img-modal-payment">
                                                <img src="img/payment/american-express.jpg" class="img-modal-payment">
                                                <img src="img/payment/elo.png" class="img-modal-payment">
                                            </div>
                                            <br>
                                            <div class="border-dotted">
                                            </div>
                                            <br>
                                            <table class="table table-striped ">
                                                <thead>
                                                    <tr>
                                                        <th class="th-parc font-narrow" scope="col">Parcelas</th>
                                                        <th class="th-clean" scope="col"></th>
                                                        <th class="th-total font-narrow" scope="col">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class=tr-body-parc>
                                                        <th class="font-narrow" scope="row">1 x</th>
                                                        <td class="font-narrow">
                                                            de
                                                            <span class="color-f27092 font-weight-1000 font-narrow">
                                                                <?= $value_item ?>
                                                            </span>
                                                            sem juros
                                                        </td>
                                                        <td class="font-narrow">
                                                            <? echo 'R$' . $value_item; ?>
                                                        </td>
                                                    </tr>
                                                    <tr class=tr-body-parc>
                                                        <th class="font-narrow" scope="row">2 x</th>
                                                        <td class="font-narrow">
                                                            de
                                                            <span class="color-f27092 font-weight-1000 font-narrow">
                                                                <? echo 'R$' . $parcel_2['value_of_parcel'] ?>
                                                            </span>
                                                            sem juros
                                                        </td>
                                                        <td class="font-narrow">
                                                            <? echo 'R$' . $parcel_2['amount_payable'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr class=tr-body-parc>
                                                        <th class="font-narrow" scope="row">3 x</th>
                                                        <td class="font-narrow">
                                                            de
                                                            <span class="color-f27092 font-weight-1000 font-narrow">
                                                                <? echo 'R$' . $parcel_3['value_of_parcel'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="font-narrow">
                                                            <? echo 'R$' . $parcel_3['amount_payable'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr class=tr-body-parc>
                                                        <th class="font-narrow" scope="row">4 x</th>
                                                        <td class="font-narrow">
                                                            de
                                                            <span class="color-f27092 font-weight-1000 font-narrow">
                                                                <? echo 'R$' . $parcel_4['value_of_parcel'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="font-narrow">
                                                            <? echo 'R$' . $parcel_4['amount_payable'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr class=tr-body-parc>
                                                        <th class="font-narrow" scope="row">5 x</th>
                                                        <td class="font-narrow">
                                                            de
                                                            <span class="color-f27092 font-weight-1000 font-narrow">
                                                                <? echo 'R$' . $parcel_5['value_of_parcel'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="font-narrow">
                                                            <? echo 'R$' . $parcel_5['amount_payable'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr class=tr-body-parc>
                                                        <th class="font-narrow" scope="row">6 x</th>
                                                        <td class="font-narrow">
                                                            de
                                                            <span class="color-f27092 font-weight-1000 font-narrow">
                                                                <? echo 'R$' . $parcel_6['value_of_parcel'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="font-narrow">
                                                            <? echo 'R$' . $parcel_6['amount_payable'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr class=tr-body-parc>
                                                        <th class="font-narrow" scope="row">7 x</th>
                                                        <td class="font-narrow">
                                                            de
                                                            <span class="color-f27092 font-weight-1000 font-narrow">
                                                                <? echo 'R$' . $parcel_7['value_of_parcel'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="font-narrow">
                                                            <? echo 'R$' . $parcel_7['amount_payable'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr class=tr-body-parc>
                                                        <th class="font-narrow" scope="row">8 x</th>
                                                        <td class="font-narrow">
                                                            de
                                                            <span class="color-f27092 font-weight-1000 font-narrow">
                                                                <? echo 'R$' . $parcel_8['value_of_parcel'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="font-narrow">
                                                            <? echo 'R$' . $parcel_8['amount_payable'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr class=tr-body-parc>
                                                        <th class="font-narrow" scope="row">9 x</th>
                                                        <td class="font-narrow">
                                                            de
                                                            <span class="color-f27092 font-weight-1000 font-narrow">
                                                                <? echo 'R$' . $parcel_9['value_of_parcel'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="font-narrow">
                                                            <? echo 'R$' . $parcel_9['amount_payable'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr class=tr-body-parc>
                                                        <th class="font-narrow" scope="row">10 x</th>
                                                        <td class="font-narrow">
                                                            de
                                                            <span class="color-f27092 font-weight-1000 font-narrow">
                                                                <? echo 'R$' . $parcel_10['value_of_parcel'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="font-narrow">
                                                            <? echo 'R$' . $parcel_10['amount_payable'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr class=tr-body-parc>
                                                        <th class="font-narrow" scope="row">11 x</th>
                                                        <td class="font-narrow">
                                                            de
                                                            <span class="color-f27092 font-weight-1000 font-narrow">
                                                                <? echo 'R$' . $parcel_11['value_of_parcel'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="font-narrow">
                                                            <? echo 'R$' . $parcel_11['amount_payable'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr class=tr-body-parc>
                                                        <th class="font-narrow" scope="row">12 x</th>
                                                        <td class="font-narrow">
                                                            de
                                                            <span class="color-f27092 font-weight-1000 font-narrow">
                                                                <? echo 'R$' . $parcel_12['value_of_parcel'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="font-narrow">
                                                            <? echo 'R$' . $parcel_12['amount_payable'] ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row-gray">
                        </div>

                        <br>
                        <div id="smart-button-container">
                            <div style="text-align: center;">
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>
                        <br>
                        <div class="container-btn-buy">
                            <div class="btn-buy">
                                <button class="btn-buy" data-toggle="modal" data-target="#modalBuy" id="btn-buy">
                                    <p class="txt-buy font-size-22 color-white font-narrow">
                                        COMPRAR
                                    </p>
                                </button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade modal-fade-buy" id="modalBuy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-buy" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header modal-header-buy">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <p class="txt-card-credit font-size-24 font-narrow font-weight-1000">
                                                Carrinho de Compras
                                            </p>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!--  <form action="ajax-add-cart.php" method="post"> -->
                                        <div class="modal-body modal-body-buy">
                                            <div class="container-product-body">
                                                <span class="font-narrow padding-left-12 padding-top-6 padding-bottom-6">
                                                    PRODUTO
                                                </span>
                                                <span class="font-narrow padding-right-42 padding-bottom-6 padding-top-6">
                                                    SUBTOTAL
                                                </span>
                                            </div>
                                            <br>
                                            <div class="container-producs-body" id="container-producs-body">
                                                <div class="div-products-body-image-desc">
                                                    <div>
                                                        <?php echo '<img class="img-amount" src="data:image/jpeg;base64,' . base64_encode($product['image_01']) . '" />'; ?>
                                                    </div>
                                                    <div class="div-amount-desc">
                                                        <p class="span-product-img font-narrow padding-left-12">
                                                            <?= $product['name'] ?>
                                                            <span class="font-narrow font-size-12">
                                                                <?php echo 'R$' . $value_item ?>
                                                            </span>
                                                            <div class="container-quantity margin-top-6 margin-left-12">
                                                                <button class="btn-remove-item" onclick="subtract()">
                                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                                </button>
                                                                <input class="input-quanity" id="input-quantity-item" name="input-quantity-item" value="1">
                                                                <button class="btn-add-item" onclick="add()">
                                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="div-amount-delete">
                                                    <input class="font-narrow btn-not-border" id="input-value-item" value="<?php echo 'R$' . $value_item ?>">
                                                    <span class="padding-left-12">
                                                        <button type="button" class="btn-not-border" onclick="removeItemCart()">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row-gray">
                                            </div>
                                            <div class="container-subtotal-body">
                                                <p class="font-narrow padding-top-6 padding-bottom-6">
                                                    SUBTOTAL (Sem frete)
                                                </p>
                                                <input class="font-narrow padding-top-6 padding-bottom-6 font-weight-1000 font-size-24 btn-not-border" id="input-value-subtotal" value="<?php echo 'R$' . $value_item ?>">
                                            </div>
                                            <br>
                                            <div class="product-freight font-size-16">
                                                <i class="fa fa-truck" aria-hidden="true"></i>
                                                <span class="txt-freight color-black font-narrow">
                                                    <strong class="color-f27092">Frete grátis </strong> a partir de R$5.000,00
                                                </span>
                                            </div>
                                            <div class="product-zip-code">
                                                <input class="input-zip-code font-narrow padding-8" type="number" id="input-zip-code-modal" name="input-zip-code-modal" placeholder="Seu Cep">
                                                <button class="btn-calc-zip-code" id="btn-calc-freight-modal" type="button">
                                                    <p class="txt-calc-zip-code font-size-12 color-black font-narrow">
                                                        CALCULAR
                                                    </p>
                                                </button>
                                                <p>
                                                    <a target="_blank" class="txt-not-zip color-f27092 font-size-14 font-narrow" href="http://www.buscacep.correios.com.br/sistemas/buscacep/">
                                                        Não sei meu cep
                                                    </a>
                                                </p>
                                                <div class="div-amount-freight-modal" id="div-amount-freight-modal">
                                                    <p id="amount-freight-modal"></p>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="row-gray">
                                            </div>
                                            <br>
                                            <div class="container-subtotal-body">
                                                <p class="font-narrow padding-top-6 padding-bottom-6 font-size-24 color-f27092 font-weight-1000">
                                                    Total:
                                                </p>
                                                <div class="div-txt-total">
                                                    <input class="p-amount-total font-narrow padding-top-6 padding-bottom-6 font-size-24 color-f27092 font-weight-1000 btn-not-border" id="input-value-total" value="<?php echo 'R$' . $value_item ?>">
                                                    <div class="div-parc-value-total" id="div-parc-value-total">
                                                        <p class="font-size-12 font-narrow">
                                                            Ou até 2x de
                                                        </p>
                                                        <input class="font-narrow font-size-12 color-f27092 btn-not-border" id="input-value-parc" value="<?php echo 'R$' . $parcel_2['value_of_parcel'] ?>">

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer modal-footer-buy">
                                            <button type="submit" id="btn-add-item-cart" class="close" data-dismiss="modal" aria-label="Fechar"> 
                                                <!-- <button type="submit" id="btn-add-item-cart"> -->
                                                    <span class="txt-add-cart font-narrow font-size-14 color-f94372"> ADICIONAR AO CARRINHO <span>
                                                </button>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                    <span class="txt-see-products font-narrow font-size-14 color-f27092"> VER MAIS PRODUTOS <span>
                                                </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input id="input-session-id" name="input-session-id" type="hidden" value="<?= $id ?>">
                        <input id="input-product-id" name="input-product-id" type="hidden" value="<?= $cod ?>">
                        <!-- </form> -->
                        <br>
                        <div class="product-freight font-size-16">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                            <span class="txt-freight color-black font-narrow">
                                <strong class="color-f27092">Frete grátis </strong> a partir de R$5.000,00
                            </span>
                        </div>
                        <div class="product-zip-code">
                            <input class="input-zip-code font-narrow padding-8" type="number" id="input-zip-code" name="input-zip-code" placeholder="Seu Cep">
                            <button class="btn-calc-zip-code" id="btn-calc-freight" type="button">
                                <p class="txt-calc-zip-code font-size-12 color-black font-narrow">
                                    CALCULAR
                                </p>
                            </button>
                            <p>
                                <a target="_blank" class="txt-not-zip color-f27092 font-size-14 font-narrow" href="http://www.buscacep.correios.com.br/sistemas/buscacep/">
                                    Não sei meu cep
                                </a>
                            </p>
                        </div>
                        <div class="div-amount-freight" id="div-amount-freight">
                            <p id="amount-freight"></p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
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
<script>
    const amountItem = document.getElementById("input-value-item").value;
    const amountItemReplaced = replaceNumber(amountItem);

    function replaceNumber(amountReplace) {
        amountReplace = amountReplace.replace(",", ".").replace("R$", "");
        return amountReplace
    }

    function replaceNumberFull(amountReplace) {
        amountReplace = amountReplace.replace(".", "");
        amountReplace = replaceNumber(amountReplace);
        return amountReplace
    }

    function replaceNumberComma(amountReplace) {
        amountReplace = amountReplace.replace(".", "");
        amountReplace = replaceNumber(amountReplace);
        return amountReplace
    }


    /******************************************************************************/
    /********************************* add item ***********************************/
    /******************************************************************************/
    function add() {
        let zipCode = document.getElementById("input-zip-code-modal").value;
        let value = document.getElementById("input-quantity-item").value;
        value = Number(value);
        value++;
        document.getElementById("input-quantity-item").value = value;
        amountSubTotal = amountItemReplaced * value;
        amountParc = amountSubTotal / 2;

        amountSubTotal = amountSubTotal.toLocaleString('pt-br', {
            style: 'currency',
            currency: 'BRL'
        });

        amountParc = amountParc.toLocaleString('pt-br', {
            style: 'currency',
            currency: 'BRL'
        });

        if (zipCode !== "") {
            let amountFreight = document.getElementById("amount-freight").value;
            amountFreight = replaceNumber(amountFreight);
            if (amountFreight == "") {
                amountFreight = 0;
            }
        } else {
            document.getElementById("input-value-total").value = amountSubTotal;
            document.getElementById("input-value-parc").value = amountParc;

        }

        if (amountSubTotal.length > 10) {
            amountSubTotal = replaceNumberComma(amountSubTotal);
        } else {
            amountSubTotal = replaceNumber(amountSubTotal);
        }

        amountSubTotal = parseFloat(amountSubTotal).toLocaleString('pt-br', {
            style: 'currency',
            currency: 'BRL'
        });

        document.getElementById("input-value-item").value = amountSubTotal;
        document.getElementById("input-value-subtotal").value = amountSubTotal;
        document.getElementById("btn-calc-freight-modal").click();
    }

    /******************************************************************************/
    /******************************* subtract item ********************************/
    /******************************************************************************/
    function subtract() {
        let zipCode = document.getElementById("input-zip-code-modal").value;
        let value = document.getElementById("input-quantity-item").value;
        value = Number(value);
        value--;
        value = Math.max(value, 1);
        document.getElementById("input-quantity-item").value = value;

        let amount = document.getElementById("input-value-item").value;
        let amountReplaced = replaceNumberFull(amount);

        amountSubTotal = amountReplaced - amountItemReplaced;

        amountSubTotal = Math.max(amountSubTotal, amountItemReplaced);
        amountParc = amountSubTotal / 2;
        amountSubTotal = amountSubTotal.toLocaleString('pt-br', {
            style: 'currency',
            currency: 'BRL'
        });
        amountParc = amountParc.toLocaleString('pt-br', {
            style: 'currency',
            currency: 'BRL'
        });

        if (zipCode !== "") {
            let amountFreight = document.getElementById("amount-freight").value;
            amountFreight = replaceNumber(amountFreight);
            if (amountFreight == "") {
                amountFreight = 0;
            }
        } else {
            document.getElementById("input-value-total").value = amountSubTotal;
            document.getElementById("input-value-parc").value = amountParc;
        }

        if (amountSubTotal.length > 10) {
            amountSubTotal = replaceNumberComma(amountSubTotal);
        } else {
            amountSubTotal = replaceNumber(amountSubTotal);
        }

        amountSubTotal = parseFloat(amountSubTotal).toLocaleString('pt-br', {
            style: 'currency',
            currency: 'BRL'
        });

        document.getElementById("input-value-item").value = amountSubTotal;
        document.getElementById("input-value-subtotal").value = amountSubTotal;
        document.getElementById("btn-calc-freight-modal").click();

    }

    /******************************************************************************/
    /******************************** remove cart *********************************/
    /******************************************************************************/
    function removeItemCart() {
        document.getElementById("container-producs-body").innerHTML = '<p class="font-narrow font-size-14 color-d2d2d2"> Seu carrinho está vazio </p>';
        document.getElementById("input-value-subtotal").value = "0,00";
        document.getElementById("input-value-total").value = "0,00";
        document.getElementById("div-parc-value-total").innerHTML = " ";

    }


    /******************************************************************************/
    /******************************* verify session *******************************/
    /******************************************************************************/
    const btnBuy = document.getElementById("btn-buy");
    const inputIdSession = document.getElementById("input-session-id").value;
    btnBuy.addEventListener("click", async () => {
        if (inputIdSession == "") {
            alert("Voce precisa fazer login");
            document.getElementById("modalBuy").innerHTML = " ";
            window.location.href = 'account/login.php';
        }
    });

    /******************************************************************************/
    /******************************* api zip code *********************************/
    /******************************************************************************/
    let inputZipCode = document.getElementById("input-zip-code").value;
    const btnCalcFreight = document.getElementById("btn-calc-freight");
    btnCalcFreight.addEventListener("click", async () => {
        inputZipCode = document.getElementById("input-zip-code").value;
        const req = await fetch("api-freight.php", { // COM POST + FORM
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            method: "POST",
            body: "inputZipCode=" + inputZipCode
        });

        const res = await req.json();
        let amountFreight = res.value_freight;
        let deadline = res.deadline;
        let divAmountZipCode = document.getElementById("div-amount-freight");
        divAmountZipCode.innerHTML = '<p class="font-narrow font-size-14" id="amount-freight-modal"> SEDEX R$' + amountFreight + '</p><p class="font-narrow font-size-14" id="deadline"> Prazo de entrega: ' + deadline + ' dias<p>';

    });

    /******************************************************************************/
    /******************************* api zip code *********************************/
    /******************************************************************************/
    let inputZipCodeModal = document.getElementById("input-zip-code-modal").value;
    const btnCalcFreightModal = document.getElementById("btn-calc-freight-modal");
    btnCalcFreightModal.addEventListener("click", async () => {
        inputZipCodeModal = document.getElementById("input-zip-code-modal").value;
        const req = await fetch("api-freight.php", { // COM POST + FORM
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            method: "POST",
            body: "inputZipCode=" + inputZipCodeModal
        });

        const res = await req.json();
        let amountFreight = res.value_freight;
        let deadline = res.deadline;
        let divAmountZipCode = document.getElementById("div-amount-freight-modal");
        divAmountZipCode.innerHTML = '<p><input type="text" class="font-narrow font-size-14 input-not-border" id="amount-freight" name="amount-freight" value="SEDEX R$' + amountFreight + '">' + '</p><p class="font-narrow font-size-14"> Prazo de entrega: ' + deadline + ' dias<p>';

        let quantity = document.getElementById("input-quantity-item").value;
        let amountSubTotalCalc = amountItemReplaced * quantity;

        amountFreight = replaceNumber(amountFreight);
        let amount = parseFloat(amountSubTotalCalc) + parseFloat(amountFreight);
        amountParc = amount / 2;
        amount = parseFloat(amount).toLocaleString('pt-br', {
            style: 'currency',
            currency: 'BRL'
        });

        amountParc = parseFloat(amountParc).toLocaleString('pt-br', {
            style: 'currency',
            currency: 'BRL'
        });

        document.getElementById("input-value-total").value = amount;
        document.getElementById("input-value-parc").value = amountParc;

    });

    /******************************************************************************/
    /************************** add item in shopping cart *************************/
    /******************************************************************************/
    
    const btnAddCart = document.getElementById("btn-add-item-cart");
    btnAddCart.addEventListener("click", async () => {
        let valueFreight = document.getElementById("amount-freight").value;
        let codProduct = document.getElementById("input-product-id").value;
        let sessionId = document.getElementById("input-session-id").value;
        let quantity = document.getElementById("input-quantity-item").value;

        const req = await fetch("ajax-add-cart.php", { // COM POST + FORM
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            method: "POST",
            body: "valueFreight=" + valueFreight + "&cod=" + codProduct + "&sessionId=" + sessionId + "&quantity=" + quantity
        });

        const res = await req.json();
       
    });


</script>