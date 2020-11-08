<?php

//$cod_servico = $_GET['servico'];
$cod_servico = '41106';
$cep_origem = $_POST['inputZipCode'];
$cep_destino = '01934000';
$peso = '50';
$altura = '15';
$largura = '22';
$comprimento = '32';
$valor_declarado = '0';

if (!function_exists('calculaFrete')) {
    function calculaFrete(
        $cod_servico,
        $cep_origem,
        $cep_destino,
        $peso,
        $altura,
        $largura,
        $comprimento,
        $valor_declarado = '0'
    ) {

        $cod_servico = strtoupper($cod_servico);
        if ($cod_servico == 'SEDEX10') $cod_servico = 40215;
        if ($cod_servico == 'SEDEXACOBRAR') $cod_servico = 40045;
        if ($cod_servico == 'SEDEX') $cod_servico = 40010;
        if ($cod_servico == 'PAC') $cod_servico = 41106;

        # ###########################################
        # Código dos Principais Serviços dos Correios
        # 41106 PAC sem contrato
        # 40010 SEDEX sem contrato
        # 40045 SEDEX a Cobrar, sem contrato
        # 40215 SEDEX 10, sem contrato
        # ###########################################

        $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=" . $cep_origem . "&sCepDestino=" . $cep_destino . "&nVlPeso=" . $peso . "&nCdFormato=1&nVlComprimento=" . $comprimento . "&nVlAltura=" . $altura . "&nVlLargura=" . $largura . "&sCdMaoPropria=n&nVlValorDeclarado=" . $valor_declarado . "&sCdAvisoRecebimento=n&nCdServico=" . $cod_servico . "&nVlDiametro=0&StrRetorno=xml";
        $xml = simplexml_load_file($correios);

        $_arr_ = array();

        if ($xml->cServico->Erro == '0') {
            $_arr_['code'] = $xml->cServico->Codigo;
            $_arr_['value'] = $xml->cServico->Valor;
            $_arr_['deadline'] = $xml->cServico->PrazoEntrega . ' Dias';
            //return $xml->cServico->Valor;
            $array = json_decode(json_encode((array)$xml), TRUE);
            return $array;
        } else {
            return false;
        }
    }

    $_resultado = calculaFrete(
        $cod_servico,
        $cep_origem,
        $cep_destino,
        $peso,
        $altura,
        $largura,
        $comprimento,
        0
    );

    $value_freight = $_resultado['cServico']['ValorSemAdicionais'];
    $deadline = $_resultado['cServico']['PrazoEntrega'];

    $arr = [
        "value_freight" => $value_freight,
        "deadline" => $deadline
    ];

    echo json_encode($arr);
}
