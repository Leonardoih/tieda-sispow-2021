<?php
session_start();
require_once "control/CtrlProductos.php";
$ctrlprod = new CtrlProductos();

$mensaje = "";


// añadir productos al carrito
if (isset($_POST['btnAccion'])) {

    switch ($_POST['btnAccion']) {
        case 'Agregar':
            $id = openssl_decrypt($_POST['id'], cod, llave);
            $nombre = openssl_decrypt($_POST['nombre'], cod, llave);
            $precio = openssl_decrypt($_POST['precio'], cod, llave);
            // $cantidad = $_POST['cantidad'];
            if (empty($_POST['cantidad'])) {
                $cantidad = 1;
            } else {
                $cantidad = $_POST['cantidad'];
            }

            $subtotal = $cantidad *  $precio;


            //  $mensaje .= "id ok: " . $id . "nombre ok: " . $nombre . "precio: " . $precio . "cantidad: " . $cantidad . "subtotal: " . $subtotal;

            if (!isset($_SESSION['carrito'])) {
                $producto = array(
                    'id' => $id,
                    'nombre' => $nombre,
                    'cantidad' => $cantidad,
                    'precio' => $precio,
                    'subtotal' => $subtotal
                );

                $_SESSION['carrito'][0] = $producto;
                $mensaje .= '<div class="alert alert-success">
                                    Producto agregado al carrito
                                    <a href="listaCarrito.php"><b>ver carrito</b></a>
                                </div>';
            } else {

                $numeroproductos = count($_SESSION['carrito']);

                $producto = array(
                    'id' => $id,
                    'nombre' => $nombre,
                    'cantidad' => $cantidad,
                    'precio' => $precio,
                    'subtotal' => $subtotal
                );

                // // lo validamos con el stock que tenemos en la base de datos
                // // si tiene lo agregamos al carrito en caso contrario mandamos un mensaje de error
                if ($ctrlprod->getExistencias($id, $cantidad)) {

                    $_SESSION['carrito'][$numeroproductos] = $producto;
                    $mensaje .= '<div class="alert alert-success">
                                    Producto agregado al carrito
                                    <a href="listaCarrito.php"><b>ver carrito</b></a>
                                </div>';
                } else {
                    $mensaje = '<div class="alert alert-danger">
                                   El producto no tiene existencias
                                </div>';
                }
            }

            break;
        case "Remover":
            //eliminar producto del carrito
            $indice = $_POST['indice'];

            if (isset($_SESSION['carrito'])) {
                $carrito = $_SESSION['carrito'];

                unset($carrito[$indice]);

                $carrito = array_values($carrito);

                $_SESSION['carrito'] = $carrito;

                echo "<script>alert('Producto removido del carrito')</script>";

                if (count($carrito) == 0) {
                    session_unset($carrito);
                }
            }

            break;
        default:
            # code...
            break;
    }
}
