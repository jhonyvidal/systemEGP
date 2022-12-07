<div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="inicio"><span class="logoUno">EG</span><span class="logoDos">P</span></a>
                            <!--  <a href="inicio"><img src="vistas/assets/images/logo/logo-Energine-Automation-VBA.png" alt="Logo" srcset=""></a> -->
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="inicio" class='sidebar-link'>
                                <i class="bi bi-house"></i>
                                <span>Inicio</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="turnos" class='sidebar-link'>
                                <i class="bi bi-plus-square-dotted"></i>
                                <span>Turnos</span>
                            </a>
                        </li>
                        
                         <li class="sidebar-item">
                            <a href="turnosFinalizados" class='sidebar-link'>
                                <i class="bi bi-x-square"></i>
                                <span>Turnos finalizados</span>
                            </a>
                        </li>

                         <li class="sidebar-item">
                            <a href="departamentos" class='sidebar-link'>
                                <i class="bi bi-intersect"></i>
                                <span>Departamentos</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="perfil" class='sidebar-link'>
                                <i class="bi bi-person-circle"></i>
                                <span>Perfil</span>
                            </a>
                        </li>

                        <?php if($usuario["rol"] == "admin") { ?>
                            <li class="sidebar-item">
                            <a href="oee" class='sidebar-link'>
                                <i class="bi bi-person-plus-fill"></i>
                                <span>OEE</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="usuarios" class='sidebar-link'>
                                <i class="bi bi-person-plus-fill"></i>
                                <span>Usuarios</span>
                            </a>
                        </li>
                         <?php } ?>

                        <!--<li class="sidebar-item">-->
                        <!--    <a href="soporte" class='sidebar-link'>-->
                        <!--        <i class="bi bi-life-preserver"></i>-->
                        <!--        <span>Soporte</span>-->
                        <!--    </a>-->
                        <!--</li>-->

                         <li class="sidebar-item">
                            <a href="salir" class='sidebar-link'>
                                <i class="bi bi-door-closed"></i>
                                <span>Salir</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>