<?php
require_once 'DimensaoDao.php';

class Dimensao extends DimensaoDao
{
  protected $table = "dimensao";
  private $id;
  private $nome;
  private $max_horas;
  private $data_registro;
 
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

  public function getMax_horas()
  {
    return $this->max_horas;
  }

  public function setMax_horas($max_horas)
  {
    $this->max_horas = ($max_horas == '') ? '0' : $max_horas;
  }

  public function getData_registro()
  {
    return $this->data_registro;
  }

  public function setData_registro($data_registro)
  {
    $this->data_registro = $data_registro;
  }

  
  public function insert()
  {
    $sql = "INSERT INTO $this->table (nome, max_horas)
            VALUES (:nome, :max_horas)";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('max_horas', $this->max_horas);
    return $stmt->execute();
  }

  public function update()
  {
    $sql = "UPDATE $this->table SET nome = :nome,
                                    max_horas = :max_horas
                                    WHERE id =:id";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('max_horas', $this->max_horas);
    $stmt->bindParam('id', $this->id);
    return $stmt->execute();
  }
}
