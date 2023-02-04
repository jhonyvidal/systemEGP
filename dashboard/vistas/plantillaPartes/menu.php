<div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="inicio"><span class="logoUno">EG</span><span class="logoDos">P</span></a>
                            <!--  <a href="inicio"><img src="vistas/assets/images/logo/logo-Energine-Automation-VBA.png" alt="Logo" srcset=""></a> -->
                        </div>
                        <div class="toggler">
                            <!-- <a href="#" class="sidebar-hide d-block"><i class="bi bi-x bi-middle"></i></a> -->
                        </div>
                    </div>
                </div>
               
                <div class="sidebar-menu">
                  
                    <ul class="menu">
                        <hr>

                        <li class="sidebar-item">
                            <a href="inicio" class='sidebar-link'  data-bs-toggle="collapse" href="#collapseExample">
                                <i class="bi bi-house"></i>
                                <span>Inicio</span>
                            </a>
                        </li>

                        

                        <?php

                        if($_SESSION["rol"] == "admin"){
                         
                        echo    '<li class="sidebar-item">
                                    <a href="empresas" class="sidebar-link">
                                        <i class="bi bi-plus-square-dotted"></i>
                                        <span>Empresas</span>
                                    </a>
                                </li>'; 
                        }
                        
                        if($_SESSION["rol"] == "admin" || $_SESSION["rol"] == "empresa" || $_SESSION["rol"] == "generico"){
                         
                            echo '<li class="sidebar-item">
                                    <a class="sidebar-link" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="bi bi-plus-square-dotted"></i>
                                        <span>Turnos</span>
                                    </a>
                                    <div class="collapse" id="collapseExample">
                                    <div class="">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                            <li class="sidebar-item">
                                                <a href="turnos" class="sidebar-link">
                                                   
                                                    <span>Turnos</span>
                                                </a>
                                            </li>    
                                            <li class="sidebar-item">
                                                <a href="turnosFinalizados" class="sidebar-link">
                                                   
                                                    <span>Turnos finalizados</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>'; 
                        }


                        // if($_SESSION["rol"] == "admin" || $_SESSION["rol"] == "empresa"){
                         
                        //     echo ' <li class="sidebar-item">
                        //             <a href="departamentos" class="sidebar-link">
                        //                 <i class="bi bi-intersect"></i>
                        //                 <span>Departamentos</span>
                        //             </a>
                        //         </li>'; 
                        // }

                        if($_SESSION["rol"] == "admin" || $_SESSION["rol"] == "empresa"){
                         
                            echo ' <li class="sidebar-item">
                                    <a class="sidebar-link" data-bs-toggle="collapse" href="#collapseParametros" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="bi bi-intersect"></i>
                                        <span>Parametros</span>
                                    </a>
                                    <div class="collapse" id="collapseParametros">
                                    <div class="">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                            <li class="sidebar-item">
                                                <a href="recurso" class="sidebar-link">
                                                   
                                                    <span>Recursos</span>
                                                </a>
                                            </li>    
                                            <li class="sidebar-item">
                                                <a href="tipoParada" class="sidebar-link">
                                                    <span>Tipo Parada</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                   
                                </li>'; 
                        }


                        if($_SESSION["rol"] == "admin" || $_SESSION["rol"] == "empresa"  || $_SESSION["rol"] == "generico"){
                         
                            echo '  <li class="sidebar-item">
                                        <a href="perfil" class="sidebar-link">
                                            <i class="bi bi-person-circle"></i>
                                            <span>Perfil</span>
                                        </a>
                                    </li>'; 
                        }

                        if($_SESSION["rol"] == "admin" || $_SESSION["rol"] == "empresa"){
                         
                            echo '<li class="sidebar-item">
                                        <a href="VisorPerdidas" class="sidebar-link">
                                            <i class="bi bi-person-plus-fill"></i>
                                            <span>OEE</span>
                                        </a>
                                    </li>'; 
                        }


                        if($_SESSION["rol"] == "admin" || $_SESSION["rol"] == "empresa"){
                         
                            echo '  <li class="sidebar-item">
                                        <a href="usuarios" class="sidebar-link">
                                            <i class="bi bi-person-plus-fill"></i>
                                            <span>Usuarios</span>
                                        </a>
                                    </li>'; 
                        }
                        ?>
                        <hr>
                        <div class="dropdown">
                            <a href="#" class="sidebar-link d-flex align-items-center link-dark text-decoration-none dropdown-toggle show" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="true">
                                <img src="<?php echo $usuario["foto"]; ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                                <strong><?php echo $usuario["usuarioLink"]; ?></strong>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(0px, -34px, 0px);" data-popper-placement="top-start">
                                <li><a class="dropdown-item" href="perfil">
                                    <i class="bi bi-person-circle"></i>
                                    <span>Perfil</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="salir"> <i class="bi bi-door-closed"></i> <span>Salir</span></a></li>
                            </ul>
                        </div>

                         <!-- <li class="sidebar-item">
                            <a href="salir" class='sidebar-link'>
                                <i class="bi bi-door-closed"></i>
                                <span>Salir</span>
                            </a>
                        </li> -->

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>