<?php

require_once '../../extensiones/vendor/simplexlsxgen-master/src/SimpleXLSXGen.php';
require_once '../../controladores/gestionTurnos.controlador.php';
require_once '../../controladores/gestionMaquinas.controlador.php';
require_once '../../modelos/gestionTurnos.modelo.php';
require_once '../../modelos/general.modelo.php';


    function crearInforme(){

        $item = "idUsuario";
        $valor = $_GET["user"];
        $estado = 1;
        $op = 3;
        $turnos = ControladorGestionTurnos::ctrMostrarTurnosFinalizados($op, $item, $valor, $estado);

        $report=[];

        array_push($report, ['Id','Fecha','Hora Inicio','Hora Fin','Buenos','Malos',
            'Proceso','Recurso','Maquina',
            'UnidadesEsperadas', 'HorasProgramadas','Horas Paradas', 'Disponibilidad',  'Rendimiento', 'Calidad', 'Oee',
            'Parada','Actividad','Causa', 'Hora Inicio Parada' , 'Hora Fin Parada']);

        foreach ($turnos as $key => $value){
    
            $producto = ControladorGestionMaquinas::ctrMostrarProductoId($value['idProducto']);
            $unidadesEsperadas = $producto['velocidad'];
            $horasProgramadas = 24;

            $item = "idTurno"; 
            $valor = $value["id"];
            $total = ControladorGestionTurnos::ctrTotalParadasTurno($item, $valor);
            $paradas = ControladorGestionTurnos::ctrMostrarParadasTurnoActual($item, $valor);
            // $arrayParadas=''; $arrayActividad='';  $arrayTiempoParada='';

            $disponibilidad = round((1- (($total["Total"] / 60) / $horasProgramadas)) * 100,1); 
            $rendimiento = round((($value["pBuenos"] + $value["pMalos"]) / $unidadesEsperadas) * 100,2);
            $calidad = round($value["pMalos"] == 0 ? 100:(1-($value["pMalos"] / ($value["pBuenos"] + $value["pMalos"]))) * 100 ,1);
            $newOee =  round((1- (($total["Total"] / 60) / $horasProgramadas) * 
                    ((($value["pBuenos"] + $value["pMalos"]) / $unidadesEsperadas) * 
                    $value["pMalos"] !== 0 ? 1-($value["pMalos"] / ($value["pBuenos"] + $value["pMalos"])): 100)) * 100,2);
            // $oee = ((1440 - $total["Total"]) * 100) / 1440;

            // foreach ($paradas as $key => $value2){
            //     $arrayParadas = $arrayParadas . strval($key + 1)." " . $value2['nombreParada'] ." ";
            //     $arrayActividad = $arrayActividad . strval($key + 1)." " . $value2['de'] ." ";
            //     $arrayTiempoParada = $arrayTiempoParada . strval($key + 1)." " . $value2['horaInicioP'] ." - ". $value2['horaFinP'] ." ";
            // }
            $count = count($paradas) == 0 ? 1 : count($paradas);

            for($i=0;$i < $count;$i++){
                array_push($report, [ $value['id'], $value['fechaR'],$value['horaInicio'], $value['horaFin'], $value['pBuenos'],$value['pMalos'],
                $producto['proceso'],$producto['recurso'],$producto['nombre'],
                $unidadesEsperadas, $horasProgramadas, round($total["Total"]/60,2), $disponibilidad,  $rendimiento, $calidad, $newOee,
                count($paradas) !== 0 ? $paradas[$i]['nombreParada'] : '',    count($paradas) !== 0  ? $paradas[$i]['de'] : '' , count($paradas) !== 0  ? $paradas[$i]['nombreCausa'] : '',
                count($paradas) !== 0 ? $paradas[$i]['horaInicioP'] :'',
                count($paradas) !== 0 ? $paradas[$i]['horaFinP'] :'']);
            }
           
            //var_dump($report);
        }
        return $report;
    }
    //crearInforme();

    $xlsx = Shuchkin\SimpleXLSXGen::fromArray( crearInforme() );
    $xlsx->downloadAs('turnos.xlsx');


    