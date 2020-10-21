<?php
require_once 'AtividadeDao.php';

class Atividade extends AtividadeDao
{
  protected $table = "atividade";
  private $id;
  private $nome;
  private $descricao;
  private $maxHoras;
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

  public function getNome()
  {
    return $this->nome;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }

  public function getDescricao()
  {
    return $this->descricao;
  }

  public function setDescricao($descricao)
  {
    $this->descricao = $descricao;
  }

  public function getMaxHoras()
  {
    return $this->maxHoras;
  }

  public function setMaxHoras($maxHoras)
  {
    $this->maxHoras = $maxHoras;
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
    $sql = "INSERT INTO $this->table (nome, descricao, max_horas)
            VALUES (:nome, :descricao, :maxHoras)";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('descricao', $this->descricao);
    $stmt->bindParam('maxHoras', $this->maxHoras);
    return $stmt->execute();
  }

  public function update()
  {
    $sql = "UPDATE $this->table SET nome = :nome,
                                    descricao = :descricao,
                                    max_horas = :maxHoras
                                    WHERE id =:id";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('descricao', $this->descricao);
    $stmt->bindParam('maxHoras', $this->maxHoras);
    $stmt->bindParam('id', $this->id);
    return $stmt->execute();
  }
}
