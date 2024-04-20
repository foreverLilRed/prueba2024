<?php
    interface TransaccionInterfaz{
        public function transferir(float $monto, int $origen, int $destino);
    }
?>