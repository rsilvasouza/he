<?php
require_once 'CursoDao.php';

class Curso extends CursoDao
{
  protected $table = "curso";
  private $id;
  private $nome;
  private $sigla;
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

  public function getSigla()
  {
    return $this->sigla;
  }

  public function setSigla($sigla)
  {
    $this->sigla = $sigla;
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
    $sql = "INSERT INTO $this->table (nome, sigla)
            VALUES (:nome, :sigla)";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('sigla', $this->sigla);
    return $stmt->execute();
  }

  public function update()
  {
    $sql = "UPDATE $this->table SET nome = :nome,
                                    sigla = :sigla
                                    WHERE id =:id";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('sigla', $this->sigla);
    $stmt->bindParam('id', $this->id);
    return $stmt->execute();
  }
}
