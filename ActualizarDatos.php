<?php
session_start();
require_once "control/CtrlPersonas.php";
$controlpersona = new CtrlPersonas();
$mensaje = "";
// validar si hay una sesion activa
if (!isset($_SESSION['login'])) {
    header("location:login.php");
} else {
    $login = $_SESSION['login'];

    if ($login['tipo_usuario'] != 2) {
        header("location:administrador/index.php");
    } else {

        $id = $login['persona'];
        $datos = $controlpersona->buscarPersonaId($id);
    }
}



if (
    !empty($_POST['nombres'])
    || !empty($_POST['num_doc'])
    || !empty($_POST['correo'])
    || !empty($_POST['telefono'])
    || !empty($_POST['clave'])
    || !empty($_POST['direccion'])
) {

    $id = $login['persona'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $num_doc = $_POST['num_doc'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];


    $actualizar = $controlpersona->actualizarPersona($id, $nombres, $apellidos, $num_doc, $direccion, $celular, $correo);

    if (!$actualizar) {
        $mensaje = '<div class="alert alert-success" role="alert">
                                 Datos Actualizados correctamente
                            </div>';
    } else {
        $mensaje = '<div class="alert alert-danger" role="alert">
                                 Error al actulizar datos
                            </div>';
    }
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "plantilla/link.php" ?>
    <title>Actualizar Informacion</title>
</head>

<body>
    <?php include "plantilla/cabecera.php" ?>

    <div class="container">
        <br>
        <form method="post">
            <br>
            <h2 class="display-5">Actualizar Informacion </h2>
            <hr>

            <?php echo $mensaje; ?>
            <br>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input class="form-control" type="text" name="nombres" id="nombres" pattern="^[A-Za-z ]+$" required value="<?php echo $datos['nombres'] ?>">
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input class="form-control" type="text" name="apellidos" id="apellidos" pattern="^[A-Za-z ]+$" value="<?php echo $datos['apellidos'] ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="num_doc">Nro. Documento</label>
                        <input class="form-control" type="text" name="num_doc" id="num_doc" required onkeypress='return validaNumeros(event)' value="<?php echo $datos['nro_identificacion'] ?>">
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input class="form-control" type="email" name="correo" id="correo" placeholder="tucorreo@jemplo.com" required value="<?php echo $datos['correo'] ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input class="form-control" type="text" name="celular" id="celular" onkeypress='return validaNumeros(event)' value="<?php echo $datos['celular'] ?>">
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input class="form-control" type="text" name="direccion" id="direccion" required value="<?php echo $datos['direccion'] ?>">
                    </div>
                </div>

            </div>


            <input type="submit" onclick="validarTexto()" class="btn btn-primary btn-lg btn-block" value="Actualizar">
        </form>

        <?php include 'plantilla/piepagina.php'; ?>
</body>

</html>