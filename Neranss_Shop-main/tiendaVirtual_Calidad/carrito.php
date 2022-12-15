<?php
session_start();


$mensaje ='';

if(isset($_POST['btnAccion'])){
    switch ($_POST['btnAccion']) {
        case 'Agregar':
            if(is_numeric( openssl_decrypt($_POST['registroid'],COD,KEY))){
                $ID=openssl_decrypt($_POST['registroid'],COD,KEY);
                $mensaje.="ok id Correcto".$ID."<br/>";
            }else{

                $mensaje.="ok id incorrecto".$ID."<br/>";

            }

            if(is_string( openssl_decrypt($_POST['registroNombre'],COD,KEY))){
                $nombre=openssl_decrypt($_POST['registroNombre'],COD,KEY);
                $mensaje.="ok Nombre Correcto".$nombre."<br/>";
            }else{

                $mensaje.="ok Nombre incorrecto".$nombre."<br/>";

            }
            if(is_numeric( openssl_decrypt($_POST['registroCantidad'],COD,KEY))){
                $cantidad=openssl_decrypt($_POST['registroCantidad'],COD,KEY);
                $mensaje.="ok cantidad ".$cantidad."<br/>";
            }else{

                $mensaje.="ok cantidad incorrecto".$cantidad."<br/>";

            }

            if(is_numeric( openssl_decrypt($_POST['registroPrecio'],COD,KEY))){
                $precio=openssl_decrypt($_POST['registroPrecio'],COD,KEY);
                $mensaje.="ok precio Precio".$precio."<br/>";
            }else{

                $mensaje.="ok precio incorrecto".$precio."<br/>";

            }

           if(!isset($_SESSION['CARRITO'])){
               $producto = array(

                'registroid'=>$ID,
                'registroNombre'=>$nombre,
                'registroCantidad'=>$cantidad,
                'registroPrecio'=>$precio
               );

               $_SESSION['CARRITO'][0]= $producto;
               $mensaje ="Producto Agregado al Carrito";

           }else{
               $idProductos=array_column($_SESSION['CARRITO'],"registroid");

                if(in_array($ID,$idProductos)){
                    echo "<script>alert('El Producto ya ha Sido Seleccionado');</script>";
                    $mensaje ="";

                }else{
                    $numeroProductos = count($_SESSION['CARRITO']);
                    $producto = array(

                        'registroid'=>$ID,
                        'registroNombre'=>$nombre,
                        'registroCantidad'=>$cantidad,
                        'registroPrecio'=>$precio
                    );
                    $_SESSION['CARRITO'][$numeroProductos]= $producto;
                    $mensaje ="Producto Agregado al Carrito";
                }
           }
          // $mensaje =print_r($_SESSION,true);
         
        break;

        case 'Eliminar':
                if(is_numeric( openssl_decrypt($_POST['registroEliminar'],COD,KEY))){
                    $ID=openssl_decrypt($_POST['registroEliminar'],COD,KEY);

                    foreach($_SESSION['CARRITO'] as $indice =>$producto){
                       
                       //echo print_r($_SESSION['CARRITO']);
                       if($producto['registroid']==$ID){
                            unset($_SESSION['CARRITO'][$indice]);
                            echo "<script> alert('Elemento Borrado...');</script>";
                        }

                    }
                 
                }else{
    
                    $mensaje.="ok id incorrecto".$ID."<br/>";
    
                }

        break;


        
        
    }

  
}



?>