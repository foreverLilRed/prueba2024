<?php
    class NotificacionServicio {
        public static function notificacionTransferencia($origen,$destino,$monto) {
            $url = 'https://run.mocky.io/v3/6839223e-cd6c-4615-817a-60e06d2b9c82';
            $respuesta = file_get_contents($url);
            $resultado = json_decode($respuesta, true);
    
            if (isset($resultado['message']) && $resultado['message'] === true) {
                return 'Notificación de transferencia enviada correctamente';
            } else {
                return 'Error al enviar la notificación';
            }
        }
    }
    
?>