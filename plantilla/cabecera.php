<header>
    <!-- menu de navegacion -->
    <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">

        <div class="container">


            <a href="index.php" class="navbar-brand">
                <!-- aqui va la imajen de la cabezera -->
                <img src="imagenes/logo2.jpg" alt="logo"></a>


            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#segundonav"><span class="navbar-toggler-icon"></span></button>




            <div class="collapse navbar-collapse " id="segundonav">
                <ul class="navbar-nav m-auto">
                    <!-- categorias -->
                    <li class="nav-item dropdown no-arrow">

                        <a class="nav-link dropdown-toggle" href="#" id="cateDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categorias
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>

                        </a>

                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in overflow-auto" aria-labelledby="cateDropdown"  style="height: 250px; overflow-y: scroll;">
                            <a class="dropdown-item" href="aseo.php">
                                Aseo
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="atunes.php">
                                Atunes
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="bebes.php">
                                Bebes
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="bebidas.php">
                                Bebidas
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="bebidas_alcoholicas.php">
                                Bebidas Alcoholicas
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="carnes.php">
                                Carnes
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="cereales.php">
                                Cereales
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="condimentos.php">
                                Condimentos
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="confiterias.php">
                                Confiterias
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="cuidado_personal.php">
                                Cuidado Personal
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="frutas.php">
                                Frutas
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="harinas.php">
                                Harinas
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="lacteos.php">
                                Lacteos
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="pastas.php">
                                Pastas
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="salsas.php">
                                Salsas
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="verduras.php">
                                Verduras
                            </a>
                        </div>
                    </li>
                    <!-- fin categorias -->



                    <li class="nav-item">
                        <a href="listaCarrito.php" class="nav-link">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                            Carrito(<?php echo (empty($_SESSION['carrito'])) ? 0 : count($_SESSION['carrito']); ?>)
                        </a>
                    </li>


                    <!-- Validar si existe un avariable de sesion login -->
                    <?php
                    if (!isset($_SESSION['login']) || empty($_SESSION['login'])) {
                        echo '<li class="nav-item"><a href="login.php" class="nav-link">Iniciar Sesion</a></li>';
                    } else {
                        $login = $_SESSION['login'];

                        echo '
                        
                        <li class="nav-item dropdown no-arrow">
                           
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ' . $login['nick'] . '
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                 <img class="img-profile rounded-circle" width="30px" src="imagenes/user.png">    
                            </a> 

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="ActualizarDatos.php">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Perfil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="HistorialCompras.php">
                                    <i class="fa fa-history text-gray-400"></i>
                                       
                                        Historial compras
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="cerrar_sesion.php"  >
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Cerrar Sesión
                                    </a>
                            </div>
                        </li>';
                    }
                    ?>






                </ul>
            </div>
        </div>

    </nav>
    <br><br>
</header>