<?php

class AutorizacionServicio{
    public static function autorizacionTransferencia(): bool {

        $url = 'https://run.mocky.io/v3/1f94933c-353c-4ad1-a6a5-a1a5ce2a7abe';
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        
        if (isset($data['message']) && $data['message'] == 'Autorizado') {
            return true;
        } else {
            return false;
        }
    }

    public static function autorizacionNotificacion(): bool {
        $url = 'https://run.mocky.io/v3/6839223e-cd6c-4615-817a-60e06d2b9c82';
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
