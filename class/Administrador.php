<?php
require_once 'AdministradorDao.php';

class Administrador extends AdministradorDao
{
    protected $table = "administrador";
    private $id;
    private $matricula;
    private $nome;
    private $email;
    private $senha;
    private $dataRegistro;

    public function getTable()
    {
        return $this->table;
    }

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getMatricula()
    {
        return $this->matricula;
    }

    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = hash('MD5', $senha);
    }

    public function getDataRegistro()
    {
        return $this->dataRegistro;
    }

    public function setDataRegistro($dataRegistro)
    {
        $this->dataRegistro = $dataRegistro;
    }

    public function insert()
    {
        $sql = "INSERT INTO $this->table (matricula,
                                      nome,
                                      email,
                                      senha)
                                      VALUES (:matricula,
                                              :nome,
                                              :email,
                                              :senha)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam('matricula', $this->matricula);
        $stmt->bindParam('nome', $this->nome);
        $stmt->bindParam('email', $this->email);
        $stmt->bindParam('senha', $this->senha);
        return $stmt->execute();
    }

    public function update()
    {
        $sql = "UPDATE $this->table SET matricula = :matricula,
                                    nome = :nome,
                                    email = :email,
                                    senha = :senha
                                    WHERE id :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam('matricula', $this->matricula);
        $stmt->bindParam('nome', $this->nome);
        $stmt->bindParam('email', $this->email);
        $stmt->bindParam('senha', $this->senha);
        $stmt->bindParam('id', $this->id);
        return $stmt->execute();
    }

    public function autenticar()
    {
        $sql = "SELECT nome, email, senha FROM $this->table WHERE email = :email AND senha = :senha";
        $stmt = DB::prepare($sql);
        $stmt->bindParam('email', $this->email);
        $stmt->bindParam('senha', $this->senha);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($resultado) <= 0) {
            return false;
        } else {
            return true;
        }
    }
}
