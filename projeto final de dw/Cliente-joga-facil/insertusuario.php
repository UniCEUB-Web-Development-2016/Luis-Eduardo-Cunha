<?php
// Point to where you downloaded the phar
include('httpful.phar');

$nome= str_replace(" ","%20",$_POST['nome_usuario']);

$sobrenome= str_replace(" ","%20",$_POST['sobrenome_usuario']);

$url= "http://localhost/jogafacil/usuario/?nome=".$nome
    ."&sobrenome=".$sobrenome
    ."&email=".$_POST['email']
    ."&senha=".$_POST['senha'];

$response = \Httpful\Request::post($url)->send();

$to = "jogafacil@jogafacil.com";
$assunto ="Confimando cadastro";
$messagem = "Bem vindo ao Joga Facil".$_POST['nome_usuario']
            ."<br /> Cadastro confirmado <br /> Logion".$_POST['email']
            ."<br /> Senha".$_POST['senha'];

$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$headers .= "From: \r\n".$_POST['email'];


header('location:cadastroUsuarioFinal.html');