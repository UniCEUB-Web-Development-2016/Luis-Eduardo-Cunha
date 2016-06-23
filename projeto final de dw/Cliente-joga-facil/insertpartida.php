<?php
include "FileManager.php";
include('httpful.phar');


$endereco = urlencode(utf8_encode($_POST['txtEndereco']));
$nome_partida = urlencode(utf8_encode($_POST['nome_partida']));
$url= "http://localhost/jogafacil/partida/?nome_partida=".$nome_partida
    ."&endereco=".$endereco
    ."&lat=".$_POST['txtLatitude']
    ."&longe=".$_POST['txtLongitude']
    ."&horario=".$_POST['horario']
    ."&data=".$_POST['data'];

$response = \Httpful\Request::post($url)->send();

$fileManager= '';
$urll="http://localhost/jogafacil/partida/nome_partida=''";
$responsee = \Httpful\Request::get($urll)->send();

$fileManager = new FileManager();

$fileManager->write("pontos.json",$responsee);



header('location:cadastroPartidaFinal.html');

//echo "<script>alert('Partida Cadastrada');</script>";





