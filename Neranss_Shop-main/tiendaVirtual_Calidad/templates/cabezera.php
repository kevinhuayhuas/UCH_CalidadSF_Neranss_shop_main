<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ＮｅｒＡｎｎ'ｓ Ｓｈｏｐ </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php"></a>

        <!-- Links -->
        <ul class="navbar-nav">
        <li class="nav-item">
                <a class="nav-link activo" href="index.php">Inicio
               
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="home.php">Producto
               
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="mostrarcarrito.php">Carrito
                (<?php echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);
                
                ?>)
                </a>
            </li>



            </li>
        </ul>
    </nav>
    <br>
    <div class="container">