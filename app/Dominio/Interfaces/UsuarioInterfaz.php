<?php
    interface UsuarioInterfaz{
        public function guardar(Usuario $usuario);
        public function retornarUsuario(int $id);
    }
?>