<?php

require_once "controladores/general.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/gestionMaquinas.controlador.php";
require_once "controladores/gestionTurnos.controlador.php";
require_once "controladores/empresa.controlador.php";

require_once "modelos/general.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/gestionMaquinas.modelo.php";
require_once "modelos/gestionTurnos.modelo.php";
require_once "modelos/empresa.modelo.php";

//extensiones para generar PDF 
require_once "extensiones/vendor/autoload.php";


$plantilla = new ControladorGeneral();
$plantilla -> ctrPlantilla();