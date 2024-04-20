<?php
    class UsuarioServicio{
        protected $usuarioRepositorio;

        public function __construct(UsuarioInterfaz $usuarioRepositorio) {
            $this->usuarioRepositorio = $usuarioRepositorio;
        }

        public function registrar(Usuario $usuario) {
            try {
                $this->usuarioRepositorio->guardar($usuario);
                return true; 
            } catch (Exception $e) {
                return $e;
            }
        }


        public function verificarMonto(Usuario $usuario,float $monto){
            if ($usuario->getSaldo() >= $monto) {
                return true;
            }
        }
        
    }
?>