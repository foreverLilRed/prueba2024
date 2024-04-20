<?php
    include 'conexion.php';

    $sql = "INSERT INTO Usuarios (nombre_completo, documento_identidad, correo_electronico, clave, tipo_usuario, saldo) 
        VALUES ('Juan Perez', '12345678', 'juan@example.com', 'secreta', 'comun', 356.00)";

    if ($conexion->query($sql) === TRUE) {
        echo "Nuevo registro insertado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    $conexion->close();
?>