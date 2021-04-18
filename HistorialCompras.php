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

$CtrlVentas = new CtrlVentas();
$historial = $CtrlVentas->listaVentasCliente($id_cliente);

?>


<!doctype html>
<html lang="es">

<head>
  <?php include "plantilla/link.php" ?>
  <title>Historial Compras</title>
</head>

<body>

  <?php include 'plantilla/cabecera.php'; ?>
  <br><br>
  <h2 class="display-4 text-center">Historial Compras</h2>
  <br><br>

  <div class="container">
    <div class="table-responsive">

      <table id="tablacompras" class="table table-striped table-bordered">
        <thead class="text-center">
          <th>#</th>
          <th>Fecha Compra</th>
          <th>Metodo Pago</th>
          <th>Total</th>
          <th>Detalle</th>
        </thead>
        <tbody>
          <?php
          foreach ($historial as $venta) {
          ?>
            <tr>
              <td class="text-center"><?php echo $venta['id_venta'] ?></td>
              <td class="text-center"><?php echo $venta['fecha_venta'] ?></td>
              <td class="text-center"><?php echo $venta['metodo_pag'] ?></td>
              <td class="text-center">$<?php echo number_format($venta['total'],2,',','.') ?></td>

              <td width="10% text-center" align="center">

                <form action="factura/factura.php" method="POST">
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


  </div>


  <?php include 'plantilla/piepagina.php'; ?>
  <script>
    $(document).ready(function() {
      $('#tablacompras').DataTable({
        // "language": {
        //   "url": "cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        // }
      })
    });
  </script>



</body>

</html>