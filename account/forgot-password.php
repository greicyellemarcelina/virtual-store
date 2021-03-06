<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
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
<?php
//db
require_once("../db/db.php");
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
                <div class="container-register">
                    <div class="register-child-1">
                        <a href="register.php" class="font-condensed color-black">CADASTRE-SE</a>
                    </div>
                    <span>|</span>
                    <div class="register-child-2">
                        <a href="login.php" class="font-condensed color-black"> INICIAR SESSÃO</a>
                    </div>
                    <div class="register-child-3">
                        <i class="fa fa-cart-arrow-down font-size-32" aria-hidden="true"></i>
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
                    <a href="../contact/index.php" class="font-narrow color-black color-hover">CONTATO</a>
                </div>
            </div>
        </div>
        <div class="container-body-login">
            <div class="body-1">
                <p class="txt-body-1-info color-black font-size-11 font-balsamiq">
                    Compre mais rápido e acompanhe seus pedidos em um só lugar!
                </p>
            </div>
            <div class="container-form">
                <div class="container-form-1">
                    <form action="ajax-forgot-password.php" method="POST">
                        <div class="padding-12">
                            <label class="font-narrow">E-MAIL CADASTRADO</label><br>
                            <input class="font-narrow" type="text" name="txt-email" id="txt-email" placeholder="ex.: mariasilva@example.com">

                        </div>
                        <div class="div-account-not-exists" id="div-account-not-exists">
                        </div>
                        <div class="container-btn-login padding-12">
                            <div class="btn-login">
                                <button type="button" class="btn-login" id="btn-forgot-password">
                                    <p class="txt-login font-size-16 color-white font-narrow">
                                        RECUPERAR SENHA
                                    </p>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-register-login">
            <p class="font-size-12 font-balsamiq">
                Não possui uma conta? <a class="txt-not-account color-black" href="register.php"><strong>Cadastre-se</strong></a>
            </p>
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
                        <a href="../contact/index.php" class="txt-footer-contact font-condensed font-size-16 color-white">
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
    const button = document.getElementById("btn-forgot-password");
    button.addEventListener("click", async () => {
        const email = document.getElementById("txt-email").value;
        const req = await fetch("ajax-forgot-password.php", {
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            method: "POST",
            body: "email=" + email
        });

        const res = await req.json();
        if (res.id == 'id_not_found') {
            document.getElementById("div-account-not-exists").innerHTML = '<p class="txt-account-not-exists padding-left-12 font-balsamiq font-size-11 color-red">Conta não existe.</p>';
        } else {
            document.getElementById("div-account-not-exists").innerHTML = '<p class="txt-account-not-exists padding-left-12 font-balsamiq font-size-11 color-green">A nova senha foi enviada para o e-mail cadastrado.</p>';
        }

    });
</script>