<?php
    require_once __DIR__ . '/../../Dominio/Interfaces/TransaccionInterfaz.php';
    require_once __DIR__ . '/../../Dominio/Entidades/Usuario.php';

    class TransaccionRepositorio implements TransaccionInterfaz {
        protected $conexion;

        public function __construct(mysqli $conexion) {
            $this->conexion = $conexion;
        }

        public function buscarUsuario(int $id){
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

        public function transferir($monto,$origen,$destino){
            $sql = "INSERT INTO Transferencias (id_usuario_origen, id_usuario_destino, monto, estado) 
            VALUES ($origen,$destino, $monto, 'pendiente')";

            if ($this->conexion->query($sql)) {
                return 'Transferido correctamente';
            } else {
                return "Error al realizar la transacción: " . $this->conexion->error;
            }
        }

    }
?>