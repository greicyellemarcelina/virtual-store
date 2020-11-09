<?php
session_start();
require_once("../db/db.php");

$id = $_SESSION['id'];

#######################################################

$query = ("SELECT * FROM `user` WHERE `id` = $id");
$result = mysqli_query($conn, $query);
$userInfo = mysqli_fetch_assoc($result);

#######################################################
#######################################################

$street = "";
$number = "";
$district = "";
$city = "";
$state = "";
$zip_code = "";

$query2 = ("SELECT * FROM `user_address` WHERE `user_id_pk` = $id");
$result2 = mysqli_query($conn, $query2);
$userInfoAddress = mysqli_fetch_assoc($result2);

if ($userInfoAddress) {
    $street = $userInfoAddress['street'];
    $number = $userInfoAddress['number'];
    $district = $userInfoAddress['district'];
    $city = $userInfoAddress['city'];
    $state = $userInfoAddress['state'];
    $zip_code = $userInfoAddress['zip_code'];
}

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
    <link rel="stylesheet" type="text/css" href="css/profile.css">
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
                            <a class="link-my-account color-f27092" href="my_account.php">
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
            <div class="container-form">
                <div class="container-form-1">
                    <form action="#" method="POST">
                        <div class="form-row">
                            <div class="col padding-12">
                                <label class="font-narrow">NOME COMPLETO</label>
                                <div>
                                    <span id="messageErrorName" style="color: red; font-size: 11px"></span>
                                </div>
                                <input class="font-narrow" type="text" name="txt-name-profile" id="txt-name-profile" value="<?= $userInfo['name'] ?>" placeholder="ex.: Maria Silva">
                            </div>
                            <div class="col padding-12">
                                <label class="font-narrow">CPF</label>
                                <div>
                                    <span id="messageErrorCpf" style="color: red; font-size: 11px"></span>
                                </div>
                                <input class="font-narrow" type="text" name="txt-cpf-profile" id="txt-cpf-profile" value="<?= $userInfo['cpf'] ?>" placeholder="ex.: 00000000000">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col padding-12">
                                <label class="font-narrow">E-MAIL</label>
                                <div>
                                    <span id="messageErrorEmail" style="color: red; font-size: 11px"></span>
                                </div>
                                <input class="font-narrow" type="text" name="txt-email-profile" id="txt-email-profile" value="<?= $userInfo['email'] ?>" placeholder="ex.: mariasilva@example.com">
                            </div>
                            <div class="col padding-12">
                                <label class="font-narrow">TELEFONE</label>
                                <div>
                                    <span id="messageErrorTelephone" style="color: red; font-size: 11px"></span>
                                </div>
                                <input class="font-narrow" type="text" name="txt-tel-profile" id="txt-tel-profile" value="<?= $userInfo['telephone'] ?>" placeholder="ex.: 1199999-9999">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col padding-12">
                                <label class="font-narrow">CEP</label>
                                <div>
                                    <span id="messageErrorZipCode" style="color: red; font-size: 11px"></span>
                                </div>
                                <input class="font-narrow" type="text" name="txt-zip-code-profile" id="txt-zip-code-profile" value="<?= $zip_code ?>" placeholder="ex.: 00000000">
                            </div>
                            <div class="col padding-12">
                                <label class="font-narrow">RUA</label>
                                <div>
                                    <span id="messageErrorStreet" style="color: red; font-size: 11px"></span>
                                </div>
                                <input class="font-narrow" type="text" name="txt-street-profile" id="txt-street-profile" value="<?= $street ?>" placeholder="ex.: Rua das Flores">
                            </div>
                            <div class="col padding-12">
                                <label class="font-narrow">Número</label>
                                <div>
                                    <span id="messageErrorNumber" style="color: red; font-size: 11px"></span>
                                </div>
                                <input class="font-narrow" type="text" name="txt-number-profile" id="txt-number-profile" value="<?= $number ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col padding-12">
                                <label class="font-narrow">Bairro</label>
                                <div>
                                    <span id="messageErrorDistrict" style="color: red; font-size: 11px"></span>
                                </div>
                                <input class="font-narrow" type="text" name="txt-district-profile" id="txt-district-profile" value="<?= $district ?>" placeholder="ex.: Centro">
                            </div>
                            <div class="col padding-12">
                                <label class="font-narrow">Cidade</label>
                                <div>
                                    <span id="messageErrorCity" style="color: red; font-size: 11px"></span>
                                </div>
                                <input class="font-narrow" type="text" name="txt-city-profile" id="txt-city-profile" value="<?= $city ?>" placeholder="ex.: São Paulo">
                            </div>
                            <div class="col padding-12">
                                <label class="font-narrow">Estado</label>
                                <div>
                                    <span id="messageErrorState" style="color: red; font-size: 11px"></span>
                                </div>
                                <input class="font-narrow" type="text" name="txt-state-profile" id="txt-state-profile" value="<?= $state ?>" placeholder="ex.: SP">
                            </div>
                        </div>
                        <input type="hidden" name="txt-id" id="txt-id" value="<?= $id ?>">
                        <br>
                        <div class="container-btn">
                            <a href="my_account.php" class="link-return color-f27092 font-narrow">
                                <i class="fa fa-chevron-left"></i>
                                Voltar
                            </a>
                            <button type="button" id="btn-ajax-save" class="btn-save color-f27092 font-narrow">
                                <i class="fa fa-check-circle"></i>
                                Salvar
                            </button>
                        </div>
                    </form>
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
        window.location.href = 'login.php';

    });

    const button2 = document.getElementById("btn-ajax-save");
    button2.addEventListener("click", async () => {
        const id = document.getElementById('txt-id').value;
        const name = document.getElementById('txt-name-profile').value;
        const email = document.getElementById('txt-email-profile').value;
        const telephone = document.getElementById('txt-tel-profile').value;
        const zipCode = document.getElementById('txt-zip-code-profile').value;
        const street = document.getElementById('txt-street-profile').value;
        const number = document.getElementById('txt-number-profile').value;
        const district = document.getElementById('txt-district-profile').value;
        const city = document.getElementById('txt-city-profile').value;
        const state = document.getElementById('txt-state-profile').value;

        const req = await fetch("ajax-save-user.php", { // COM POST + FORM
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            method: "POST",
            body: "id=" + id + "&name=" + name + "&email=" + email + "&telephone=" + telephone + "&zipcode=" + zipCode + "&street=" +
                street + "&number=" + number + "&district=" + district + "&city=" + city + "&state=" + state
        });

        const res = await req.json();
        alert('Salvo com sucesso!')
    });
</script>