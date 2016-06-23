<?php
class Usuario{

    var $nome;
    var $sobrenome;
    var $email;
    var $senha;

    public function __construct($nome, $sobrenome, $email, $senha){

        $this->setNome($nome);
        $this->setSobrenome($sobrenome);
        $this->setEmail($email);
        $this->setSenha($senha);
    }
    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome=$nome;
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