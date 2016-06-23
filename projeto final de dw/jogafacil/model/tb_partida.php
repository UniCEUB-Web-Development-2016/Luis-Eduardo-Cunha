<?php
    class Partida{
        var $nome_partida;
        var $endereco;
        var $lat;
        var $longe;
        var $horario;
        var $data;


        public function __construct($nome_partida, $endereco, $lat, $longe, $horario, $data){
            self::setNomePartida($nome_partida);
            self::setEndereco($endereco);
            self::setLat($lat);
            self::setLonge($longe);
            self::setHorario($horario);
            self::setData($data);

        }
        public function getLat(){
            return $this->lat;
        }
        public function setLat($lat){
            $this->lat=$lat;
        }
        public function getLonge(){
            return $this->longe;
        }
        public function setLonge($longe){
            $this->longe=$longe;
        }

        public function getNomePartida(){
            return $this->nome_partida;
        }
        public function setNomePartida($nome_partida){
            $this->nome_partida=$nome_partida;
        }
        public function getEndereco(){
            return $this->endereco;
        }
        public function setEndereco($endereco){
            $this->endereco=$endereco;
        }
        public function getHorario(){
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