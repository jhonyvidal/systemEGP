<?php
/**
@grcarvajal grcarvajal@gmail.com **Gildardo Restrepo Carvajal**
20/04/2022 aplicación energine plataforma de destion de sensores
Inicio de la aplicación se inicializan los controladores y modelos y se redirige al inicio de la app
 */
require_once "controladores/general.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/gestionMaquinas.controlador.php";
require_once "controladores/gestionTurnos.controlador.php";

require_once "modelos/general.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/gestionMaquinas.modelo.php";
require_once "modelos/gestionTurnos.modelo.php";


//extensiones para generar PDF 
require_once "extensiones/vendor/autoload.php";


$plantilla = new ControladorGeneral();
$plantilla -> ctrPlantilla();