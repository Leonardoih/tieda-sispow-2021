<?php
session_start();
$fecha = date("d/m/Y",strtotime('now'));
require_once "control/CtrlVentas.php";
$CtrlVenta = new CtrlVentas();

if (!empty($_POST['met_pag'])) {

    $metodo_pag = $_POST['met_pag'];

    if ($metodo_pag == 1) {
        $metodo = 'Efectivo';
    } else {
        $metodo  = 'Tarjeta Credito';
    }
}

$login = $_SESSION['login'];

$pago = $_POST['pago'];

if ($pago == 1) {
    $metodo = 'Efectivo';
} else {
    $metodo = 'Tarjeta';
}


$id = $login['id_cliente'];
$carrito = $_SESSION['carrito'];
$total = $_SESSION['total'];
$CtrlVenta->crearVenta($id, $carrito, $total, $metodo);

// echo $total;
// print_r($carrito);
// echo "OK venta";
// header("location:index.php");

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "plantilla/link.php"?>
    <meta charset="UTF-8">
    <title>Factura</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>
    <?php include "plantilla/cabecera.php"; ?>
    <br><br>
    <div class="container">

        <form>
            <div class="row  justify-content-center align-items-left">
                <span class="h2">Factura</span><br>
            </div>


    </div>
    <!-- info cliente INICIO -->
    <div class="row  justify-content-center align-items-center ">
        <div class="col-md-6 mb-2">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>Nro. Factura:</th>
                        <th> <b>Fecha:</b> <?php echo $fecha ?></th>
                    </tr>
                    <tr>

                    </tr>
                    <tr>
                        <th> <b>Cliente:</b> <?php echo  " " . $login['nombres'] . " " . $login['apellidos']; ?></th>
                    </tr>
                    <tr>
                        <th> <b>Cedula:</b> <?php echo  " " . $login['nro_doc'] ?> </th>
                        <th> <b>Metodo de Pago:</b> <?php echo  " " . $metodo ?> </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- FIN -->
    <!-- Detalle factura INICIO -->
    <div class="row  justify-content-center align-items-center ">
        <div class="col-md-6 mb-2">
            <?php if (!empty($_SESSION['carrito'])) {
                $carrito = $_SESSION['carrito'];
            ?>
                <table class="table table-light table-bordered">
                    <tbody>
                        <tr>
                            <th width="40%">Nombre</th>
                            <th width="15%" class="text-center">Cantidad</th>
                            <th width="20%" class="text-center">Precio Unitario</th>
                            <th width="20%" class="text-center">SubTotal</th>
                        </tr>
                        <?php $total = 0;
                        $i = 0;
                        foreach ($carrito as $indice => $producto) { ?>
                            <tr>
                                <td><?php echo $producto['nombre'] ?></td>
                                <td class="text-center"><?php echo $producto['cantidad'] ?></td>
                                <td class="text-center"><?php echo $producto['precio'] ?></td>
                                <td class="text-center"><?php echo  number_format($producto['cantidad'] * $producto['precio'], 2); ?></td>

                            </tr>
                        <?php
                            $total += $producto['cantidad'] * $producto['precio'];
                            $i++;
                        } ?>
                        <tr>
                            <td colspan="2" align="right">
                                <h3>Total</h3>
                            </td>
                            <td align="center">
                                <h3>
                                    $<?php echo number_format($total, 2);
                                        $_SESSION['total'] = $total;
                                        ?>
                                </h3>
                            </td>
                        </tr>

                    </tbody>
                </table>
            <?php }
            //remover carrito de compra
            $_SESSION['carrito'] = null;
            // session_destroy($carrito);
            //remover total
            $_SESSION['total'] = null;
            // session_destroy($total);

            ?>
        </div>
    </div>

    <!-- Detalle factura FIN -->

    <!-- info -->
    <div class="row  justify-content-center align-items-center text-center">
        <div class="col-md-6 mb-2">
            <br>
            <!-- <p>Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con nombre, teléfono y Email</p> -->
            <h4>¡Gracias por su compra!</h4>
        </div>
    </div>
    <!-- info-->

    <div class="row  justify-content-center align-items-center text-center">
        <div class="col-md-6 mb-2">
            <br>
            <a href="index.php"><button class="btn btn-secondary btn-block" type="button">Regresar</button></a>
        </div>
    </div>

    </form>

    </div>

    <?php include "plantilla/piepagina.php"; ?>
</body>

</html>