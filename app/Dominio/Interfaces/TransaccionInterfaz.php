<?php
    interface TransaccionInterfaz{
        public function transferir(float $monto, int $origen, int $destino);
        public function buscarUsuario(int $id);
    }
?>