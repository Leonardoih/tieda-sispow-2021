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
require_once "../control/CtrlVentas.php";
$ctrlventas = new CtrlVentas();
$ventas = $ctrlventas->listaVentas();

?>


<!DOCTYPE html>
<html lang="es">

<title>Gestion Ventas</title>
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
                <h1 class="display-4 text-center">Gestion Ventas</h1>

                <div class="row">

                    <div class="col-12">

                        <!-- /.card -->
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">

                                <br><br>
                                <table id="tablaventas" class="table table-striped table-bordered ">
                                    <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>id cliente</th>
                                            <th>Cliente</th>
                                            <th>Fecha venta</th>
                                            <th>Total</th>
                                            <th>Metodo Pago</th>
                                            <!-- <th>Detalle</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($ventas as $venta) {
                                        ?>
                                            <tr>
                                                <td><?php echo $venta['id_venta'] ?></td>
                                                <td><?php echo $venta['id_cliente'] ?></td>
                                                <td><?php echo $venta['nombres'] ?></td>
                                                <td><?php echo $venta['fecha_venta'] ?></td>
                                                <td><?php echo number_format($venta['total'],2,',','.') ?></td>
                                                <td><?php echo $venta['metodo_pag'] ?></td>
                                                <td width="8%">
                                                    <form action="../factura/factura.php" method="POST">
                                                        <input type="hidden" name="id_cliente" value="<?php echo $venta['id_cliente'] ?>">

                                                        <input type="hidden" name="id_venta" value="<?php echo $venta['id_venta'] ?>">
                                                        <button class=" btn btn-success " type="submit" <b>ver</b>
                                                            <i class='fas fa-eye'></i>
                                                        </button>

                                                    </form>

                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>




        </div>
        <!-- fin contenido Principal -->

        <?php include "plantilla/piepagina.php" ?>

        <script>
            $(function() {
                $("#tablaventas").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["excel", "pdf"]                    
                }).buttons().container().appendTo('#tablaventas_wrapper .col-md-6:eq(0)');

            });
        </script>
    </div>
</body>

</html>