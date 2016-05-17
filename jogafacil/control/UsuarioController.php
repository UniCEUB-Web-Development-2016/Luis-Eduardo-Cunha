<?php

include_once "model/Request.php";
include_once "model/tb_usuario.php";
include_once "database/DatabaseConnector.php";
class UsuarioController
{
        private $requiredParameters = array('nme_usuario','sobrenome','email','senha');

    public function register($request)
    {
        $params = $request->get_params();
        if ($this->isValid($params)) {
        $usuario = new tbUsuario($params["nme_usuario"],
            $params["sobrenome"],
            $params["email"],
            $params["senha"]);

        //$db = new DatabaseConnector("localhost", "bd_redeSocial", "pgsql", "5432", "postgres", "luiseduardo93");
            $db = new DatabaseConnector("localhost", "redeSocial", "mysql", "", "root", "");
        $conn = $db->getConnection();


        return $conn->query($this->generateInsertQuery($usuario));
        } else {
            echo "Error 400: Bad Request";
        }
    }
    private function generateInsertQuery($usuario)
    {
        $query =  "INSERT INTO tb_usuario (nome_usuario, sobrenome_usuario, email_usuario, senha) VALUES ('".
            $usuario->getNmeUsuario()."','".
            $usuario->getSobrenome()."','".
            $usuario->getEmail()."','".
            $usuario->getSenha()."')";
            return $query;
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