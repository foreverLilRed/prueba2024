<?php
    $host = 'prueba2024-db-1'; 
    $usuario = 'bd-user'; 
    $contraseña = '2024'; 
    $nombre_base_de_datos = 'bd-prueba2024'; 
    
    $conexion = new mysqli($host, $usuario, $contraseña, $nombre_base_de_datos);

    if ($conexion->connect_error) {
        die("Error al conectar a la base de datos: " . $conexion->connect_error);
    }
    
?>
