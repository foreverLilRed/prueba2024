<?php
    class Usuario {
        protected $id;
        protected $nombre;
        protected $dni;
        protected $email;
        protected $clave;
        protected $tipo;
        protected $saldo;

        public function __construct($id, $nombre, $dni, $email, $clave, $tipo, $saldo = 0){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->dni = $dni;
            $this->email = $email;
            $this->clave = $clave;
            $this->tipo = $tipo;
            $this->saldo = $saldo;
        }

        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getDni(){
            return $this->dni;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getTipo(){
            return $this->tipo;
        }

        public function getClave(){
            return $this->clave;
        }

        public function getSaldo(){
            return $this->saldo;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setDni($dni){
            $this->dni = $dni;
        }

        public function setEmail($email){
            $this->email = $email;
        }
        public function setClave($clave){
            $this->clave = $clave;
        }

        public function setSaldo($saldo){
            $this->saldo = $saldo;
        }


    }
?>