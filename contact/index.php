<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loja Virtual</title>
    <link rel="stylesheet" type="text/css" href="../css/universal.css">
    <link rel="stylesheet" type="text/css" href="../css/top.css">
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="../account/css/register.css">

    <!-- imports -->
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Open+Sans+Condensed:wght@300&family=PT+Sans+Narrow&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/3ebafaacf8.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<?php
//db
require_once("../db/db.php");
$time = 2 * 60 * 60; // 
session_set_cookie_params($time);
session_start();

$query = ("SELECT * FROM products");
$results = mysqli_query($conn, $query);
$count = $results->num_rows;

if ($count > 16) {
    $count = 16;
}

try {
    $id = $_SESSION['id'];
    if ($id !== NULL) {
        $query1 = ("SELECT * FROM `user` WHERE `id` = $id");
        $result1 = mysqli_query($conn, $query1);
        $userCredential = mysqli_fetch_assoc($result1);

        $_SESSION["id"] = $userCredential['id'];
        $_SESSION["name"] = $userCredential['name'];
        $_SESSION["email"] = $userCredential['email'];
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
                    <img src="../img/logo.png" id="img-logo-width">
                </div>
                <div class="container-register" id="container-register">
                    <div class="register-child-4">
                        <a class="link-my-account color-f27092" href="../account/my_account.php">
                            <div class="register-child-4-icon padding-right-6">
                                <i class="fa fa-user-circle-o icon-user-name font-size-14" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="txt-user-name font-size-16 font-narrow">
                                    Olá,
                                    <?php
                                    if ($id == NULL) { ?>
                                        <script>
                                            document.getElementById("container-register").innerHTML = '<div class="register-child-1" id="register-child-1"><a href="../account/register.php" class="font-condensed color-black">CADASTRE-SE</a></div><span>|</span><div class="register-child-2"><a href="../account/login.php" class="font-condensed color-black"> INICIAR SESSÃO</a></div><div class="register-child-3"><i class="fa fa-cart-arrow-down font-size-24" aria-hidden="true"></i><div class="number-items-layout"><p class="color-white font-size-12 padding-left-6">0</p></div></div><div class="register-child-3"><div class=""><p class="color-black font-size-12 padding-left-6"></p></div></div>';
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
                        <form method="POST" action="../account/ajax-signout.php">
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
                    <a href="../index.php" class="font-narrow color-f27092 color-hover">INÍCIO</a>
                </div>
                <div class="top-3-child-2 margin-right-18">
                    <a href="../products.php" class="font-narrow color-black color-hover">PRODUTOS</a>
                </div>
                <div class="top-3-child-3">
                    <a href="index.php" class="font-narrow color-black color-hover">CONTATO</a>
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
            <div class="container-contact">
                <div class="body-2">
                    <div class="container-contact-info">
                        <p class="font-narrow font-size-16 padding-12">
                            Vendas com prazo de postagem de 20 a 30 dias úteis após a confirmação do pagamento.
                        </p>
                    </div>
                    <div class="footer-contact-tel padding-left-18">
                        <i class="fa fa-whatsapp color-black" aria-hidden="true"></i>
                        <span class="color-black font-size-14 font-narrow">
                            (11) 9999-9999
                        </span>
                    </div>
                    <div class="footer-contact-email padding-left-18">
                        <i class="fa fa-envelope-o color-black" aria-hidden="true"></i>
                        <span class="color-black font-size-14 font-narrow">
                            contato@emmail.com
                        </span>
                    </div>
                </div>

                <div class="container-form-contact">
                    <div class="container-form-1">
                        <form action="ajax-send-message.php" method="POST">
                            <div class="padding-12">
                                <label class="font-narrow">NOME COMPLETO</label><br>
                                <input class="font-narrow" type="text" name="txt-name" id="txt-name" placeholder="ex.: Maria Silva">
                            </div>
                            <div class="padding-12">
                                <label class="font-narrow">E-MAIL</label><br>
                                <input class="font-narrow" type="text" name="txt-email" id="txt-email" placeholder="ex.: mariasilva@example.com">

                            </div>
                            <div class="padding-12">
                                <label class="font-narrow">TELEFONE (opcional)</label><br>
                                <input class="font-narrow" type="text" name="txt-tel" id="txt-tel">

                            </div>
                            <div class="padding-12">
                                <label class="font-narrow">MENSAGEM (opcional)</label><br>
                                <input class="font-narrow" type="text" name="txt-message" id="txt-message">
                            </div>
                            <div class="container-btn-send padding-12">
                                <div class="btn-send">
                                    <button type="button" class="btn-send btn-not-border" id="btn-send">
                                        <p class="txt-send font-size-16 color-white font-narrow">
                                            ENVIAR
                                        </p>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
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
                        <a href="../index.php" class="txt-footer-home font-condensed font-size-16 color-white">
                            INÍCIO
                        </a>
                    </div>
                    <div class="footer-navigation-products">
                        <a href="../products.php" class="txt-footer-product font-condensed font-size-16 color-white">
                            PRODUTOS
                        </a>
                    </div>
                    <div class="footer-navigation-contact">
                        <a href="index.php" class="txt-footer-contact font-condensed font-size-16 color-white">
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
                            <img src="../img/payment/visa.png" class="img-footer-payment">

                        </div>
                        <div class="footer-payment-item">
                            <img src="../img/payment/master.jpg" class="img-footer-payment">
                        </div>
                        <div class="footer-payment-item">
                            <img src="../img/payment/mercado-pago.png" class="img-footer-payment">
                        </div>
                    </div>

                    <label class="color-white font-size-16 font-narrow" id="txt-post">
                        FORMAS DE ENVIO
                    </label>
                    <div class="footer-post">
                        <div class="footer-post-item">
                            <img src="../img/post/correios.jpg" class="img-footer-post">
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
    const btnSend = document.getElementById("btn-send");
    btnSend.addEventListener("click", async () => {
        let name = document.getElementById("txt-name").value;
        let email = document.getElementById("txt-email").value;
        let telephone = document.getElementById("txt-tel").value;
        let message = document.getElementById("txt-message").value;

        const req = await fetch("ajax-send-message.php", {
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            method: "POST",
            body: "name=" + name + "&email=" + email + "&tel=" + telephone + "&message=" + message
        });

        const res = await req.json();
        alert("Mensagem enviada, aguarde o contato de um de nossos atendentes!");
        window.location.href = '../index.php';
    });
    
</script>