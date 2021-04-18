<?php
include "carrito.php";
require_once "control/CtrlClientes.php";
require_once "control/CtrlAdministrador.php";
require_once "control/CtlrSesiones.php";

$ctrlsesion = new CtlrSesiones();
$ctrladminitrador = new CtrlAdministrador();
$ctrlclientes = new CtrlClientes();
$mensaje = "";


// validamos si la variable post no viene vacia
if ($_POST)

    // validamos si los campos de usuario y clave vienen vacios
    if (empty($_POST['usuario']) || empty($_POST['clave'])) {
        $mensaje = '<div class="alert alert-danger" role="alert">
                    Ingrese su usuario y contraseña
                    </div>';
    } else {

        // en caso  de no estar vacio creamos un objeto de la clase ctrlclientes 

        // asignamos a variables lo que traemos por el metodo post
        $usuario = $_POST['usuario'];
        $clave = md5($_POST['clave']);

        $es = $ctrlclientes->buscarCliente($usuario);
        $ad = $ctrladminitrador->buscarAdministrador($usuario);

        $estado = $es['estado'];
        $estadoa = $ad['estado'];

        if ($estadoa == 0 && $estado == 0) {
            $mensaje = '<div class="alert alert-danger" role="alert">
                    El Usuario se encuentra actualmente inactivo!
                    </div>';
        } else {

            // realizamos una consulta para validar que si exita el usuario y la clave 
            // en la tabla clientes
            $datos = $ctrlclientes->validarCliente($usuario, $clave);

            if ($datos) {
                // si la consulta es verdadera creamos una variable de sesion login
                // y guardamos los datos del cliente
                // $mensaje = $datos['id_cliente'] . "-" . $datos['nick_usuario'] . "-" . $datos['nombres'] . "-" . $datos['apellidos'] . "-" . $datos['correo'];
                session_start();

                $_SESSION['login'] = array(
                    'tipo_usuario' => 2,
                    'id_cliente' => $datos['id_cliente'],
                    'persona' => $datos['persona'],
                    'nombres' => $datos['nombres'],
                    'apellidos' => $datos['apellidos'],
                    'nro_doc' => $datos['nro_identificacion'],
                    'direccion' => $datos['direccion'],
                    'celular' => $datos['celular'],
                    'nick' =>  $datos['nick_usuario']
                );
                $fecha = date("d/ m/ Y");
                $hora = date("H:i:s a");
                $cliente = $datos['id_cliente'];
                $tipo_usuario = 2;


                $sesion = $ctrlsesion->sesionInicio($fecha, $hora, $cliente, $tipo_usuario);

                header("location:index.php");
            } else {

                $datos2 = $ctrladminitrador->validaAdministrador($usuario, $clave);

                if ($datos2) {
                    session_start();
                    $_SESSION['login'] = array(
                        'tipo_usuario' => 1,
                        'persona' => $datos2['persona'],
                        'nombres' => $datos2['nombres'],
                        'apellidos' => $datos2['apellidos'],
                        'nro_doc' => $datos2['nro_identificacion'],
                        'direccion' => $datos2['direccion'],
                        'celular' => $datos2['celular'],
                        'nick' =>  $datos2['nick_usuario']
                    );


                    header("location:administrador/index.php");
                } else {
                    $mensaje = '<div class="alert alert-danger" role="alert">
                                 Usuario o contraseña incorrectos
                            </div>';
                }
            }
        }
    }


?>

<!-- INICIO DOCUMENTO HTML -->
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "plantilla/link.php" ?>
    <title> Login </title>
</head>

<body>
    <?php include "plantilla/cabecera.php"; ?>

    <div class="container">
        <br><br>
        <div class="row  justify-content-center align-items-center minh-100">
            <div class="col-md-12 text-center">
                <h1>Iniciar sesiones</h1>
            </div>
        </div>

        <form method="POST">
            <div class="row  justify-content-center align-items-center">
                <div class="form-group col-md-6 ">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" name="usuario" placeholder="Ingrese su Usuario numero 2">
                </div>
            </div>

            <div class="row  justify-content-center align-items-center">
                <div class="form-group col-md-6">
                    <label for="clave">Contraseña</label>
                    <input type="password" class="form-control" name="clave" placeholder="ingrese su contraseña">
                </div>
            </div>

            <div class="row  justify-content-center align-items-center">
                <div class="form-group text-center col-md-6">
                    <?php if ($mensaje != "") {
                        echo  $mensaje;
                    } ?>
                    <a href="Registro.php">Si no tienes cuenta puedes registrarte haciendo clic acá</a>
                </div>
            </div>

            <div class="row  justify-content-center align-items-center">
                <div class="col-md-6">
                    <input type="submit" class="form-control btn btn-primary btn-lg " value="Ingresar">
                </div>
            </div>
        </form>
    </div>


    <?php include 'plantilla/piepagina.php'; ?>
</body>

</html>