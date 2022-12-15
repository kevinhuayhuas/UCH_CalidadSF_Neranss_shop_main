<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabezera.php';
?>


<?php

echo print_r($_GET);

$ClienID="ASzygh9NC-leY3TxT8ByrbD_uXSbvwN8a8JOydTnOZTkJy_LjWjS25aSarvQyR5zgt1x1tb5M9musSK3";
$Secret="EJ9J8t4HROoHL95OnA2ZjB7CtgpZWCVTYe8p2vItvatPtCz7u4zkbAZUoL8Y8LOEZwf9ajs3J6n-AJz5";
$login =curl_init("https://api-m.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($login,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($login,CURLOPT_USERPWD,$ClienID.":".$Secret);
curl_setopt($login,CURLOPT_POSTFIELDS,"grant_type=client_credentials");
$Respuesta = curl_exec($login);
//print_r($Respuesta);
$objRespuesta=json_decode($Respuesta );

$AccessToken=$objRespuesta->access_token;

print_r($AccessToken);

/*$venta = curl_init("https://api.sandbox.paypal.com/v1/payments/payment/".$_GET['paymentID']);

curl_setopt($venta,CURLOPT_HTTPHEADER,$array = array("Content-Type: aplication/json","Authorization: Bearer Access".$AccessToken ));

$RespuestaVenta= curl_exec($venta);
//print_r($RespuestaVenta);*/
?>






<?
include 'templates/pie.php';
?>


