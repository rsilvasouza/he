<?php
require_once 'AtividadeDao.php';

class Atividade extends AtividadeDao
{
  protected $table = "atividade";
  private $id;
  private $nome;
  private $modo_comprovacao;
  private $maxHoras;
  private $dataRegistro;
  private $dimensao;

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

  public function getModo_comprovacao()
  {
    return $this->modo_comprovacao;
  }

  public function setModo_comprovacao($modo_comprovacao)
  {
    $this->modo_comprovacao = $modo_comprovacao;
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

  public function getDimensao()
  {
    return $this->dimensao;
  }

  public function setDimensao($dimensao)
  {
    $this->dimensao = $dimensao;
  }


  public function insert()
  {
    $sql = "INSERT INTO $this->table (nome, modo_comprovacao, max_horas, dimensao_id)
            VALUES (:nome, :modo_comprovacao, :maxHoras, :dimensao)";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('modo_comprovacao', $this->modo_comprovacao);
    $stmt->bindParam('maxHoras', $this->maxHoras);
    $stmt->bindParam('dimensao', $this->dimensao);
    return $stmt->execute();
  }

  public function update()
  {
    $sql = "UPDATE $this->table SET nome = :nome,
                                    modo_comprovacao = :modo_comprovacao,
                                    max_horas = :maxHoras, dimensao_id = :dimensao
                                    WHERE id =:id";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('modo_comprovacao', $this->modo_comprovacao);
    $stmt->bindParam('maxHoras', $this->maxHoras);
    $stmt->bindParam('dimensao', $this->dimensao);
    $stmt->bindParam('id', $this->id);
    return $stmt->execute();
  }
}
