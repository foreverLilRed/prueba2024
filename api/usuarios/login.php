<?php

require_once __DIR__ . '/../../app/Dominio/Entidades/Usuario.php';
require_once __DIR__ . '/../../app/Dominio/Servicios/UsuarioServicio.php';
require_once __DIR__ . '/../../app/Infraestructura/Repositorios/UsuarioRepositorio.php';
require_once __DIR__ . '/../../conexion.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($data === null) {
        http_response_code(400); 
        echo json_encode(array("mensaje" => "Error en el formato JSON"));
        exit;
    }

    $nombre = $data['nombre'];
    $documento_identidad = $data['documento_identidad'];
    $correo_electronico = $data['correo_electronico'];
    $clave = $data['clave'];
    $tipo_usuario = $data['tipo_usuario'];
    $saldo = $data['saldo'];

    $usuario = new Usuario(null, $nombre, $documento_identidad, $correo_electronico, $clave, $tipo_usuario, $saldo);

    $repositorio = new UsuarioRepositorio($conexion);
    $usuarioServicio = new UsuarioServicio($repositorio);

    $usuarioServicio->registrar($usuario);
} else {
    http_response_code(405);
    echo json_encode(array("mensaje" => "Método no permitido"));
}
