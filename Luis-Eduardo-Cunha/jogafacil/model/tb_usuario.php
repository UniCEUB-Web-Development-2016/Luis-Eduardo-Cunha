<?php
    Class tbUsuario{

        var $nme_usuario;
        var $sobrenome;
        var $senha;
        var $email;

        public function _construct($nme_usuario, $sobrenome, $senha, $email){
            self::setNmeUsuario($nme_usuario);
            self::setSobreNome($sobrenome);
            self::setSenha($senha);
            self::email($email);
        }
        public function getNmeUsuario(){
        return $this->nme_usuario;
    }
        public function setNmeUsuario($nme_usuario){
            $this->nme_usuario=$nme_usuario;
        }
        public function getNSenha(){
            return $this->senha;
        }
        public function setSenha($senha){
            $this->senha=$senha;
        }
        public function getEmail(){
            return $this->email;
        }
        public function setEmail($email){
            $this->email=$email;
        }
        public function getSobreNome(){
            return $this->sobrenome;
        }
        public function setSobreNome($sobrenome){
            $this->sobrenome=$sobrenome;
        }
    }