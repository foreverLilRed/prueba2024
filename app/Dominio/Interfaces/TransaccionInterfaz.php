<?php
    interface TransaccionInterfaz{
        public function transferir(float $monto, int $de, int $para) : void;
        public function verificar() : void ;
    }
?>