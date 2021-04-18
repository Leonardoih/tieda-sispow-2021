<?php

require_once "carrito.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "plantilla/link.php" ?>
    <title> Lista Carrito </title>
</head>

<body>
    <?php include "plantilla/cabecera.php"; ?>

    <br>
    <br>
    <div class="container">

        <h3>Lista Carrito</h3>
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
                        <th width="5%">Accion</th>
                    </tr>
                    <?php $total = 0;
                    $i = 0;
                    foreach ($carrito as $indice => $producto) { ?>
                        <tr>
                            <td width="40%"><?php echo $producto['nombre'] ?></td>
                            <td width="15%" class="text-center"><?php echo $producto['cantidad'] ?></td>
                            <td width="20%" class="text-center"><?php echo number_format($producto['precio'],2,',','.') ?></td>
                            <td width="20%" class="text-center"><?php echo  number_format($producto['cantidad'] * $producto['precio'],2,',','.'); ?></td>
                            <td width="5%">
                                <form action="" method="POST">
                                    <input type="hidden" name="indice" value="<?php echo $i ?>">
                                    <button class=" btn btn-danger" type="submit" name="btnAccion" value="Remover">Remover</button>
                                    <!-- <a class="btn btn-danger" name="btnAccion" value="Eliminar" href="carrito.php?in=<?php// echo $i ?>">Eliminar</a> -->
                                </form>
                            </td>
                        </tr>
                    <?php
                        $total += $producto['cantidad'] * $producto['precio'];
                        $i++;
                    } ?>
                    <tr>
                        <td colspan="3" align="right">
                            <h3>Total</h3>
                        </td>
                        <td align="center">
                            <h3>
                                $<?php echo number_format($total,2,',','.');
                                    $_SESSION['total'] = $total;
                                    ?>
                            </h3>
                        </td>
                    </tr>
                    <tr>
                        <?php if (!isset($_SESSION['login'])) { ?>
                            <td colspan="5">
                                <div class="alert alert-warning">
                                    Debe iniciar sesion para procesar el pago
                                    <a href="login.php">Iniciar sesion</a>
                                </div>
                            </td>

                        <?php } else { ?>


                            <td colspan="5" align="center">
                                <form action="ProcesarPago.php" method="POST">
                                    <div class="row  justify-content-center align-items-center">
                                        <div class="col-md-3">
                                            <label for="pago">
                                                <h4>Metodo de Pago</h4>
                                            </label>
                                            <select class="form-control name=" pago" id="pago">
                                                <option value="1">Efectivo</option>
                                                <option value="2">Tarjeta</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row  justify-content-center align-items-center">
                                        <div class="col-md-12">
                                            <input type="submit" class="form-control btn btn-primary btn-lg btn-block" value="Procesar Pago">
                                        </div>
                                    </div>
                                </form>
                            </td>

                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-success">
                No hay productos en el carrito
            </div>
        <?php } ?>
    </div>

    <?php include 'plantilla/piepagina.php'; ?>
</body>

</html>