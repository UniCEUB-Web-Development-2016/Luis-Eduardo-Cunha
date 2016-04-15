<?php
    class Partida{
        var $nome_partida;
        var $cep;
        var $horario;
        var $data;

        public function __construct($nome_partida, $cep, $horario, $data){
            self::setNomePartida($nome_partida);
            self::setCep($cep);
            self::setHorario($horario);
            self::setData($data);
        }

        public function getNomePartida(){
            return $this->nome_partida;
        }
        public function setNomePartida($nome_partida){
            $this->nome_partida=$nome_partida;
        }
        public function getCep(){
            return $this->cep;
        }
        public function setCep($cep){
            $this->cep=$cep;
        }
        public function getHoario(){
            return $this->horario;
        }
        public function setHorario($horario){
            $this->horario=$horario;
        }
        public function getData(){
        return $this->data;
        }
        public function setData($data){
            $this->data=$data;
        }




    }