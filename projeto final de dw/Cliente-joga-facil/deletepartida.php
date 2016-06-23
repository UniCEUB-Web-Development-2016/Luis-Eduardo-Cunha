<?php
include "FileManager.php";
include('httpful.phar');

$url= "http://localhost/jogafacil/partida/?nome_partida=".$_POST['nome_partida'];
$response = \Httpful\Request::get($url)->send();
$resposta = json_decode($response->body);
$variavel ='';
foreach($resposta as $value){
    $variavel = $value->nome_partida;
}
if($variavel == ''){
    header('location:deletarNaoExiste.html');

}else{
    $urll= "http://localhost/jogafacil/partida/?nome_partida=".$_POST['nome_partida'];
    $response = \Httpful\Request::delete($urll)->send();

    $fileManager= '';
    $urll="http://localhost/jogafacil/partida/nome_partida=''";
    $responsee = \Httpful\Request::get($urll)->send();

    $fileManager = new FileManager();

    $fileManager->write("pontos.json",$responsee);
    header('location:deletarPartidaFinal.html');
}





//





