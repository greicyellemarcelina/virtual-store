<?php
session_start();
require_once("../db/db.php");

$email = '';
$password = '';

$email = $_POST['txt-email'];
$password = MD5($_POST['txt-password']);

$query = ("SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$password'");
$result = mysqli_query($conn, $query);
$userCredential = mysqli_fetch_assoc($result);

if (!$userCredential) {
?>
    <script>
        window.location.href = "login.php";
        alert('Você precisa fazer login');
    </script>
<?php
    session_destroy();
} else {
    $_SESSION["id"] = $userCredential['id'];
    $_SESSION["name"] = $userCredential['name'];
    $_SESSION["email"] = $userCredential['email'];
}

$id = $_SESSION['id'];

#######################################################

$query = ("SELECT * FROM `user` WHERE `id` = $id");
$result = mysqli_query($conn, $query);
$userInfo = mysqli_fetch_assoc($result);

#######################################################

?>
<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loja Virtual</title>
    <link rel="stylesheet" type="text/css" href="../css/universal.css">
    <link rel="stylesheet" type="text/css" href="../css/top.css">
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/register.css">

    <!-- imports -->
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Open+Sans+Condensed:wght@300&family=PT+Sans+Narrow&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/3ebafaacf8.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">




</head>
<html>

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
                    <img src="../img/logo.png" id="img-logo-width">
                </div>
                <div class="container-register">
                    <div class="padding-right-32">
                        <div class="register-child-4">
                            <a class="link-my-account color-f27092" href="my-account.php">
                                <div class="register-child-4-icon padding-right-6">
                                    <i class="fa fa-user-circle-o icon-user-name font-size-14" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <p class="txt-user-name font-size-16 font-narrow">
                                        Olá, <?= $userInfo['name']; ?>
                                    </p>
                                </div>
                            </a>
                            <div class="padding-left-4 padding-right-4 color-d2d2d2">
                                |
                            </div>
                            <form method="POST" action="ajax-signout.php">
                                <div class="padding-left-4 padding-top-2 font-size-14 font-narrow">
                                    <button type="submit" class="link-signout color-black" id="btn-ajax-signout">
                                        Sair
                                    </button>
                                </div>
                            </form>
                        </div>
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
                    <a href="../index.php" class="font-narrow color-f27092 color-hover">INÍCIO</a>
                </div>
                <div class="top-3-child-2 margin-right-18">
                    <a href="../products.php" class="font-narrow color-black color-hover">PRODUTOS</a>
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
                <div class="product-item">
                    <div class="product-item-img">
                        <img src="../img/item1.png" id="product-item-img">
                    </div>
                    <div class="product-item-desc">
                        <p class="txt-product-item font-size-12 font-narrow color-black">
                            CONJUNTO CORAÇÃO
                        </p>
                    </div>
                    <div class="product-item-price">
                        <p class="txt-product-price font-size-16 font-narrow color-black">
                            R$ 60,00
                        </p>
                    </div>
                    <div class="product-item-parc">
                        <p class="txt-product-parc font-size-14 font-narrow color-rosybrown">
                            <strong>2</strong>x de <strong>R$27,50</strong> sem juros
                        </p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-item-img">
                        <img src="../img/item1.png" id="product-item-img">
                    </div>
                    <div class="product-item-desc">
                        <p class="txt-product-item font-size-12 font-narrow color-black">
                            CONJUNTO CORAÇÃO
                        </p>
                    </div>
                    <div class="product-item-price">
                        <p class="txt-product-price font-size-16 font-narrow color-black">
                            R$ 60,00
                        </p>
                    </div>
                    <div class="product-item-parc">
                        <p class="txt-product-parc font-size-14 font-narrow color-rosybrown">
                            <strong>2</strong>x de <strong>R$27,50</strong> sem juros
                        </p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-item-img">
                        <img src="../img/item1.png" id="product-item-img">
                    </div>
                    <div class="product-item-desc">
                        <p class="txt-product-item font-size-12 font-narrow color-black">
                            CONJUNTO CORAÇÃO
                        </p>
                    </div>
                    <div class="product-item-price">
                        <p class="txt-product-price font-size-16 font-narrow color-black">
                            R$ 60,00
                        </p>
                    </div>
                    <div class="product-item-parc">
                        <p class="txt-product-parc font-size-14 font-narrow color-rosybrown">
                            <strong>2</strong>x de <strong>R$27,50</strong> sem juros
                        </p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-item-img">
                        <img src="../img/item1.png" id="product-item-img">
                    </div>
                    <div class="product-item-desc">
                        <p class="txt-product-item font-size-12 font-narrow color-black">
                            CONJUNTO CORAÇÃO
                        </p>
                    </div>
                    <div class="product-item-price">
                        <p class="txt-product-price font-size-16 font-narrow color-black">
                            R$ 60,00
                        </p>
                    </div>
                    <div class="product-item-parc">
                        <p class="txt-product-parc font-size-14 font-narrow color-rosybrown">
                            <strong>2</strong>x de <strong>R$27,50</strong> sem juros
                        </p>
                    </div>
                </div>
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
                            <img src="../../img/payment/visa.png" class="img-footer-payment">

                        </div>
                        <div class="footer-payment-item">
                            <img src="../../img/payment/master.jpg" class="img-footer-payment">
                        </div>
                        <div class="footer-payment-item">
                            <img src="../../img/payment/mercado-pago.png" class="img-footer-payment">
                        </div>
                    </div>

                    <label class="color-white font-size-16 font-narrow" id="txt-post">
                        FORMAS DE ENVIO
                    </label>
                    <div class="footer-post">
                        <div class="footer-post-item">
                            <img src="../../img/post/correios.jpg" class="img-footer-post">
                        </div>
                        <div class="footer-post-item">
                            <img src="../img/post/sedex.png" class="img-footer-post">

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
    /*
    const button = document.getElementById("btn-ajax-signout");

    button.addEventListener("click", async () => {
            const req = await fetch("ajax-signout.php", { // COM POST + FORM
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            method: "POST",
            body: ""
        });

        const res = await req.json();
alert(button);
        //window.location.href = 'login.php';
    
    });
    */
</script>