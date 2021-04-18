<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("location:../index.php");
} else {
    $login = $_SESSION['login'];
    if ($login['tipo_usuario'] != 1) {
        header(".../location:index.php");
    }
}

require_once "../control/Ctrlproductos.php";
$mensaje = "";

$controlproducto = new CtrlProductos();
$productos = $controlproducto->listaProductos();



if (
    !empty($_POST['nombre'])
    || !empty($_POST['precio'])
    || !empty($_POST['categoria'])
    || !empty($_POST['imagen'])
    || !empty($_POST['marca'])
    || !empty($_POST['stock'])
    || !empty($_POST['existencia'])


) {
    $id = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $imagen = $_POST['imagen'];
    $marca = $_POST['marca'];
    $stock = $_POST['stock'];
    $existencia = $_POST['existencia'];

    $accion = $_POST['accion'];
    //echo  "<script>alert('$id,$nombre,$precio,$categoria,$imagen,$marca,$stock,$existencia')</script>";


    if ($accion == 1) {
        echo $accion;

        $actualizar = $controlproducto->actualizarProducto($id, $nombre, $precio, $categoria, $imagen, $marca, $stock, $existencia);

        if (!$actualizar) {
            header("location:inventario.php");
        } else {
            echo "<script>alert('Error al actualizar producto')</script>";
        }
    } else {
        $registrar = $controlproducto->insertarProducto($nombre, $precio, $categoria, $imagen, $marca, $stock, $existencia);
        if ($registrar) {
            header("location:inventario.php");
        } else {
            echo "<script>alert('Error al registrar producto')</script>";
        }
    }
} else if (!empty($_POST['id_producto'])) {
    $id = $_POST['id_producto'];
    $eliminar = $controlproducto->eliminarProducto($id);
    if (!$eliminar) {
        echo "<script>alert ('error al eliminar producto')</script>";
    } else {
        header("location:inventario.php");
    }
}



?>


<!DOCTYPE html>
<html lang="es">

<title>Gestion Inventario</title>
<?php include "plantilla/cabecera.php" ?>

