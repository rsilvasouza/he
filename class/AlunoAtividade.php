<?php
require_once 'AlunoAtividade.php';

class AlunoAtividade extends AlunoAtividadeDao
{
  protected $table = "aluno_atividade";
  private $id;
  private $descricao;
  private $horas;
  private $dataAtividade;
  private $status;
  private $arquivo;
  private $dataRegistro;
  private $alunoId;
  private $atividadeId;
  private $administradorId;

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

  public function getDescricao()
  {
    return $this->descricao;
  }

  public function setDescricao($descricao)
  {
    $this->descricao = $descricao;
  }

  public function getHoras()
  {
    return $this->horas;
  }

  public function setHoras($horas)
  {
    $this->horas = $horas;
  }

  public function getDataAtividade()
  {
    return $this->dataAtividade;
  }

  public function setDataAtividade($dataAtividade)
  {
    $this->dataAtividade = $dataAtividade;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }

  public function getArquivo()
  {
    return $this->arquivo;
  }

  public function setArquivo($arquivo)
  {
    $this->arquivo = $arquivo;
  }

  public function getDataRegistro()
  {
    return $this->dataRegistro;
  }

  public function setDataRegistro($dataRegistro)
  {
    $this->dataRegistro = $dataRegistro;
  }

  public function getAlunoId()
  {
    return $this->alunoId;
  }

  public function setAlunoId($alunoId)
  {
    $this->alunoId = $alunoId;
  }

  public function getAtividadeId()
  {
    return $this->atividadeId;
  }

  public function setAtividadeId($atividadeId)
  {
    $this->atividadeId = $atividadeId;
  }

  public function getAdministradorId()
  {
    return $this->administradorId;
  }

  public function setAdministradorId($administradorId)
  {
    $this->administradorId = $administradorId;
  }

  public function insert()
  {
    $sql = "INSERT INTO $this->table (descricao, atividade_id, horas_registradas, data_atividade, arquivo, aluno_id)
            VALUES (:descricao,
                    :atividadeId,
                    :horasRegistradas,
                    :dataAtividade,
                    :arquivo,
                    :alunoId)";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('descricao', $this->descricao);
    $stmt->bindParam('atividadeId', $this->atividadeId);
    $stmt->bindParam('horasRegistradas', $this->horas);
    $stmt->bindParam('dataAtividade', $this->dataAtividade);
    $stmt->bindParam('arquivo', $this->arquivo);
    $stmt->bindParam('alunoId', $this->alunoId);
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

  public function situacao($status)
  {

    switch ($status) {
      case 0:
        return "Rejeitada";
        break;
      case 1:
        return "Aprovada";
        break;
      case -1:
        return "Cadastrada";
        break;
    }
  }
}
