<?php
namespace Microblog;
use PDO, Exception;
class Usuario{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $tipo;
    private PDO $conexao;
    
    public function __construct(){
        $this->conexao = Banco::conecta();
    }

    /* Métodos para rotina de CRUD mp Banco */

    // INSERT de usuário

    public function inserir(){
        $sql = "INSERT INTO usuarios(nome, email, senha, tipo) VALUES(:nome, :email, :senha, :tipo)";
        
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindValue(":email", $this->email, PDO::PARAM_STR);
            $consulta->bindValue(":senha", $this->senha, PDO::PARAM_STR);
            $consulta->bindValue(":tipo", $this->tipo, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir usuário: ".$erro->getMessage());
        }
    }

    // --------------------------------

    

    // --------------------------------
    
    public function getId(): int
    {
        return $this->id;
    }

   
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // --------------------------------

    public function getNome(): string
    {
        return $this->nome;
    }

    
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    // --------------------------------
    public function getEmail(): string
    {
        return $this->email;
    }

    
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

   // ---------------------------------
    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    // ---------------------------------
    public function getTipo(): string
    {
        return $this->tipo;
    }

   
    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

   // -----------------------------------
    
}