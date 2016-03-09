<?php
class Usuario{

public function salvar($nome,$data,$senha,$telefone,$sobrenome,$email){

    $arquivo = fopen('meuarquivo.txt','w');
    if ($arquivo == false) die('Não foi possível criar o arquivo.');
     fwrite($arquivo, $nome.',');
     fwrite($arquivo, $data.',');
     fwrite($arquivo, $senha.',');
     fwrite($arquivo, $telefone.',');
     fwrite($arquivo, $sobrenome.',');
     fwrite($arquivo, $email);
     fclose($arquivo);
}

}