<?php
class Conexao{


    protected $host="localhost";
    protected $user="postgres";
    protected $senha="luiseduardo93";
    protected $database="bd_redeSocial";
    protected $conectar;
    protected $query;


    public function abrirConexao()
    {
        try {
        $this->conectar = new PDO("pgsql: dbname= $this->database; host= $this->host",
        $this->user, $this->senha);


        $this->conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    public function getConectar(){
        return $this->conectar;
    }

    public function fecharConexao(){
        @pg_close($this->conectar);
    }
    public function gravar($query){
      $query = pg_query($query);
        if ($query) {
            echo "Cadastrado no Joga Facil!";
        } else {
            echo "Não foi possível cadastrar, tente novamente.";
            echo "Dados sobre o erro:" . pg_error();
        }
    }
  }
?>