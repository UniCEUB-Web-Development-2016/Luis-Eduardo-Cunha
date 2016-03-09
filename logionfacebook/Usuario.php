<?php
class Usuario{

public function salvar($nome,$data,$senha,$telefone,$sobrenome,$email){

    $arquivo = fopen('meuarquivo.txt','w');
    if ($arquivo == false) die('Não foi possível criar o arquivo.');
    $escreve = fwrite($arquivo, $nome);
    $escreve = fwrite($arquivo, $data);
    $escreve = fwrite($arquivo, $senha);
    $escreve = fwrite($arquivo, $telefone);
    $escreve = fwrite($arquivo, $sobrenome);
    $escreve = fwrite($arquivo, $email);
    fclose($arquivo);
}

}