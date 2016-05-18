<?php

include_once "model/Request.php";
include_once "model/tb_partida.php";
include_once "database/DatabaseConnector.php";
class PartidaController
{
    private $requiredParameters = array('idt_partida','nome_partida','cep','horario','data');

    public function register($request)
    {
        $params = $request->get_params();
        if ($this->isValid($params)) {
            $partida = new Partida($params["nome_partida"],
                $params["cep"],
                $params["horario"],
                $params["data"]);

            //$db = new DatabaseConnector("localhost", "bd_redeSocial", "pgsql", "5432", "postgres", "luiseduardo93");
            $db = new DatabaseConnector("localhost", "redeSocial", "mysql", "", "root", "");
            $conn = $db->getConnection();
             return $conn->query($this->generateInsertQuery($partida));
        } else {
            echo "Error 400: Bad Request";
        }
    }
    private function generateInsertQuery($partida)
    {

        $query =  "INSERT INTO tb_partida (nome_partida, cep, horario, data) VALUES ('".
            $partida->getNomePartida()."','".
            $partida->getCep()."','".
            $partida->getHorario()."','".
            $partida->getData()."')";
        return $query;
    }

    public function search($request)
    {
        $params = $request->get_params();
        $crit = $this->generateCriteria($params);
        //$db = new DatabaseConnector("localhost", "bd_redeSocial", "pgsql", "5432", "postgres", "luiseduardo93");
        $db = new DatabaseConnector("localhost", "redeSocial", "mysql", "", "root", "");
        $conn = $db->getConnection();
        $result = $conn->query("SELECT nome_partida, cep, horario, data FROM tb_partida WHERE ".$crit);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }



    private function generateCriteria($params)
    {
        $criteria = "";
        foreach($params as $key => $value)
        {
            $criteria = $criteria.$key." LIKE '%".$value."%' OR ";
        }
        return substr($criteria, 0, -4);
    }

    public function update($request)
    {
        $params = $request->get_params();
        if(!empty($params["idt_partida"]) && !empty($params["nome_partida"]) && !empty($params["cep"]) && !empty($params["horario"]) && !empty($params["data"])) {

            $name = addslashes(trim($params["nome_partida"]));
            $cep = addslashes(trim($params["cep"]));
            $horario= addslashes(trim($params["horario"]));
            $data = addslashes(trim($params["data"]));
            $id = addslashes(trim($params["idt_partida"]));


            //$db = new DatabaseConnector("localhost", "bd_redeSocial", "pgsql", "5432", "postgres", "luiseduardo93");
            $db = new DatabaseConnector("localhost", "redeSocial", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("UPDATE tb_partida SET nome_partida=:nome_partida, cep=:cep, horario=:horario, data=:data WHERE idt_partida=:id");
            $result->bindValue(":nome_partida", $name);
            $result->bindValue(":cep", $cep);
            $result->bindValue(":horario", $horario);
            $result->bindValue(":data", $data);
            $result->bindValue(":id", $id);
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
        if (!empty($params["idt_partida"])){

            $id = addslashes(trim($params["idt_partida"]));

            //$db = new DatabaseConnector("localhost", "bd_redeSocial", "pgsql", "5432", "postgres", "luiseduardo93");
            $db = new DatabaseConnector("localhost", "redeSocial", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("DELETE FROM tb_partida WHERE idt_partida=?");
            $result->bindValue(1, $id);
            $result->execute();

            if ($result->rowCount() > 0){
                echo "Partida deletada com Sucesso!";
            } else {
                echo "Partida não deletada!";
            }
        }
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