<style>
        table.dataTable thead {
            background: linear-gradient(to right, #0575E6, #00F260);
            color:white;
        }
    </style>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include "plantilla/sidebar.php" ?>

        <!-- Contenido Principal -->

        <div class="content-wrapper">

            <div class="container-fluid">
                <br>
                <h1 class="display-4 text-center">Gestion Inventario</h1>

                <div class="row">

                    <div class="col-12">

                        <!-- /.card -->
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">
                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalRegistrar" style="font-size:12px">
                                    NUEVO <i class='fas fa-user-plus'></i>
                                </button>

                                <br><br>

                                <!-- Inicio Tabla productos -->

                                <table id="tablaproductos" class="table table-striped table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Categoria</th>
                                            <th>Imagen</th>
                                            <th>Marca</th>
                                            <th>Stock</th>
                                            <th>existencia</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($productos as $producto) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $producto['id_producto'] ?></td>
                                                <td class="text-center"><?php echo $producto['nombre'] ?></td>
                                                <td class="text-center"><?php echo number_format($producto['precio'],2,',','.') ?></td>
                                                <td class="text-center"><?php echo $producto['categoria'] ?></td>
                                                <td class="text-center">
                                                   
                                                    <img src="../<?php echo $producto['imagen'] ?>" height="40px" alt="">
                                                </td>
                                                <td class="text-center"><?php echo $producto['marca'] ?></td>
                                                <td class="text-center"><?php echo $producto['stock'] ?></td>
                                                <td class="text-center"><?php echo $producto['existencia'] ?></td>
                                                <td>

                                                    <button class=" btn btn-warning " type="button" data-toggle="modal" data-target="#modalActualizar" onclick="   seleccionarproducto(   '<?php echo $producto['id_producto'] ?>',
                                                                                '<?php echo $producto['nombre'] ?>',
                                                                                '<?php echo $producto['precio'] ?>',
                                                                                '<?php echo $producto['id_categoria'] ?>',
                                                                                '<?php echo $producto['imagen'] ?>',
                                                                                '<?php echo $producto['marca'] ?>',
                                                                                '<?php echo $producto['stock'] ?>',
                                                                                '<?php echo $producto['existencia'] ?>'
                                                                            )">

                                                        <i class='far fa-edit'></i>
                                                    </button>

                                                </td>
                                                <td>
                                                    <form method="POST">
                                                        <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto'] ?>">
                                                        <button class=" btn btn-danger " type="submit">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>


                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <!-- Fin tabla productos -->


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>



            <!-- Ventana modal Actualizar INICIO -->
            <div id="modalActualizar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Actualizar producto" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="my-modal-title">Editar producto</h4>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="post" onsubmit="onEnviar2()">

                                <?php echo $mensaje; ?>

                                <div class="row">

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <input class="form-control" type="hidden" name="id_producto" id="Id">
                                            <label for="nombre">Nombre</label>
                                            <input class="form-control" type="text" name="nombre" id="nombre"  required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                            <input class="form-control" type="text" name="precio" id="precio" onkeypress='return validaNumeros(event)' required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="categoria">Categoria</label>
                                            <select name="categoria" id="categoria" class="form-control" pattern="^[A-Za-z\u00f1\u00d1 ]+$" requiered>

                                                <option value="1">cereales</option>
                                                <option value="2">atunes</option>
                                                <option value="3">pastas</option>
                                                <option value="4">lacteos</option>
                                                <option value="5">bebidas</option>
                                                <option value="6">frutas</option>
                                                <option value="7">verduras</option>
                                                <option value="8">aseo</option>
                                                <option value="9">carnes</option>
                                                <option value="10">confiterias y golosinas</option>
                                                <option value="11">condimentos y sazonadores</option>
                                                <option value="12">harinas</option>
                                                <option value="13">bebidas alcoholicas</option>
                                                <option value="14">bebes</option>
                                                <option value="15">salsas</option>
                                                <option value="16">cuidado personal</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="correo">Imagen</label>
                                            <input class="form-control" type="text" name="imagen" id="imagen" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="marca">Marca</label>
                                            <input class="form-control" type="text" name="marca" id="marca" pattern="^[A-Za-z\u00f1\u00d1 ]+$" onkeypress="return validarTexto()" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input class="form-control" type="text" name="stock" id="stock" onkeypress='return validaNumeros(event)' required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="existencia">Existencia</label>
                                            <input class="form-control" type="text" name="existencia" id="existencia" onkeypress='return validaNumeros(event)' required>
                                        </div>
                                    </div>
                                </div>
                                <input class="form-control" type="hidden" name="accion" id="accion" value="1">


                                <button type="submit" class="btn btn-primary btn-lg btn-block">Actualizar</button>

                            </form>

                        </div>
                        <div class="modal-footer">

                            <button class="btn btn-danger" type="button" data-dismiss="modal">
                                Cancelar
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <!--   modalActualizar FIN -->

            <!--  modal Registrar INICIO -->
            <div id="modalRegistrar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Registrar producto" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="my-modal-title">Registrar producto</h4>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="post" onsubmit="onEnviar2()">

                                <?php echo $mensaje; ?>

                                <div class="row">

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <input class="form-control" type="hidden" name="id_producto" id="Id">
                                            <label for="nombre">Nombre</label>
                                            <input class="form-control" type="text" name="nombre" id="nombre" pattern="^[A-Za-z\u00f1\u00d1 ]+$" onkeypress="return validarTexto()" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                            <input class="form-control" type="text" name="precio" id="precio" onkeypress='return validaNumeros(event)' required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="categoria">Categoria</label>
                                            <select name="categoria" id="categoria" class="form-control" pattern="^[A-Za-z\u00f1\u00d1 ]+$" requiered>
                                                <option value="0">--seleccione--</option>
                                                <option value="1">cereales</option>
                                                <option value="2">atunes</option>
                                                <option value="3">pastas</option>
                                                <option value="4">lacteos</option>
                                                <option value="5">bebidas</option>
                                                <option value="6">frutas</option>
                                                <option value="7">verduras</option>
                                                <option value="8">aseo</option>
                                                <option value="9">carnes</option>
                                                <option value="10">confiterias y golosinas</option>
                                                <option value="11">condimentos y sazonadores</option>
                                                <option value="12">harinas</option>
                                                <option value="13">bebidas alcoholicas</option>
                                                <option value="14">bebes</option>
                                                <option value="15">salsas</option>
                                                <option value="16">cuidado personal</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="correo">Imagen</label>
                                            <input class="form-control" type="text" name="imagen" id="imagen" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="marca">Marca</label>
                                            <input class="form-control" type="text" name="marca" id="marca" pattern="^[A-Za-z\u00f1\u00d1 ]+$" onkeypress="return validarTexto()" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input class="form-control" type="text" name="stock" id="stock" onkeypress='return validaNumeros(event)' required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="existencia">Existencia</label>
                                            <input class="form-control" type="text" name="existencia" id="existencia" onkeypress='return validaNumeros(event)' required>
                                        </div>
                                    </div>
                                </div>
                                <input class="form-control" type="hidden" name="accion" id="accion" value="2">


                                <button type="submit" class="btn btn-primary btn-lg btn-block">Registrar</button>

                            </form>

                        </div>
                        <div class="modal-footer">

                            <button class="btn btn-danger" type="button" data-dismiss="modal">
                                Cancelar
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Ventana modal FIN -->


        </div>
        <!-- fin contenido Principal -->

        <?php include "plantilla/piepagina.php" ?>

        <script>
            $(function() {
                $("#tablaproductos").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["excel", "pdf"]                    
                }).buttons().container().appendTo('#tablaproductos_wrapper .col-md-6:eq(0)');

            });
        </script>
    </div>
</body>

</html>