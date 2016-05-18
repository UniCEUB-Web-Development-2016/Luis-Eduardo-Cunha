<?php

include_once "model/Request.php";
include_once "model/tb_partida.php";
include_once "database/DatabaseConnector.php";
class PartidaController
{
    private $requiredParameters = array('nome_partida','cep','horario','data');

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
            var_dump($partida);
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
        $result = $conn->query("SELECT nome_partida, cep, horario, data FROM tb_usuario WHERE ".$crit);

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
        if(!empty($_GET["id"]) && !empty($_GET["nome_partida"]) && !empty($_GET["cep"]) && !empty($_GET["horario"]) && !empty($_GET["data"])) {

            $name = addslashes(trim($_GET["nome_partida"]));
            $cep = addslashes(trim($_GET["cep"]));
            $horario= addslashes(trim($_GET["horario"]));
            $data = addslashes(trim($_GET["data"]));
            $id = addslashes(trim($_GET["id"]));

            $params = $request->get_params();
            //$db = new DatabaseConnector("localhost", "bd_redeSocial", "pgsql", "5432", "postgres", "luiseduardo93");
            $db = new DatabaseConnector("localhost", "redeSocial", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("UPDATE tb_partida SET nome_partida=:nome_partida, cep=:cep, horario=:horario, data=:data WHERE id=:id");
            $result->bindValue(":nome_partida", $name);
            $result->bindValue(":cep", $cep);
            $result->bindValue(":horario", $horario);
            $result->bindValue(":data", $data);
            $result->bindValue(":id", $id);
            $result->execute();
            if ($result->rowCount() > 0){
                echo "UsuÃ¡rio alterado com sucesso!";
            } else {
                echo "UsuÃ¡rio nÃ£o atualizado";
            }
        }
    }

    public function delete($request)
    {
        if (!empty($_GET["id"])){

            $id = addslashes(trim($_GET["id"]));

            $params = $request->get_params();
            //$db = new DatabaseConnector("localhost", "bd_redeSocial", "pgsql", "5432", "postgres", "luiseduardo93");
            $db = new DatabaseConnector("localhost", "redeSocial", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("DELETE FROM tb_partida WHERE id=?");
            $result->bindValue(1, $id);
            $result->execute();

            if ($result->rowCount() > 0){
                echo "UsuÃ¡rio deletado com sucesso!";
            } else {
                echo "UsuÃ¡rio nÃ£o deletado";
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