<?php

require_once "../control/CtrlProductos.php";
require_once "../carrito.php";

$ctrlProducto = new CtrlProductos();

?>
<!-- INICIO DOCUMENTO HTML -->
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "plantilla/link.php" ?>
    <title> Sisposw </title>
</head>

<body>

    <?php include "plantilla/cabecera.php"; ?>
    <br>
    <br>

    <!-- Slider Inicio  -->
    <div class="container">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="imagenes/slider1.jpg" height="400px" width="1280px" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="imagenes/slider2.jpg" class="d-block w-100" alt="..." height="400px" width="1280px">
                </div>
                <div class="carousel-item">
                    <img src="imagenes/slider3.jpg" class="d-block w-100" alt="..." height="400px" width="1280px">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
        </div>
    </div>
    <!-- Slider fin -->

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
            $listaproductos = $ctrlProducto->listaProductos();
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
