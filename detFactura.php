<?php
session_start();
require_once "control/CtrlVentas.php";

if (!isset($_SESSION['login'])) {
    header("location:../index.php");
} else {
    $login = $_SESSION['login'];
    if ($login['tipo_usuario'] != 2) {
        header("location:administrador/index.php");
    }
}



$login = $_SESSION['login'];
$id_cliente = $login['id_cliente'];

if (!empty($_POST['id_venta'])) {
    $id_venta = $_POST['id_venta'];

    $CtrlVentas = new CtrlVentas();
    $datos = $CtrlVentas->detalleVenta($id_cliente, $id_venta);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "plantilla/link.php" ?>
    <title>Detalle Factura</title>
</head>

<body>
    <?php include "plantilla/cabecera.php" ?>
    <div class="container">
        <br>
        <h3 class="display-4 text-center">Detalle Compra</h3>
        <br>

        <div class="row  justify-content-center align-items-center ">
            <div class="col-md-6 mb-2">

                <?php if (isset($datos) || !empty($datos)) { ?>

                    <table class="table table-light table-bordered">
                        <tbody>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Precio Unitario</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">SubTotal</th>
                            </tr>
                            <?php foreach ($datos as $det) { ?>
                                <tr>
                                    <td id="producto" class="text-center"><?php echo $det['producto'] ?></td>
                                    <td id="precio" class="text-center"><?php echo $det['precio'] ?></td>
                                    <td id="cantidad" class="text-center"><?php echo $det['cantidad'] ?></td>
                                    <td id="subtotal" class="text-center">$<?php echo  $det['subtotal']; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3" align="center">
                                    <h3>Total</h3>
                                </td>
                                <td colspan="3" align="center">
                                    <h3>$<?php echo $det['total']; ?></h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                <?php } else { ?>
                    <div class="alert alert-warning text-center">
                        <h5>Seleccione una factura para ver el detalle! </h5>
                    </div>
                <?php } ?>
                <div class="row  justify-content-center align-items-center text-center">
                    <div class="col-md-6 mb-2">
                        <br>
                        <a href="HistorialCompras.php"><button class="btn btn-secondary btn-block" type="button">Regresar</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "plantilla/piepagina.php" ?>
</body>

</html>