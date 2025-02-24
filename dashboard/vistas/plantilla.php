<?php
session_start();
$rutaInicio = ControladorGeneral::ctrRutaInicio();//Ruta al login o registro
$ruta = ControladorGeneral::ctrRutaApp();//Ruta dentro de dashboard
if(!isset($_SESSION["validarSesion"]))
	{
		echo '<script>
				window.location = "'.$rutaInicio.'login";
		 	 </script>';	 	
	 return;	 	 	
	}

	$item = "id";
	$valor = $_SESSION["idU"];
	$usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard :: EGP</title>
    
      <!-- Favicons -->
    <link href="favicon.png" rel="icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vistas/assets/css/bootstrap.css">
    <link rel="stylesheet" href="vistas/assets/css/style.css">

    <link rel="stylesheet" href="vistas/assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="vistas/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="vistas/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="vistas/assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="vistas/assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    
    <link rel="stylesheet" href="vistas/assets/css/app.css">

    <link href="https://fonts.googleapis.com/css?family=Lato:300|600" rel="stylesheet" type="text/css">
    <!-- SWEET ALERT 2 -->
    <!-- https://sweetalert2.github.io/ -->
    <script src="vistas/assets/js/plugins/sweetalert2.all.js"></script>
    <script src="vistas/assets/vendors/simple-datatables/simple-datatables.js"></script>
    <!-- DATATABLES -->
    <!-- https://datatables.net/examples/basic_init/zero_configuration.html -->
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<body>

	<div id="app">
		<?php
		include "plantillaPartes/menu.php";
		?>
		<div id="main">
			<?php
			include "plantillaPartes/header.php";

				/*=============================================
				Páginas del sitio
				=============================================*/
				if(isset($_GET["pagina"]))
				{
					if( $_GET["pagina"] == "inicio" ||
						$_GET["pagina"] == "turnos" ||
						$_GET["pagina"] == "turnoActual" ||
						$_GET["pagina"] == "turnosFinalizados" ||
						$_GET["pagina"] == "VerTurnoFinalizadoParadas" ||
						$_GET["pagina"] == "historial" ||
						$_GET["pagina"] == "departamentos" ||
						$_GET["pagina"] == "maquinas" ||
						$_GET["pagina"] == "perfil" ||
						$_GET["pagina"] == "usuarios" ||
						$_GET["pagina"] == "oee" ||
                        $_GET["pagina"] == "VisorPerdidas" ||
						$_GET["pagina"] == "soporte" ||
                        $_GET["pagina"] == "empresas" ||
                        $_GET["pagina"] == "recurso" ||
                        $_GET["pagina"] == "tipoParada" ||
                        $_GET["pagina"] == "productos" ||
                        $_GET["pagina"] == "actividades" ||
						$_GET["pagina"] == "salir")
						{
						    include "paginas/".$_GET["pagina"].".php";
                        }else{
                            include "paginas/error404.php";
                        }
				}else{
					include "paginas/inicio.php";
				}

			include "plantillaPartes/footer.php";
			?>
	 	</div>
    </div>

    <script src="vistas/assets/js/main.js"></script>
    
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="vistas/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vistas/assets/js/bootstrap.bundle.min.js"></script>
    <script src="vistas/assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="vistas/assets/js/pages/dashboard.js"></script>
    <script src="vistas/assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.0.1/progressbar.min.js"></script>

    <!-- Chart.js 3.9.1  -->
    <script type="text/javascript" src="vistas/assets/js/chart.js/dist/chart.js"></script>
    <script src="vistas/assets/js/Oee.js"></script>
    <script src="vistas/assets/js/VisorPerdidas.js"></script>
    <script src="vistas/assets/js/empresa.js"></script>
    <script src="vistas/assets/js/usuarios.js"></script>

    
 
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable({
                "language": {
                                "lengthMenu": "Mostrar _MENU_ registros por página",
                                "zeroRecords": "No se encontraron resultados en su búsqueda",
                                "searchPlaceholder": "Buscar registros",
                                "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
                                "infoEmpty": "No existen registros",
                                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                "search": "Buscar:",
                                "paginate": {
                                    "first": "Primero",
                                    "last": "Último",
                                    "next": "Siguiente",
                                    "previous": "Anterior"
                                },
                            }
            });
        } );
    </script>
    
</body>

</html>