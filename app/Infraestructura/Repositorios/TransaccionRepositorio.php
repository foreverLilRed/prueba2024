<?php
    require_once __DIR__ . '/../../Dominio/Interfaces/TransaccionInterfaz.php';
    require_once __DIR__ . '/../../Dominio/Entidades/Usuario.php';
    require_once __DIR__ . '/../../Infraestructura/Externos/AutorizacionServicio.php';

    class TransaccionRepositorio implements TransaccionInterfaz {
        protected $conexion;

        public function __construct(mysqli $conexion) {
            $this->conexion = $conexion;
        }


        public function transferir($monto,$origen,$destino){
            $sql = "INSERT INTO Transferencias (id_usuario_origen, id_usuario_destino, monto, estado) 
            VALUES ($origen,$destino, $monto, 'pendiente')";

            if ($this->conexion->query($sql)) {
                $this->marcarTransferenciaConcretada($this->obtenerUltimaTransferencia());
                $this->depositar($destino, $monto);
                $this->desembolsar($origen, $monto);
                return 'Transaccion realizada';
            } else {
                $error_message = "Error al realizar la transacción: " . $this->conexion->error;
                $this->revertirTransaccion($this->obtenerUltimaTransferencia(), $monto, $origen, $destino);
                return $error_message;
            }

        }

        public function depositar($id, $monto){

            $this->actualizarSaldo($id,$monto);
        }

        public function desembolsar($id, $monto){

            $this->actualizarSaldo($id,-$monto);
        }

        public function actualizarSaldo ($id, $valor){
            $sql = "UPDATE Usuarios SET saldo = saldo + $valor WHERE id = $id";
            $this->conexion->query($sql);
        }

        public function revertirTransaccion($id_transaccion, $monto, $id_origen, $id_destino) {
            $sql = "UPDATE Transferencias SET estado = 'revertido' WHERE id = $id_transaccion";
            $this->conexion->query($sql);
        
            $this->depositar($id_origen, $monto);
            $this->desembolsar($id_destino, $monto);
        }

        public function marcarTransferenciaConcretada($id_transaccion) {
            $sql = "UPDATE Transferencias SET estado = 'completo' WHERE id = $id_transaccion";
            $this->conexion->query($sql);
        }

        public function obtenerUltimaTransferencia(){
            $transferencia = $this->conexion->query("SELECT LAST_INSERT_ID()")->fetch_assoc();
            return $ultimo_id = $transferencia['LAST_INSERT_ID()'];
        }

    }
?>