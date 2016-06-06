<?php

include_once "model/Request.php";
include_once "model/Usuario.php";
include_once "database/DatabaseConnector.php";
class UsuarioController
{
        private $requiredParameters = array('idt_usuario','nome','sobrenome','email','senha');

    public function register($request)
    {
        $params = $request->get_params();
        if ($this->isValid($params)) {
            $usuario = new Usuario($params["nome"],
            $params["sobrenome"],
            $params["email"],
            $params["senha"]);

            //$db = new DatabaseConnector("localhost", "bd_redeSocial", "pgsql", "5432", "postgres", "luiseduardo93");
            $db = new DatabaseConnector("localhost", "redesocial", "mysql", "", "root", "");
            $conn = $db->getConnection();

            return $conn->query($this->generateInsertQuery($usuario));
        } else {

            echo "Error 400: Bad Request";
        }
    }
    private function generateInsertQuery($usuario)
    {
            $query =  "INSERT INTO tb_usuario (nome, sobrenome, email, senha) VALUES ('".
            $usuario->getNome()."','".
            $usuario->getSobrenome()."','".
            $usuario->getEmail()."','".
            $usuario->getSenha()."')";

            return $query;
    }

    public function search($request)
    {
        $params = $request->get_params();
        $crit = $this->generateCriteria($params);
        //$db = new DatabaseConnector("localhost", "bd_redeSocial", "pgsql", "5432", "postgres", "luiseduardo93");
        $db = new DatabaseConnector("localhost", "redeSocial", "mysql", "", "root", "");
        $conn = $db->getConnection();
        $result = $conn->query("SELECT nome, sobrenome, email, senha FROM tb_usuario WHERE ".$crit);

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
        if(!empty($params["idt_usuario"]) && !empty($params["nome"]) && !empty($params["sobrenome"]) && !empty($params["email"]) && !empty($params["senha"])) {

            $name = addslashes(trim($params["nome"]));
            $sobrenome = addslashes(trim($params["sobrenome"]));
            $email = addslashes(trim($params["email"]));
            $senha = addslashes(trim($params["senha"]));
            $id = addslashes(trim($params["id"]));

            $db = new DatabaseConnector("localhost", "redeSocial", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("UPDATE tb_usuario SET nome=:nome_usuario, sobrenome=:sobrenome_usuario, email=:email_usuario, senha=:senha WHERE idt_usuario=:id");
            $result->bindValue(":nome_usuario", $name);
            $result->bindValue(":sobrenome_usuario", $sobrenome);
            $result->bindValue(":email_usuario", $email);
            $result->bindValue(":senha", $senha);
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
        $params = $request->get_params();
        if (!empty($params["idt_usuario"])){

            $id = addslashes(trim($params["idt_partida"]));

            //$db = new DatabaseConnector("localhost", "bd_redeSocial", "pgsql", "5432", "postgres", "luiseduardo93");
            $db = new DatabaseConnector("localhost", "redeSocial", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("DELETE FROM tb_usuario WHERE idt_usuario = ?");
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