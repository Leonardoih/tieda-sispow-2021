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

require_once "../control/CtrlClientes.php";
require_once "../control/CtrlPersonas.php";

$ctrlpersona = new CtrlPersonas();
$ctrlcliente = new CtrlClientes();
$clientes = $ctrlcliente->listaClientes();

if (!empty($_POST['estado_cliente']) || !empty($_POST['cod_cliente'])) {
    $estado_cliente = $_POST['estado_cliente'];
    $id_cliente = $_POST['cod_cliente'];
    //echo "<script>alert('$id_cliente,$estado_cliente')</script>";

    $cambiarestado = $ctrlcliente->cambiarEstadoCliente($estado_cliente, $id_cliente);

    if ($cambiarestado) {
        header("location:clientes.php");
    }
} else {

    if (
        !empty($_POST['nombres'])
        || !empty($_POST['apellidos'])
        || !empty($_POST['cod'])
        || !empty($_POST['num_doc'])
        || !empty($_POST['correo'])
        || !empty($_POST['telefono'])
        || !empty($_POST['direccion'])
        || !empty($_POST['estado'])
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


        //echo "<script>alert('$id,$nombres,$apellidos,$num_doc,$direccion,$celular,$correo,$accion')</script>";


        if ($accion == 1) {
            echo $accion;

            $actualizar = $ctrlpersona->actualizarPersona($id, $nombres, $apellidos, $num_doc, $direccion, $celular, $correo);

            if (!$actualizar) {
                header("location:clientes.php");
            } else {
                echo "<script>alert('Error al actualizar persona')</script>";
            }
        } else {

            $usuario = $_POST['usuario'];
            $clave = md5($_POST['clave']);
            // validamos si la persona se encuentra registrada y el cliente no
            $persona = $ctrlpersona->buscarPersona($num_doc, $correo);
            $cliente = $ctrlcliente->buscarCliente($usuario);

            if ($persona) {
                //echo "existe persona <br><br><br>";
                $id_persona = $persona['id_persona'];
                //despues que encontramos la persona validar que no se encuentre registrado
                // el mismo nick de usuario
                if ($cliente) {
                    echo  "<script>alert('El nombre de usuario no se encuentra disponible') </script>";
                } else {
                    if ($ctrlcliente->insertarCliente($usuario, $clave, $id_persona)) {
                        echo "<script> alert('Registro Exito') </script>";
                        header("location:clientes.php");
                    }
                }
            } else 
        if ($cliente) {
                echo '<script> El Usuario O Identificacion ya se encuentran registrados </script>';
            } else {

                if ($id_persona = $ctrlpersona->insertarPersona($nombres, $apellidos, $num_doc, $direccion, $celular, $correo)) {
                    echo "<script>alert('persona registrada')</script>";
                    if ($ctrlcliente->insertarCliente($usuario, $clave, $id_persona)) {
                        $mensaje = "<script>alert('Registro Exitoso')</script>";
                        header("location:clientes.php");
                    }
                }
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<title>Gestion Clientes</title>
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
                <h1 class="display-4 text-center">Gestion Clientes</h1>

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
                                <table id="tablaclientes" class="table table-striped table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Identificacion</th>
                                            <th>Direccion</th>
                                            <th>Celular</th>
                                            <th>Correo</th>
                                            <th>Nick usuario</th>
                                            <th>Fecha registro</th>
                                            <th>Estado</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($clientes as $cliente) {
                                        ?>
                                            <tr>
                                                <td><?php echo $cliente['id_cliente'] ?></td>
                                                <td><?php echo $cliente['nombres'] ?></td>
                                                <td><?php echo $cliente['apellidos'] ?></td>
                                                <td><?php echo $cliente['nro_identificacion'] ?></td>
                                                <td><?php echo $cliente['direccion'] ?></td>
                                                <td><?php echo $cliente['celular'] ?></td>
                                                <td><?php echo $cliente['correo'] ?></td>
                                                <td><?php echo $cliente['nick_usuario'] ?></td>
                                                <td><?php echo $cliente['fecha_reg'] ?></td>
                                                <td width="2%">
                                                    <?php if ($cliente['estado'] == 1) {
                                                        echo "activo";
                                                    } else {
                                                        echo "inactivo";
                                                    }
                                                    ?>

                                                </td>
                                                <td>
                                                    <button class=" btn btn-warning " type="button" data-toggle="modal" data-target="#modalActualizar" onclick=" seleccionar('<?php echo $cliente['id_persona'] ?>',
                                                                                    '<?php echo $cliente['nombres'] ?>',
                                                                                    '<?php echo $cliente['apellidos'] ?>',
                                                                                    '<?php echo $cliente['nro_identificacion'] ?>',
                                                                                    '<?php echo $cliente['correo'] ?>',
                                                                                    '<?php echo $cliente['celular'] ?>',
                                                                                    '<?php echo $cliente['direccion'] ?>',
                                                                                    '<?php echo $cliente['estado'] ?>'
                                                                                    )">

                                                        <i class='far fa-edit'></i>
                                                    </button>

                                                </td>
                                                <td>
                                                    <button class=" btn btn-danger " type="button" data-toggle="modal" data-target="#modalEstado" onclick="seleccionarCliente(
                                                                    '<?php echo $cliente['id_cliente'] ?>',
                                                                    '<?php echo $cliente['estado'] ?>')">

                                                        <i class="fas fa-unlock-alt"></i>
                                                    </button>
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


            <!-- Ventana modal Actualizar INICIO -->
            <div id="modalActualizar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Editar Cliente" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="my-modal-title">Editar Cliente</h4>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="post" onsubmit="onEnviar()">



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

                                            <label for="num_doc">Nro. Documento</label>
                                            <input class="form-control" type="text" name="num_doc" id="num_doc" required onkeypress='return validaNumeros(event)'>
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
                                            <label for="direccion">Direccion<b>*</b></label>
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
                            <h4 class="modal-title" id="my-modal-title">Nuevo Cliente</h4>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="post" onsubmit="onEnviar()">


                                <div class="row">

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <input class="form-control" type="hidden" value="1" name="cod" id="cod">

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

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="usuario">Usuario<b>*</b></label>
                                            <input class="form-control" type="text" name="usuario" id="usuario" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="clave">Clave<b>*</b></label>
                                            <input class="form-control" type="password" name="clave" id="clave" required>
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


            <!-- Ventana modal cambiar estado INICIO -->
            <div id="modalEstado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Cambiar estado" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="my-modal-title">Activar o Inactivar Cliente</h4>
                            <button class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" onsubmit="onEnviarEstado()">

                                <div class="row">

                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="nombres">Id Cliente<b>*</b></label>
                                            <input class="form-control" type="text" name="cod_cliente" id="cod_cliente">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="estado">Estado</label>

                                            <select class="form-control" name="estado_cliente" id="estado_cliente">
                                                <option value="1">activo</option>
                                                <option value="0">inactivo</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>


                                <input class="form-control" type="hidden" name="accion" id="accion" value="3">

                                <button type="submit" class="btn btn-primary btn-lg btn-block">Cambiar Estado</button>

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
                $("#tablaclientes").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["excel", "pdf"]
                }).buttons().container().appendTo('#tablaclientes_wrapper .col-md-6:eq(0)');

            });
        </script>
    </div>
</body>

</html>