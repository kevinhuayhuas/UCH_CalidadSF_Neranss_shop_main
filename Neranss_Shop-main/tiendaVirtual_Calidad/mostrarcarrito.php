<?php
include 'global/config.php';
include 'carrito.php';
include 'templates/cabezera.php';
?>
<br>
<h3>Lista de Carrito</h3>
<div class="container">
    <?php if(!empty($_SESSION['CARRITO'])){  ?>
    <table class="table  table-hover">
        <thead class="table-dark">
            <tr>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php $total=0;?>
            <?php foreach($_SESSION['CARRITO'] as $indice =>$productos)  { ?>

            <tr>


                <td><?php echo $productos['registroNombre'] ?></td>
                <td>S/.<?php echo  $productos['registroCantidad'] ?></td>
                <td>S/.<?php echo  $productos['registroPrecio'] ?></td>
                <td>S/.<?php echo number_format($productos['registroPrecio']*$productos['registroCantidad'],2);  ?></td>
                <td>

                    <form action="" method="post">

                        <input type="hidden" name="registroEliminar" id="id"
                            value="<?php echo openssl_encrypt($productos['registroid'],COD,KEY);  ?>">
                        <button type="submit" class="btn btn-danger" name="btnAccion" value="Eliminar">Eliminar</button>
                    </form>


                </td>
            </tr>
            <?php $total=$total+($productos['registroPrecio']*$productos['registroCantidad']);?>
            <?php  }?>


            <tr>
                <td class="align-items-start">
                    <h3></h3>
                </td>
                <td class="align-items-start">
                    <h3></h3>
                </td>
                <td class="align-items-start">
                    <h3>TOTAL</h3>
                </td>
                <td align="rigth">
                    <h3><?php  echo number_format($total,2);?></h3>
                </td>
                <td class="align-items-start">
                    <h3></h3>
                </td>
            </tr>
            <tr>
                <td class="colspan=5">
                    <form action="pagar.php" method="post">
                        <div class="alert alert-success">
                            <div class="form-group">
                                <label for="usr">Correo de Contacto:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                    </div>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Por Favor Ingrese Tu Correo" required>
                                </div>
                                <small id="emailHelp" class=" form-text text-muted">
                                    Los productos se enviaran a este correo
                                <small>
                            </div>
                        </div>

                        <button type="submit" name="btnAccion" value="proceder" class="btn btn-success btn-lg btn-block">Proceder a Pagar >></button>

                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    <?php } else{?>
    <div class="alert alert-success">
        <strong>No Hay Productos en el Carrito!</strong>
    </div>

    <?php }?>
</div>

<?php
include 'templates/pie.php';
?>