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
            if($respuesta === true){
                return $this->repositorio->transferir($monto,$idOrigen,$idDestino);
            } else{
                return $respuesta;
            }
        }

        public function verificarDisponibilidadTransferencia($monto,$idOrigen,$idDestino){
            if(AutorizacionServicio::autorizacionTransferencia()){
                $user = $this->usuarioServicio->retornarUsuario($idOrigen);
                $destino = $this->usuarioServicio->retornarUsuario($idDestino);
                
                if($user !== false && $destino !== false && $user->getTipo() !== "comerciante"){
                    if($this->verificarSaldo($user, $monto)){
                        return true;
                    } else {
                        return 'Saldo insuficiente';
                    }
                } else {
                    return 'No existe o no puede hacer transacciones';
                }
            } else {
                return 'Error de autorización';
            }
        }
        public function verificarSaldo($usuario, $monto){
            if($usuario->getSaldo() >= $monto){
                return true;
            }
        }
        

    }
?>