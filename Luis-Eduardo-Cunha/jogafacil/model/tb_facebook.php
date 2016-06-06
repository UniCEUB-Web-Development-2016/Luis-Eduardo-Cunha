<?php
    class Facebook{
        var $nome;
        var $sobrenome;
        var $email;

        public function _construct($nme_usuario, $sobrenome, $email){
            self::setNmeUsuario($nme_usuario);
            self::setSobreNome($sobrenome);
            self::email($email);
        }
        public function getNmeUsuario(){
            return $this->nme_usuario;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getSobreNome(){
            return $this->sobrenome;
        }

    }