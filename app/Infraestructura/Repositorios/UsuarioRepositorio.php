<?php

    require_once __DIR__ . '/../../Dominio/Interfaces/UsuarioInterfaz.php';
    require_once __DIR__ . '/../../Dominio/Entidades/Usuario.php';

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
                echo $this->conexion->insert_id;
            } else {
                echo "Error: ".$this->conexion->error;
            }

        }

        public function retornarUsuario(int $id){
            $sql = "SELECT * FROM Usuarios WHERE id = $id";

            $resultado = $this->conexion->query($sql);

            if ($resultado->num_rows > 0) {
                $datosUsuario = $resultado->fetch_assoc();
                $usuario = new Usuario($datosUsuario['id'], $datosUsuario['nombre_completo'], $datosUsuario['documento_identidad'], $datosUsuario['correo_electronico'], $datosUsuario['clave'], $datosUsuario['tipo_usuario'], $datosUsuario['saldo']);

                return $usuario;
            } else {
                return false;
            }

        }

    }
?>