<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabezera.php';

?>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<style>
    
    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }
    
    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 250px;
            display: inline-block;
        }
    }
    
</style>

<?php
if($_POST){
    $total=0;
    $SID=session_id();
    $Correo=$_POST['email'];
    foreach($_SESSION['CARRITO'] as $indice =>$productos)  {
      $total=$total+($productos['registroPrecio']*$productos['registroCantidad']);
     }

     $sentecia = $pdo->prepare("INSERT INTO `ventas` (`ID`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `status`) 
     VALUES (NULL, :ClaveTransaccion, '', now(), :Correo, :Total, 'pendiente');");
    $sentecia->bindParam(":ClaveTransaccion",$SID);
    $sentecia->bindParam(":Correo",$Correo);
    $sentecia->bindParam(":Total",$total);
   $sentecia->execute();
   $idVenta=$pdo->lastInsertId();
   
   foreach($_SESSION['CARRITO'] as $indice =>$productos)  {
    $sentecia = $pdo->prepare("INSERT INTO `detalleventa` (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`, `DESCARGADO`) 
    VALUES (NULL, :IDVENTA, :IDPRODUCTO, :PRECIOUNITARIO, :CANTIDAD, '0');");
    $sentecia->bindParam(":IDVENTA",$idVenta);
    $sentecia->bindParam(":IDPRODUCTO",$productos['registroid']);
    $sentecia->bindParam(":PRECIOUNITARIO",$productos['registroPrecio']);
    $sentecia->bindParam(":CANTIDAD",$productos['registroCantidad']);
    $sentecia->execute();
    
   }
  // echo "<h2>".$total."</h2>";
}

?>

<div class="container">
    <div class="jumbotron text-center">
        <h1 class="display-4">!Paso Final!</h1>
        <hr class="my-4">
        <p>Estas a punto de paga con paypal la cantidad de:
        <h4>S/.<?php echo number_format($total,2);?></h4>
        </p>
        <div id="paypal-button-container">

        </div>
        <p>Los Productos podran ser descargados una vez que se procese el pago</br>
            <strong>(Para aclaraciones : soporte@uch.pe)</strong>
        </p>

    </div>

</div>

<script>
    paypal.Button.render({
        env: 'sandbox', // sandbox | production
        style: {
            label: 'checkout',  // checkout | credit | pay | buynow | generic
            size:  'responsive', // small | medium | large | responsive
            shape: 'pill',   // pill | rect
            color: 'gold'   // gold | blue | silver | black
        },
 
        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
 
        client: {
            sandbox:    'ASzygh9NC-leY3TxT8ByrbD_uXSbvwN8a8JOydTnOZTkJy_LjWjS25aSarvQyR5zgt1x1tb5M9musSK3',
            production: ''
        },
 
        // Wait for the PayPal button to be clicked
 
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '<?php echo  $total;?>', currency: 'MXN' }, 
                            description:"Compra de productos Nerans: S/<?php echo number_format($total,2);?>",
                            custom:"<?php echo $SID;?>#<?php echo openssl_encrypt($idVenta,COD,KEY);?>"
                        }
                    ]
                }
            });
        },
 
        // Wait for the payment to be authorized by the customer
 
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                console.log(data);
                window.location="verificador.php?paymentToken="+data.paymentToken+"&paymentID="+data.paymentID;
            });
        }
    
    }, '#paypal-button-container');
 
</script>
<?php
include 'templates/pie.php';
?>