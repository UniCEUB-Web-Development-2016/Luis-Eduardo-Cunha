<?php

include "Usuario.php";

      $nome = $_POST["nome"];
      $data = $_POST["dataNasc"];
      $senha = $_POST["password"];
      $telefone = $_POST["telefone"];
      $sobrenome = $_POST["sobreNome"];
      $email = $_POST["email"];

    $txt = new Usuario();
    $txt ->salvar($nome,$data,$senha,$telefone,$sobrenome,$email);