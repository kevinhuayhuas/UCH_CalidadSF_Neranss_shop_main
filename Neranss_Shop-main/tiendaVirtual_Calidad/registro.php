<?php 


require_once "database.php";



$nombre = $apellido = $dni = $telefono = $correo = $usuario = $contrasena = "";

$nombre_error = $apellido_error = $dni_error = $telefono_error = $correo_error = $usuario_error = $contrasena_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	/*Validacion del nombre*/
	if(empty(trim($_POST["nombre"]))){
		$nombre_error = "Por favor ingrese un nombre";
	}else{
		$nombre = trim($_POST["nombre"]);
	}

	/*Validacion del apellido*/
	if(empty(trim($_POST["apellido"]))){
		$apellido_error = "Por favor ingrese un apellido";
	}else{
		$apellido = trim($_POST["apellido"]);
	}

	/*Validacion del DNI*/
	if(empty(trim($_POST["dni"]))){
		$dni_error = "Por favor ingrese un dni";
	}elseif(strlen(trim($_POST["dni"])) < 8){
        $dni_error = "El DNI debe tener 8 caracteres.";
    }elseif(strlen(trim($_POST["dni"])) > 8){
        $dni_error = "El DNI debe tener 8 caracteres.";
    }else{
		$dni = trim($_POST["dni"]);
	}

	/*Validacion del telefono*/
	if(empty(trim($_POST["telefono"]))){
		$telefono_error = "Por favor ingrese un telefono";
	}elseif(strlen(trim($_POST["telefono"])) < 9){
        $telefono_error = "El telefono debe tener 9 caracteres.";
    }elseif(strlen(trim($_POST["telefono"])) > 9){
        $telefono_error = "El telefono debe tener 9 caracteres.";
    }else{
		$telefono = trim($_POST["telefono"]);
	}

	/*Validacion del correo*/
	if(empty(trim($_POST["correo"]))){
		$correo_error = "Por favor ingrese un correo";
    }else{
		$correo = trim($_POST["correo"]);
	}

	/*Validacion de usuario*/
	if(empty(trim($_POST["usuario"]))){
        $usuario_error = "Por favor ingrese un usuario";
    } else{
        $sql = "SELECT id_Usuario FROM usuario WHERE usuario = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST["usuario"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $usuario_error = "Este usuario ya existe";
                } else{
                    $usuario = trim($_POST["usuario"]);
                }
            } else{
                echo "Al parecer algo salió mal";
            }
        }
        mysqli_stmt_close($stmt);
    }
    
    /*Validacion de contraseña*/
    if(empty(trim($_POST["contrasena"]))){
        $contrasena_error = "Por favor ingresa una contraseña";     
    } elseif(strlen(trim($_POST["contrasena"])) < 6){
        $contrasena_error = "La contraseña al menos debe tener 6 caracteres";
    } elseif(strlen(trim($_POST["contrasena"])) > 15){
        $contrasena_error = "La contraseña debe tener un maximo de 15 caracteres";
    } else{
        $contrasena = trim($_POST["contrasena"]);
    }


    if(empty($nombre_error) && empty($apellido_error) && empty($dni_error) && empty($telefono_error) && empty($correo_error) && empty($usuario_error) && empty($contrasena_error)){
        
        $sql = "INSERT INTO usuario (nombre, apellido, dni, telefono, correo, usuario, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssss", $param_nombre, $param_apellido, $param_dni, $param_telefono, $param_correo, $param_usuario, $param_contrasena);
            
            $param_nombre = $nombre;
            $param_apellido = $apellido;
            $param_dni = $dni;
            $param_telefono = $telefono;
            $param_correo = $correo;
            $param_usuario = $usuario;
            $param_contrasena = $contrasena;

            if(mysqli_stmt_execute($stmt)){
                header("location: principal.php");
            } else{
                echo "Algo salió mal, por favor inténtalo de nuevo.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}

?>