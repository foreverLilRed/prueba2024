<?php
    class Transaccion {
        protected $monto;
        protected $origen;
        protected $destino;

        public function __construct($monto,$origen,$destino){
            $this->monto = $monto;
            $this->origen = $origen;
            $this->destino = $destino;
        }

        public function getMonto(){
            return $this->monto;
        }
        public function getOrigen(){
            return $this->origen;
        }

        public function getDestino(){
            return $this->destino;
        }

    }
?>