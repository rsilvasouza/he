<?php
require_once 'AlunoAtividade.php';

class AlunoAtividade extends AlunoAtividadeDao
{
  protected $table = "aluno_atividade";
  private $id;
  private $descricao;
  private $cargaHoraria;
  private $status;
  private $arquivo;
  private $dataInicial;
  private $dataFinal;
  private $observacao;
  private $motivo;
  private $alunoId;
  private $atividadeId;
  private $administradorId;
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

  public function getDescricao()
  {
    return $this->descricao;
  }

  public function setDescricao($descricao)
  {
    $this->descricao = $descricao;
  }

  public function getCargaHoraria()
  {
    return $this->cargaHoraria;
  }

  public function setCargaHoraria($cargaHoraria)
  {
    $this->cargaHoraria = $cargaHoraria;
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

  public function getDataInicial()
  {
    return $this->dataInicial;
  }

  public function setDataInicial($dataInicial)
  {
    $this->dataInicial = $dataInicial;
  }

  public function getDataFinal()
  {
    return $this->dataFinal;
  }

  public function setDataFinal($dataFinal)
  {
    $this->dataFinal = $dataFinal;
  }

  public function getObservacao()
  {
    return $this->observacao;
  }

  public function setObservacao($observacao)
  {
    $this->observacao = $observacao;
  }

  public function getMotivo()
  {
    return $this->motivo;
  }

  public function setMotivo($motivo)
  {
    $this->motivo = $motivo;
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
    $sql = "INSERT INTO $this->table (descricao, atividade_id, carga_horaria, arquivo, data_inicial, data_final, aluno_id)
            VALUES (:descricao,
                    :atividadeId,
                    :cargaHoraria,
                    :arquivo,
                    :dataInicial,
                    :dataFinal,
                    :alunoId)";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('descricao', $this->descricao);
    $stmt->bindParam('atividadeId', $this->atividadeId);
    $stmt->bindParam('cargaHoraria', $this->cargaHoraria);
    $stmt->bindParam('arquivo', $this->arquivo);
    $stmt->bindParam('dataInicial', $this->dataInicial);
    $stmt->bindParam('dataFinal', $this->dataFinal);
    $stmt->bindParam('alunoId', $this->alunoId);
    return $stmt->execute();
  }

  public function update()
  {
    $sql = "UPDATE $this->table SET descricao = :descricao,
                                    atividade_id = :atividadeId,
                                    carga_horaria = :cargaHoraria,
                                    arquivo = :arquivo,
                                    data_inicial = :dataInicial,
                                    data_final = :dataFinal,
                                    aluno_id = :alunoId
                                    WHERE id =:id";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('descricao', $this->descricao);
    $stmt->bindParam('atividadeId', $this->atividadeId);
    $stmt->bindParam('cargaHoraria', $this->cargaHoraria);
    $stmt->bindParam('arquivo', $this->arquivo);
    $stmt->bindParam('dataInicial', $this->dataInicial);
    $stmt->bindParam('dataFinal', $this->dataFinal);
    $stmt->bindParam('alunoId', $this->alunoId);
    $stmt->bindParam('id', $this->id);
                
    return $stmt->execute();
  }

  public function updateSemArquivo()
  {
    $sql = "UPDATE $this->table SET descricao = :descricao,
                                    atividade_id = :atividadeId,
                                    carga_horaria = :cargaHoraria,
                                    arquivo = :arquivo,
                                    data_inicial = :dataInicial,
                                    data_final = :dataFinal
                                    WHERE id =:id";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('descricao', $this->descricao);
    $stmt->bindParam('atividadeId', $this->atividadeId);
    $stmt->bindParam('cargaHoraria', $this->cargaHoraria);
    $stmt->bindParam('dataInicial', $this->dataInicial);
    $stmt->bindParam('dataFinal', $this->dataFinal);
    $stmt->bindParam('alunoId', $this->alunoId);
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
