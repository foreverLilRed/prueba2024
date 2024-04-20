<?php
    class TransaccionServicio{
        protected $repositorio;
        
        public function __construct(TransaccionInterfaz $repositorio){
            $this->repositorio = $repositorio;
        }

        public function solicitarTransferencia($monto,$origen,$destino){
            if($this->servicioExterno()){
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
            } else {
                return 'Error en autorizacion del servicio de transferencia';
            }
        }

        public function verificarSaldo($usuario, $monto){
            if($usuario->getSaldo() >= $monto){
                return true;
            }
        }

        public function servicioExterno() {
            $url = 'https://run.mocky.io/v3/1f94933c-353c-4ad1-a6a5-a1a5ce2a7abe';
            $response = file_get_contents($url);
            $data = json_decode($response, true);
        
            if (isset($data['message']) && $data['message'] == 'Autorizado') {
                return true;
            } else {
                return false;
            }
        }
        

    }
?>