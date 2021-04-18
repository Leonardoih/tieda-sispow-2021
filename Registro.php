<?php
include "control/config.php";
include "carrito.php";
require_once "control/CtrlClientes.php";
require_once "control/Ctrlpersonas.php";

$mensaje = "";

if (
    !empty($_POST['nombres'])
    || !empty($_POST['num_doc'])
    || !empty($_POST['correo'])
    || !empty($_POST['telefono'])
    || !empty($_POST['usuario'])
    || !empty($_POST['clave'])
    || !empty($_POST['direccion'])
) {
    $CtrlPersona = new CtrlPersonas();
    $CtrlCliente = new CtrlClientes();

    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $num_doc = $_POST['num_doc'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];
    $usuario = $_POST['usuario'];
    $clave = md5($_POST['clave']);



    // validamos si la persona se encuentra registrada y el cliente no
    $persona = $CtrlPersona->buscarPersona($num_doc, $correo);
    $cliente = $CtrlCliente->buscarCliente($usuario);

    if ($persona) {
        //echo "existe persona <br><br><br>";
        $id_persona = $persona['id_persona'];
        //despues que encontramos la persona validar que no se encuentre registrado
        // el mismo nick de usuario
        if ($cliente) {
            $mensaje = '<div class="alert alert-danger alert-dismissible fade show">
                     <button class="close" type="button" data-dismiss="alert">&times;</button>
                       El nombre de usuario no se encuentra disponible
             </div>';
        } else {
            if ($CtrlCliente->insertarCliente($usuario, $clave, $id_persona)) {
                $mensaje = '<div class="alert alert-success alert-dismissible fade show">
                            <button class="close" type="button" data-dismiss="alert">&times;</button>
                             Registro Exitoso
                        </div>';
            }
        }
    } else 
        if ($cliente) {
        $mensaje = '<div class="alert alert-danger alert-dismissible fade show">
                     <button class="close" type="button" data-dismiss="alert">&times;</button>
                        El Usuario O Identificacion ya se encuentran registrados
                    </div>';
    } else {

        if ($id_persona = $CtrlPersona->insertarPersona($nombres, $apellidos, $num_doc, $direccion, $celular, $correo)) {
            //echo "persona registrada";
            if ($CtrlCliente->insertarCliente($usuario, $clave, $id_persona)) {
                $mensaje = '<div class="alert alert-success alert-dismissible fade show">
                                <button class="close" type="button" data-dismiss="alert">&times;</button>
                                    Registro Exitoso
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
    <?php include "plantilla/link.php"?>
    <title> Registro </title>
</head>


<body>
    <?php include "plantilla/cabecera.php"; ?>
    <div class="container">
        <br><br>
        <form method="post">

            <h2 class="display-5">Crear una cuenta </h2>
            <hr><br>
            <span> Los campos marcados con <b>(*)</b> son obligatorios </span>

            <?php echo $mensaje; ?>

            <br><br>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label for="nombres">Nombres<b>*</b></label>
                        <input class="form-control" type="text" name="nombres" id="nombres" pattern="^[A-Za-z ]+$" required>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input class="form-control" type="text" name="apellidos" id="apellidos" pattern="^[A-Za-z ]+$">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="num_doc">Nro. Documento<b>*</b></label>
                        <input class="form-control" type="text" name="num_doc" id="num_doc" required onkeypress='return validaNumeros(event)'>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="correo">Correo<b>*</b></label>
                        <input class="form-control" type="email" name="correo" id="correo" placeholder="tucorreo@jemplo.com" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input class="form-control" type="text" name="celular" id="celular" onkeypress='return validaNumeros(event)'>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="direccion">Direccion<b>*</b></label>
                        <input class="form-control" type="text" name="direccion" id="direccion" required>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="usuario">Usuario<b>*</b></label>
                        <input class="form-control" type="text" name="usuario" id="usuario" required>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="clave">Clave<b>*</b></label>
                        <input class="form-control" type="password" name="clave" id="clave" required>
                    </div>
                </div>

            </div>
            <input type="submit" onclick="validarTexto()" class="btn btn-primary btn-lg btn-block" value="Registrar">
        </form>
    </div>
    <?php include 'plantilla/piepagina.php'; ?>
</body>


</html>