<?php

include_once "model/Request.php";
include_once "model/tb_partida.php";
include_once "database/DatabaseConnector.php";
class PartidaController
{
    private $requiredParameters = array('nome_partida','endereco','lat','longe','horario','data');

    public function register($request)
    {
        $params = $request->get_params();
        if ($this->isValid($params)) {
            $partida = new Partida($params["nome_partida"],
                $params["endereco"],
                $params["lat"],
                $params["longe"],
                $params["horario"],
                $params["data"]);

            //$db = new DatabaseConnector("localhost", "bd_redeSocial", "pgsql", "5432", "postgres", "luiseduardo93");
            $db = new DatabaseConnector("localhost", "redesocial", "mysql", "", "root", "");
            $conn = $db->getConnection();
             return $conn->query($this->generateInsertQuery($partida));
        } else {
            echo "Error 400: Bad Request";
        }
    }
    private function generateInsertQuery($partida)
    {

        $query =  "INSERT INTO tb_partida (nome_partida, endereco, lat, longe, horario, data ) VALUES ('".
            $partida->getNomePartida()."','".
            $partida->getEndereco()."','".
            $partida->getLat()."','".
            $partida->getLonge()."','".
            $partida->getHorario()."','".
            $partida->getData()."')";
        return $query;
    }

    public function search($request)
    {
        $params = $request->get_params();
        $crit = $this->generateCriteria($params);

        //$db = new DatabaseConnector("localhost", "bd_redeSocial", "pgsql", "5432", "postgres", "luiseduardo93");
        $db = new DatabaseConnector("localhost", "redesocial", "mysql", "", "root", "");
        $conn = $db->getConnection();

        $result = $conn->query("SELECT * FROM tb_partida");

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }



    private function generateCriteria($params)
    {
        $criteria = "";
        foreach($params as $key => $value)
        {
            if($value!=''){
            $criteria = $criteria.$key." LIKE '%".$value."%' OR ";
                }
        }
        return substr($criteria, 0, -4);
    }

    public function update($request)
    {
        $params = $request->get_params();
        if(!empty($params["nome_partida"]) && !empty($params["endereco"]) && !empty($params["lat"])
            && !empty($params["longe"]) && !empty($params["horario"]) && !empty($params["data"])) {

            $name = addslashes(trim($params["nome_partida"]));
            $endereco = addslashes(trim($params["endereco"]));
            $lat = addslashes(trim($params["lat"]));
            $longe = addslashes(trim($params["longe"]));
            $horario= addslashes(trim($params["horario"]));
            $data = addslashes(trim($params["data"]));



            //$db = new DatabaseConnector("localhost", "bd_redeSocial", "pgsql", "5432", "postgres", "luiseduardo93");
            $db = new DatabaseConnector("localhost", "redeSocial", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("UPDATE tb_partida SET nome_partida=:nome_partida, endereco=:endereco, lat=:lat, longe=:longe, horario=:horario, data=:data WHERE nome_partida=:name");
            $result->bindValue(":nome_partida", $name);
            $result->bindValue(":endereco", $endereco);
            $result->bindValue(":lat", $lat);
            $result->bindValue(":longe", $longe);
            $result->bindValue(":data", $data);

            $result->execute();
            if ($result->rowCount() > 0){
                echo "Partida alterado com sucesso!";
            } else {
                echo "Partida nÃ£o atualizado";
            }
        }
    }

    public function delete($request)
    {
        $params = $request->get_params();
            
            $db = new DatabaseConnector("localhost", "redeSocial", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("DELETE FROM tb_partida WHERE nome_partida = ?");
            $result->bindParam(1, $params['nome_partida']);
        $result->execute();
        return $result;
    }




    private function isValid($parameters)
    {
        $keys = array_keys($parameters);
        $diff1 = array_diff($keys, $this->requiredParameters);
        $diff2 = array_diff($this->requiredParameters, $keys);
        if (empty($diff2) && empty($diff1))
            return true;
        return false;
    }

}