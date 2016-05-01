<?php
    Class tbUsuario{

        private $nme_usuario;
        private $sobrenome;
        private $senha;
        private $email;

        public function _construct($nme_usuario, $sobrenome,$email, $senha){
            $this->nme_usuario = $nme_usuario;
            $this->sobrenome = $sobrenome;
            $this->email = $email;
            $this->senha = $senha;
        }
        public function getNmeUsuario(){
        return $this->nme_usuario;
    }
        public function setNmeUsuario($nme_usuario){
            $this->nme_usuario=$nme_usuario;
        }
        public function getSenha(){
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
        public function getSobrenome(){
            return $this->sobrenome;
        }
        public function setSobrenome($sobrenome){
            $this->sobrenome=$sobrenome;
        }

    }