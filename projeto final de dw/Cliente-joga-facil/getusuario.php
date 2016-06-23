<?php

// Point to where you downloaded the phar
include('httpful.phar');

$url= "http://localhost/jogafacil/usuario/?email=".$_POST['email']
    ."&senha=".$_POST['senha'];

$response = \Httpful\Request::get($url)->send();

$resposta = json_decode($response->body);
$variavel ='';
foreach($resposta as $value){
$variavel = $value->email;
}
if($variavel == ''){
        header('location:logionNot.html');


}else{
    header('location:home.html');
}

