<?php

require_once __DIR__ . '/../../app/Dominio/Entidades/Transaccion.php';
require_once __DIR__ . '/../../app/Dominio/Servicios/TransaccionServicio.php';
require_once __DIR__ . '/../../app/Infraestructura/Repositorios/TransaccionRepositorio.php';
require_once __DIR__ . '/../../conexion.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($data === null) {
        http_response_code(400); 
        echo json_encode(array("mensaje" => "Error en el formato JSON"));
        exit;
    }

    $monto = $data['value'];
    $origen = $data['payer'];
    $destino = $data['payee'];

    $transaccion = new Transaccion($origen, $destino, $monto);

    $repositorio = new TransaccionRepositorio($conexion);
    $transferenciaServicio = new TransaccionServicio($repositorio);

    $estado = $transferenciaServicio->solicitarTransferencia($monto,$origen,$destino);
    echo $estado;


} else {
    http_response_code(405);
    echo json_encode(array("mensaje" => "Método no permitido"));
}
