<?php

    require_once __DIR__ . '/../../Infraestructura/Externos/AutorizacionServicio.php';
    class TransaccionServicio{
        protected $repositorio;
        protected $usuarioServicio;
        
        public function __construct(TransaccionInterfaz $repositorio, UsuarioInterfaz $usuarioServicio){
            $this->repositorio = $repositorio;
            $this->usuarioServicio = $usuarioServicio;
        }

        public function solicitarTransferencia($monto,$idOrigen,$idDestino){
            $respuesta = $this->verificarDisponibilidadTransferencia($monto,$idOrigen,$idDestino);
            if($respuesta){
                return $this->repositorio->transferir($monto,$idOrigen,$idDestino);
            } else{
                return $respuesta;
            }
        }

        public function verificarDisponibilidadTransferencia($monto,$idOrigen,$idDestino){
            if(AutorizacionServicio::autorizacionTransferencia()){
                $user = $this->usuarioServicio->retornarUsuario($idOrigen);
                $destino = $this->usuarioServicio->retornarUsuario($idDestino);
                if($user instanceof Comun && $destino instanceof Usuario){
                    if($this->verificarSaldo($user,$monto)){
                        return true;
                    } else {
                        return 'Saldo insuficiente';
                    }
                } else {
                    return 'El usuario no puede realizar transferencia o no existe el destino';
                }
            } else {
                return 'Servicio no disponible';
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