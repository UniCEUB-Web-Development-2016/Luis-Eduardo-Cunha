<?php

include "../util/conexao.php";

$gravandoUsuario;

$gravar = new Conexao();
$a = $gravar->abrirConexao();

$b=$gravar->getConectar();

var_dump($b);

//$gravandoUsuario = "INSERT INTO 'tb_usuario' (nome_usuario,sobrenome_usuario, email_usuario,senha)
//VALUES ('".$_POST["nome"]."', '".$POST["sobrenome"]."', '".$POST["email"]."','".$POST["senha"]."')";
//$gravar->gravar($gravandoUsuario);
//$gravar->fecharConexao();

