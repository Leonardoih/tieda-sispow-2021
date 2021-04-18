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

?>

<!DOCTYPE html>
<html lang="es">
<!-- <link rel="stylesheet" href="relojcss/reloj.css"> -->
<link rel="stylesheet" href="relojcss/styles.css">
<title>Panel de Administracion</title>
<?php include "plantilla/cabecera.php" ?>


<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php include "plantilla/sidebar.php" ?>

    <!-- Contenido Principal -->

    <div class="content-wrapper">

      <div class="container-fluid">
        <br>
        <h1 class="display-1 text-center" style="font-family: Brush Script MT;   ">Bienvenido</h1>

        <div class="item row col-8">
          <div class="wrap">
            <div class="widget">
              <div class="fecha">
                <p id="diaSemana" class="diaSemana">Martes</p>
                <p id="dia" class="dia">27</p>
                <p>de </p>
                <p id="mes" class="mes">Octubre</p>
                <p>del </p>
                <p id="year" class="year">2015</p>
              </div>

              <div class="reloj">
                <p id="horas" class="horas">11</p>
                <p>:</p>
                <p id="minutos" class="minutos">48</p>
                <p>:</p>
                <div class="caja-segundos">
                  <p id="ampm" class="ampm">AM</p>
                  <p id="segundos" class="segundos">12</p>

                </div>
              </div>
            </div>
          </div>
        </div class="item">
        <div class="item row col-4">
          <div class="container_calendar">
            <div class="header_calendar">
              <h1 id="text_day">00</h1>
              <h5 id="text_month">Null</h5>
            </div>
            <div class="body_calendar">
              <div class="container_details">
                <div class="detail_1">
                  <div class="detail">
                    <div class="circle">
                      <div class="column"></div>
                    </div>
                  </div>
                  <div class="detail">
                    <div class="circle">
                      <div class="column"></div>
                    </div>
                  </div>
                </div>
                <div class="detail_2">
                  <div class="detail">
                    <div class="circle">
                      <div class="column"></div>
                    </div>
                  </div>
                  <div class="detail">
                    <div class="circle">
                      <div class="column"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="container_change_month">
                <button id="last_month">&lt;</button>
                <div>
                  <span id="text_month_02">Null</span>
                  <span id="text_year">0000</span>
                </div>
                <button id="next_month">&gt;</button>
              </div>
              <div class="container_weedays">
                <span class="week_days_item">DOM</span>
                <span class="week_days_item">LUN</span>
                <span class="week_days_item">MAR</span>
                <span class="week_days_item">MÍE</span>
                <span class="week_days_item">JUE</span>
                <span class="week_days_item">VIE</span>
                <span class="week_days_item">SÁB</span>
              </div>
              <div class="container_days">
                <span class="week_days_item item_day"></span>

              </div>
            </div>

          </div>
        </div class="item">
      </div>
      <!-- /.col -->
    </div>

    <!-- /.row -->
  </div>





  <?php include "plantilla/piepagina.php" ?>



</body>

</html>