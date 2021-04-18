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

require_once "../control/CtrlPersonas.php";
$mensaje = "";

$controlpersona = new CtrlPersonas();
$personas = $controlpersona->listaPersonas();


if (
    !empty($_POST['nombres'])
    || !empty($_POST['apellidos'])
    || !empty($_POST['cod'])
    || !empty($_POST['num_doc'])
    || !empty($_POST['correo'])
    || !empty($_POST['telefono'])
    || !empty($_POST['direccion'])
    || !empty($_POST['accion'])

) {
    $id = $_POST['cod'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $num_doc = $_POST['num_doc'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion'];

    $accion = $_POST['accion'];
    //echo  "<script>alert('$id,$nombres,$apellidos,$num_doc,$direccion,$celular,$correo,$accion')</script>";

    if ($accion == 1) {
        echo $accion;

        $actualizar = $controlpersona->actualizarPersona($id, $nombres, $apellidos, $num_doc, $direccion, $celular, $correo);

        if (!$actualizar) {
            header("location:personas.php");
        } else {
            echo "<script>alert('Error al actualizar persona')</script>";
        }
    } else {
        $registrar = $controlpersona->insertarPersona($nombres, $apellidos, $num_doc, $direccion, $celular, $correo);
        if ($registrar) {
            header("location:personas.php");
        } else {
            echo "<script>alert('Error al registrar persona')</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<title>Gestion Personas</title>
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
                <h1 class="display-4 text-center">Gestion Personas</h1>

                <div class="row">

                    <div class="col-12">

                        <!-- /.card -->
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">

                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalRegistrar" style="font-size:15px">
                                    NUEVO <i class='fas fa-user-plus'></i>
                                </button>

                                <br><br>
                                <!-- Inicio Tabla -->
                                <table id="tablapersonas" class="table table-striped table-bordered ">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Identificaion</th>
                                            <th>Direccion</th>
                                            <th>Celular</th>
                                            <th>Correo</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($personas as $persona) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $persona['id_persona'] ?></td>
                                                <td class="text-center"><?php echo $persona['nombres'] ?></td>
                                                <td class="text-center"><?php echo $persona['apellidos'] ?></td>
                                                <td class="text-center"><?php echo $persona['nro_identificacion'] ?></td>
                                                <td class="text-center"><?php echo $persona['direccion'] ?></td>
                                                <td class="text-center"><?php echo $persona['celular'] ?></td>
                                                <td class="text-center"><?php echo $persona['correo'] ?></td>
                                                <td class="text-center">

                                                    <button class=" btn btn-warning " type="button" data-toggle="modal" data-target="#modalActualizar" onclick="   seleccionar(   '<?php echo $persona['id_persona'] ?>',
                                                                                '<?php echo $persona['nombres'] ?>',
                                                                                '<?php echo $persona['apellidos'] ?>',
                                                                                '<?php echo $persona['nro_identificacion'] ?>',
                                                                                '<?php echo $persona['correo'] ?>',
                                                                                '<?php echo $persona['celular'] ?>',
                                                                                '<?php echo $persona['direccion'] ?>'
                                                                            )">

                                                        <i class='far fa-edit'></i>
                                                    </button>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>


                                <!-- Fin tabla -->

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
            <div id="modalActualizar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Editar Persona" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="my-modal-title">Editar Persona</h4>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="post" onsubmit="onEnviar()">

                                <?php echo $mensaje; ?>

                                <div class="row">

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <input class="form-control" type="hidden" name="cod" id="cod">
                                            <label for="nombres">Nombres</label>
                                            <input class="form-control" type="text" name="nombres" id="nombres" pattern="^[A-Za-z ]+$" required onkeypress="return validarTexto()">
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
                                            <label for="num_doc">Nro. Documento</label>
                                            <input class="form-control" type="text" name="num_doc" id="num_doc" onkeypress='return validaNumeros(event)' required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="correo">Correo</label>
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
                                            <label for="direccion">Direccion</label>
                                            <input class="form-control" type="text" name="direccion" id="direccion" required>
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
            <!-- Ventana modal FIN -->

            <!-- Ventana modal Registrar INICIO -->
            <div id="modalRegistrar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Editar Persona" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="my-modal-title">Registrar Persona</h4>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="post" onsubmit="onEnviar()">

                                <?php echo $mensaje; ?>

                                <div class="row">

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <input class="form-control" type="hidden" name="cod" id="cod">
                                            <label for="nombres">Nombres<b>*</b></label>
                                            <input class="form-control" type="text" name="nombres" id="nombres" pattern="^[A-Za-z ]+$" required onkeypress="return validarTexto()">
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
                $("#tablapersonas").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["excel", "pdf"]
                }).buttons().container().appendTo('#tablapersonas_wrapper .col-md-6:eq(0)');

            });
        </script>
    </div>
</body>

</html>