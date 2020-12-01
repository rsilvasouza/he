<?php
require_once 'AlunoAtividadeDao.php';

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
  private $horaInicial;
  private $horaFinal;
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
    $this->cargaHoraria = (empty($cargaHoraria) ? '00:00' : $cargaHoraria);
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
    $this->dataInicial = (empty($dataInicial) ? date('Y-m-d') : $dataInicial);
  }

  public function getDataFinal()
  {
    return $this->dataFinal;
  }

  public function setDataFinal($dataFinal)
  {
    $this->dataFinal = (empty($dataFinal) ? $this->dataInicial : $dataFinal);
  }

  public function getHoraInicial()
  {
    return $this->horaInicial;
  }

  public function setHoraInicial($horaInicial)
  {
    
    $this->horaInicial = (empty($horaInicial) ? '00:00' : $horaInicial);
  }

  public function getHoraFinal()
  {
    return $this->horaFinal;
  }

  public function setHoraFinal($horaFinal)
  {
    $this->horaFinal = (empty($horaFinal) ? '00:00' : $horaFinal);
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
    $sql = "INSERT INTO $this->table (descricao, atividade_id, carga_horaria, arquivo, data_inicial, data_final, aluno_id, observacao, hora_inicial, hora_final)
            VALUES (:descricao,
                    :atividadeId,
                    :cargaHoraria,
                    :arquivo,
                    :dataInicial,
                    :dataFinal,
                    :alunoId,
                    :observacao,
                    :horaInicial,
                    :horaFinal)";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('descricao', $this->descricao);
    $stmt->bindParam('atividadeId', $this->atividadeId);
    $stmt->bindParam('cargaHoraria', $this->cargaHoraria);
    $stmt->bindParam('arquivo', $this->arquivo);
    $stmt->bindParam('dataInicial', $this->dataInicial);
    $stmt->bindParam('dataFinal', $this->dataFinal);
    $stmt->bindParam('alunoId', $this->alunoId);
    $stmt->bindParam('observacao', $this->observacao);
    $stmt->bindParam('horaInicial', $this->horaInicial);
    $stmt->bindParam('horaFinal', $this->horaFinal);
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
                                    hora_inicial = :horaInicial,
                                    hora_final = :horaFinal,
                                    observacao = :observacao,
                                    aluno_id = :alunoId
                                    WHERE id =:id";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('descricao', $this->descricao);
    $stmt->bindParam('atividadeId', $this->atividadeId);
    $stmt->bindParam('cargaHoraria', $this->cargaHoraria);
    $stmt->bindParam('arquivo', $this->arquivo);
    $stmt->bindParam('dataInicial', $this->dataInicial);
    $stmt->bindParam('dataFinal', $this->dataFinal);
    $stmt->bindParam('horaInicial', $this->horaInicial);
    $stmt->bindParam('horaFinal', $this->horaFinal);
    $stmt->bindParam('observacao', $this->observacao);
    $stmt->bindParam('alunoId', $this->alunoId);
    $stmt->bindParam('id', $this->id);
                
    return $stmt->execute();
  }

  public function updateSemArquivo()
  {
    $sql = "UPDATE $this->table SET descricao = :descricao,
                                    atividade_id = :atividadeId,
                                    carga_horaria = :cargaHoraria,
                                    data_inicial = :dataInicial,
                                    data_final = :dataFinal,
                                    hora_inicial = :horaInicial,
                                    hora_final = :horaFinal,
                                    observacao = :observacao,
                                    aluno_id = :alunoId
                                    WHERE id = :id";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('descricao', $this->descricao);
    $stmt->bindParam('atividadeId', $this->atividadeId);
    $stmt->bindParam('cargaHoraria', $this->cargaHoraria);
    $stmt->bindParam('dataInicial', $this->dataInicial);
    $stmt->bindParam('dataFinal', $this->dataFinal);
    $stmt->bindParam('horaInicial', $this->horaInicial);
    $stmt->bindParam('horaFinal', $this->horaFinal);
    $stmt->bindParam('observacao', $this->observacao);
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
