<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

require_once "../dashboard/controladores/gestionTurnos.controlador.php";
require_once "../dashboard/modelos/gestionTurnos.modelo.php";
//Get Headers
$requestHeaders = apache_request_headers();
$authorization  = $requestHeaders['Authorization'];
$code = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c3VJRCI6IjEiLCJwcm9JRCI6IjEiLCJuYmYiOjE2NTU1MzEyMzYsImV4cCI6MTY1NTUzNDgzNiwiaWF0IjoxNjU1NTMxMjM2fQ.xCf55WEh4HnTHxF26d-pidVVK9sRFh8hsaQ63rqQ_sI';
// get request method
$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input", true));

if($authorization == $code){
    if ($method == 'POST') {

        foreach ($data as $key => $value) {
            $request[$key] = $value;
        }

        $data = array("idTurno" => $request["idTurno"],
                        "horaI" => $request["horaI"],
                        "horaF" => $request["horaF"],
                        "idTParada" => $request["idTParada"]
        );
        try {
            $reponse = ControladorGestionTurnos::ctrApiCrearParadaMaquina($data);

            if($reponse){
                header('Content-Type: application/json');
                echo json_encode(array('success' => 'true','data' => "ok",'code'=>'200'));
                return; 
            }
        }catch (Error $e) {
            header('Content-Type: application/json');
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(array('success' => 'false','data' => $e,'code'=>'400'));
            return; 
        }
    }else{
        header('Content-Type: application/json');
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(array('success' => 'false','data' => 'Method not Authorizate','code'=>'400'));
        return; 
    }
}else{
    header('Content-Type: application/json');
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(array('success' => 'false','data' => 'Not Authorizate','code'=>'401'));
    return;
}

