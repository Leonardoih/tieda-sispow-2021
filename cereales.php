<?php
require_once "control/CtrlProductos.php";
require_once "carrito.php";
$categoria = 1;
$ctrlProducto = new CtrlProductos();

?>
<!-- INICIO DOCUMENTO HTML -->
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "plantilla/link.php" ?>
    <title> Cereales </title>
</head>

<body>

    <?php include "plantilla/cabecera.php"; ?>
    <br>
    <br>



    <div class="container">
        <br>
        <?php if ($mensaje != "") {
            // <!--Mensaje que encontramos en la parte superior-->
            echo $mensaje;
            //print_r($_SESSION['carrito']);      
        } ?>

        <!-- INICIO Area para mostrar los producto -->
        <div class="row">
            <?php
            $listaproductos = $ctrlProducto->buscarProductoCategoria($categoria);
            
            //print_r($listaproductos);
            ?>

            <?php
            //creamos un ciclo foreach para mostrar la informacion de cada producto
            foreach ($listaproductos as $producto) {
            ?>
                <!-- cantidad de elemtos por fila -->
                <div class="col-3">
                    <div class="card" align="center">
                        <!--insertar imagen-->
                        <img title="<?php echo $producto['nombre'] ?>" 
                        alt="<?php echo $producto['nombre'] ?>" 
                        class="card-img-top" 
                        src="<?php echo $producto['imagen'] ?>" 
                        height="300px"  width="250"  border="1">
                        <!-- cuerpo de la tarjeta  producto -->
                        <div class="card-body">
                            <span><?php echo $producto['nombre'] ?></span>
                            <h5 class="card-title">$<?php echo number_format($producto['precio'],2,',','.') ?></h5>

                            <form action="" method="post" align="center">
                                <?php // encriptar la informacion de los productos con la funcion openssl_encript se le pasa los datos  a encriptar el medotodo de enciptacion y la llave
                                ?>

                                <input type="hidden" name="id" id="id" value="<?php echo  openssl_encrypt($producto['id_producto'], cod, llave); ?>">
                                <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], cod, llave); ?>">
                                <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], cod, llave); ?>">

                                <input type="number" name="cantidad" id="cantidad" style="margin-bottom:8px;width:100px" placeholder="cantidad" min="1">

                                <button class=" btn btn-success " type="submit" name="btnAccion" value="Agregar">Agregar al carrito</button>

                            </form>
                        </div>
                    </div>
                    <br>
                </div>


            <?php } ?>

        </div>

    </div>

    <br>

    <?php include 'plantilla/piepagina.php'; ?>
</body>

</html>