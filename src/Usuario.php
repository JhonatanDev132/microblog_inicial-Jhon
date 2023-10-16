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

    // Ler usuário
    public function ler() : array {
        $sql = "SELECT id ,nome, email, tipo FROM usuarios ORDER BY nome";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao inserir usuário: ".$erro->getMessage());
        }

        return $resultado;
    }

    public function lerUm():array {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar: ".$erro->getMessage());
        }
    
        return $resultado;
    } 

    public function Atualizar() : void {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, tipo = :tipo WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindValue(":email", $this->email, PDO::PARAM_STR);
            $consulta->bindValue(":senha", $this->senha, PDO::PARAM_STR);
            $consulta->bindValue(":tipo", $this->tipo, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao atualizar usuaário: ".$erro->getMessage());
        }
    }
    // --------------------------------
    public function excluirUsuario() : void {
        $sql = "DELETE FROM usuarios WHERE id = :id";

        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao excluir: ".$erro->getMessage());
        }
    }
    // --------------------------------
    /* Método para codificação e comparação de senha */
    public function codificaSenha(string $senha):string {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    // --------------------------------
    public function verificaSenha(string $senhaDoFormulario, string $senhaBanco) : string {
        if(password_verify($senhaDoFormulario, $senhaBanco)){
            /* Se for igual mantém a mesma senha */
            return $senhaBanco;
        } else {
            /* Se forem Diferentes, então a nova senha (ou seja, a que foi difitada no formulário) DEVE ser codificada */
            return $this->codificaSenha($senhaDoFormulario);
        }
    }
    // --------------------------------
    
    public function getId(): int
    {
        return $this->id;
    }

   
    public function setId(int $id): void
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    }

    // --------------------------------

    public function getNome(): string
    {
        return $this->nome;
    }

    
    public function setNome(string $nome): void
    {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // --------------------------------
    public function getEmail(): string
    {
        return $this->email;
    }

    
    public function setEmail(string $email): void
    {
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
    }

   // ---------------------------------
    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): void
    {
        $this->senha = filter_var($senha, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // ---------------------------------
    public function getTipo(): string
    {
        return $this->tipo;
    }

   
    public function setTipo(string $tipo): void
    {
        $this->tipo = filter_var($tipo, FILTER_SANITIZE_SPECIAL_CHARS);
    }

   // -----------------------------------
    
}