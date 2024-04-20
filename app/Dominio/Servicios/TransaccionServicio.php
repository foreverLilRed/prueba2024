<?php
    class TransaccionServicio{
        protected $repositorio;
        
        public function __construct(TransaccionInterfaz $repositorio){
            $this->repositorio = $repositorio;
        }

        public function transferir(){
            $this->repositorio->verificar();
        }
    }
?>