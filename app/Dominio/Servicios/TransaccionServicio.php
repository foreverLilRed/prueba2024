<?php
    class TransaccionServicio{
        protected $repositorio;
        
        public function __construct(TransaccionInterfaz $repositorio){
            $this->repositorio = $repositorio;
        }

        public function solicitarTransferencia($monto,$origen,$destino){
            $user = $this->repositorio->buscarUsuario($origen);
            if($user instanceof Usuario){
                if($user->getTipo() != 'comerciante'){
                    if($this->verificarSaldo($user,$monto)){
                        return $this->repositorio->transferir($monto,$origen,$destino);
                    } else {
                        return 'Saldo insuficiente';
                    }
                } else {
                    return 'El tipo comerciante no puede realizar transferencias';
                }
            } else{
                return 'No se encontro al usuario';
            }
        }

        public function verificarSaldo($usuario, $monto){
            if($usuario->getSaldo() >= $monto){
                return true;
            }
        }

    }
?>