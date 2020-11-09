<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar Minha Conta</title>
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
        <div class="container-body">
            <div class="body-1">
                <p class="txt-body-1-info color-black font-size-11 font-balsamiq">
                    Compre mais rápido e acompanhe seus pedidos em um só lugar!
                </p>
            </div>
            <div class="container-form">
                <div class="container-form-1">
                    <form action="ajax-register.php" method="POST">
                        <div class="padding-12">
                            <label class="font-narrow">NOME COMPLETO</label>
                            <div>
                                <span id="messageErrorName" style="color: red; font-size: 11px"></span>
                            </div>
                            <input class="font-narrow" type="text" name="txt-name" id="txt-name" placeholder="ex.: Maria Silva" required>
                        </div>
                        <div class="padding-12">
                            <label class="font-narrow">E-MAIL</label>
                            <div>
                                <span id="messageErrorEmail" style="color: red; font-size: 11px"></span>
                            </div>
                            <input class="font-narrow" type="text" name="txt-email" id="txt-email" placeholder="ex.: mariasilva@example.com" required>
                        </div>
                        <div class="padding-12">
                            <label class="font-narrow">TELEFONE</label>
                            <div>
                                <span id="messageErrorPhone" style="color: red; font-size: 11px"></span>
                            </div>
                            <input class="font-narrow" type="number" name="txt-tel" id="txt-tel" placeholder="ex.: 11999999999" required>
                        </div>
                        <div class="padding-12">
                            <label class="font-narrow">CPF (Somente números)</label>
                            <div>
                                <span id="messageErrorCpf" style="color: red; font-size: 11px"></span>
                            </div>
                            <input class="font-narrow" type="number" name="txt-cpf" id="txt-cpf" placeholder="ex.: 00000000000" required>
                        </div>
                        <div class="padding-12">
                            <label class="font-narrow">SENHA</label>
                            <div>
                                <span id="messageErrorPassword" style="color: red; font-size: 11px"></span>
                            </div>
                            <input class="font-narrow" type="password" name="txt-password" id="txt-password" required>
                        </div>
                        <div class="padding-12">
                            <label class="font-narrow">CONFIRMAR SENHA</label>
                            <div>
                                <span id="messageErrorConfirmPassword" style="color: red; font-size: 11px"></span>
                            </div>
                            <input class="font-narrow" type="password" name="txt-confirm-password" id="txt-confirm-password" required>
                        </div>
                        <br>
                        <div class="container-btn-view-all">
                            <div class="btn-view-all">
                                <button type="button" class="btn-cad-user" id="btn-ajax-register">
                                    <p class="txt-view-all font-size-16 color-white font-narrow">
                                        CADASTRE-SE
                                    </p>
                                </button>
                            </div>
                        </div>
                        <br>
                        <div class="container-account-exist">
                            <p class="txt-account-exist font-balsamiq font-size-11 color-black">
                                Já possui uma conta?
                                <a class="txt-init-session color-black font-size-12" href="login.php">
                                    <strong>Iniciar Sessão</strong>
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <br>
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
    function isEmail(email) {
        var resp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return resp.test(String(email).toLowerCase());
    }

    const button = document.getElementById("btn-ajax-register");
    button.addEventListener("click", async () => {
        const name = document.getElementById("txt-name").value;
        const email = document.getElementById("txt-email").value;
        const cpf = document.getElementById("txt-cpf").value;
        const telephone = document.getElementById("txt-tel").value;
        const password = document.getElementById("txt-password").value;
        const confirmPassword = document.getElementById("txt-confirm-password").value;

        let bool = true;

        if (bool) {
            if (name.length < 5) {
                document.getElementById("messageErrorName").innerHTML = '* Por favor digite seu nome completo.';
            } else {
                document.getElementById("messageErrorName").innerHTML = '';
            }
            if (email == '') {
                if (!isEmail(email)) {
                    document.getElementById("messageErrorEmail").innerHTML = '* Por favor digite um e-mail válido.';
                }
            } else {
                document.getElementById("messageErrorEmail").innerHTML = '';
            }
            if ((cpf < 11) || (cpf > 11)) {
                document.getElementById("messageErrorCpf").innerHTML = '* Por favor digite um cpf válido.';
            } else {
                document.getElementById("messageErrorCpf").innerHTML = '';
            }
            if (cpf == '') {
                document.getElementById("messageErrorCpf").innerHTML = '* Cpf é obrigatório.';
            } else {
                document.getElementById("messageErrorCpf").innerHTML = '';
            }

            if (password.length < 8) {
                document.getElementById("messageErrorPassword").innerHTML = '* Tamanho mínimo: 8 caracteres.';
            } else {
                document.getElementById("messageErrorPassword").innerHTML = '';
            }
            if (confirmPassword != password) {
                document.getElementById("messageErrorConfirmPassword").innerHTML = '* As senhas não conferem.';
            } else {
                document.getElementById("messageErrorConfirmPassword").innerHTML = '';
            }
            bool = false;
            if (!bool) {
                const req = await fetch("ajax-register.php", {
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    method: "POST",
                    body: "name=" + name + "&email=" + email + "&cpf=" + cpf + "&tel=" + telephone + "&password=" + password
                });

                const res = await req.json();
                alert(res.id);
               
            }
        }
    });
</script>