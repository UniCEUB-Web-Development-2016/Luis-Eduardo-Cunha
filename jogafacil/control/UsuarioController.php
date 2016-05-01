<?php

include_once "../model/Request.php";
include_once "../model/tb_usuario.php";
include_once "../database/DatabaseConnector.php";
class UsuarioController
{

    public function register($request)
    {
        $params = $request->get_params();

        $usuario = new tbUsuario($params["nme_usuario"],
            $params["sobrenome"],
            $params["email"],
            $params["senha"]);

        $db = new DatabaseConnector("localhost", "bd_redeSocial", "pgsql", "5432", "postgres", "luiseduardo93");
        $conn = $db->getConnection();


        return $conn->query($this->generateInsertQuery($usuario));
    }
    private function generateInsertQuery($usuario)
    {
        $query =  "INSERT INTO tb_usuario (nome_usuario, sobrenome_usuario, email_usuario,
                               senha) VALUES ('".$usuario->getNmeUsuario."','".
            $usuario->getSobrenome()."','".
            $usuario->getEmail()."','".
            $usuario->getSenha()."')";
        return $query;
    }
}