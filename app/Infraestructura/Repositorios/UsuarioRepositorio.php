<?php
    require_once __DIR__ . '/../../Dominio/Interfaces/UsuarioInterfaz.php';

    class UsuarioRepositorio implements UsuarioInterfaz {
        protected $conexion;

        public function __construct(mysqli $conexion) {
            $this->conexion = $conexion;
        }

        public function guardar(Usuario $usuario) {
            $nombre = $usuario->getNombre();
            $dni = $usuario->getDni();
            $email = $usuario->getEmail();
            $clave = $usuario->getClave();
            $tipo = $usuario->getTipo();
            $saldo = $usuario->getSaldo();

            $sql = "INSERT INTO Usuarios (nombre_completo,documento_identidad,correo_electronico,clave,tipo_usuario,saldo) VALUES ('$nombre','$dni','$email','$clave','$tipo',$saldo)";
            if ($this->conexion->query($sql) == TRUE) {
                echo "Nuevo registro insertado correctamente";
            } else {
                echo "Error: ".$this->conexion->error;
            }

        }
    }
?>