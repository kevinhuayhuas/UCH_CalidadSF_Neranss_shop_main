<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabezera.php';


?>


       <?php if($mensaje!=""){?>       
        <div class="alert alert alert-success">
            

            <?php echo $mensaje;?>
           
            <a class="badge badge  badge-success" href="mostrarcarrito.php">Ver Carrito</a>
        </div>
       <?php }?>   

        <div class="row">
            <?php

            $sentecia =$pdo->prepare("SELECT*FROM productos");

            $sentecia->execute();

            $listaProductos = $sentecia->fetchAll(PDO::FETCH_ASSOC);
            
            //print_r($listaProductos);

            ?>

            <?php foreach ($listaProductos as $producto) {?>
            <div class="col-4">

                <div class="card" style="width:350px eigth:250">
                    <img class="card-img-top" title="<?php echo $producto['nombre'];  ?>"
                        src="<?php echo $producto['imagen']; ?>" alt="Card image" style="width:100%"
                        data-toggle="popover" data-trigger="hover"
                        data-content="<?php echo $producto['descripcion']; ?>">

                    <div class="card-body">
                        <span><?php echo $producto['nombre'];  ?></span>


                        <h4 class="card-title">S/<?php echo   $producto['precio'];  ?></h4>
                        <!--<p class="card-text"><?php echo $producto['descripcion']; ?></p>-->
                        <p class="card-text">Descripción</p>

                        <form action="" method="post">
                    
                            <input type="hidden" name="registroid" id="id" value="<?php echo openssl_encrypt($producto['id'],COD,KEY);  ?>">
                            <input type="hidden" name="registroNombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'],COD,KEY);  ?>">
                            <input type="hidden" name="registroPrecio" id="precio" value="<?php echo openssl_encrypt($producto['precio'],COD,KEY);  ?>">
                            <input type="hidden" name="registroCantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);  ?>">
                          
                            <button type="submit" class="btn  btn-info" name="btnAccion" value="Agregar">Agregar al
                                Carrito</button>

                        </form>


                    </div>
                </div>
                <br>
            </div>


            <?php  }?>



        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
    });
    </script>

<?
include 'templates/pie.php';
?>