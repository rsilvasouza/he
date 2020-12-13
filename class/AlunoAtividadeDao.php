<?php
require_once 'DB.php';

abstract class AlunoAtividadeDao extends DB
{
  protected $table;

  abstract public function insert();
  abstract public function update();

  public function findAll()
  {
    $sql = "SELECT * FROM $this->table";
    $stmt = DB::prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function horasCadastradas($id)
  {
    $sql = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( a.carga_horaria ) ) ),'%H:%i') AS total
                FROM $this->table a INNER JOIN atividade at
                ON a.atividade_id = at.id where a.aluno_id = :id AND a.status = -1";
    $stmt = DB::prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function horasAprovadas($id)
  {
    $sql = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( a.carga_horaria ) ) ),'%H:%i') AS total
                FROM $this->table a INNER JOIN atividade at
                ON a.atividade_id = at.id where a.aluno_id = :id AND a.status = 1";
    $stmt = DB::prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function buscarAtividadesAprovadas($id)
  {
    $sql = "SELECT at.nome, a.carga_horaria AS horas, d.nome AS dimensao
            FROM $this->table a
            INNER JOIN aluno al ON al.id = a.aluno_id
            INNER JOIN atividade at ON a.atividade_id = at.id
            INNER JOIN dimensao d ON d.id = at.dimensao_id
            WHERE al.id = :id AND a.status = 1";
    $stmt = DB::prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function atividadesEmAnalise()
  {
    $sql = "SELECT COUNT(*) AS total FROM $this->table WHERE status = -1";
    $stmt = DB::prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function findAtividadesCadastradas($id)
  {
    $sql = "SELECT at.nome, a.*
                FROM $this->table a INNER JOIN atividade at
                ON a.atividade_id = at.id where a.aluno_id = :id AND a.status = -1";
    $stmt = DB::prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function findAtividadesAverbadas($id)
  {
    $sql = "SELECT at.nome, a.*
                FROM $this->table a INNER JOIN atividade at
                ON a.atividade_id = at.id where a.aluno_id = :id AND a.status IN (0,1)";
    $stmt = DB::prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function listarAtividadeCadastrada()
  {
    $sql = "SELECT al.matricula, al.nome AS aluno, at.nome, a.*
                FROM $this->table a INNER JOIN atividade at ON a.atividade_id = at.id
                INNER JOIN aluno al ON a.aluno_id = al.id 
                where a.status = -1";
    $stmt = DB::prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function chartDimensaoGeral()
  {
    $sql = "SELECT d.nome AS nome, COUNT(d.nome) AS quantidade 
        FROM atividade a 
        INNER JOIN dimensao d ON a.dimensao_id = d.id 
        INNER JOIN $this->table alt ON alt.atividade_id = a.id WHERE alt.status = 1 GROUP BY d.nome
        HAVING COUNT(d.nome) > 0 ORDER BY d.id";
    $stmt = DB::prepare($sql);
    $stmt->execute();
    return $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function chartDimensaoSI()
  {
    $sql = "SELECT d.nome AS nome, COUNT(d.nome) AS quantidade 
    FROM atividade a  
    INNER JOIN dimensao d ON a.dimensao_id = d.id 
    INNER JOIN $this->table alt ON alt.atividade_id = a.id 
    INNER JOIN aluno a2 ON a2.id = alt.aluno_id 
    INNER JOIN curso c ON c.id = a2.curso_id 
    WHERE alt.status = 1 AND c.id = 1 GROUP BY d.nome
    HAVING COUNT(d.nome) > 0 ORDER BY d.id";
    $stmt = DB::prepare($sql);
    $stmt->execute();
    return $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function chartDimensaoGA()
  {
    $sql = "SELECT d.nome AS nome, COUNT(d.nome) AS quantidade 
    FROM atividade a  
    INNER JOIN dimensao d ON a.dimensao_id = d.id 
    INNER JOIN $this->table alt ON alt.atividade_id = a.id 
    INNER JOIN aluno a2 ON a2.id = alt.aluno_id 
    INNER JOIN curso c ON c.id = a2.curso_id 
    WHERE alt.status = 1 AND c.id = 2 GROUP BY d.nome
    HAVING COUNT(d.nome) > 0 ORDER BY d.id";
    $stmt = DB::prepare($sql);
    $stmt->execute();
    return $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function aprovar($id, $status)
  {
    $sql = "UPDATE $this->table SET status = :status
                                    WHERE id =:id";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('status', $status);
    $stmt->bindParam('id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }

  public function rejeitar($id, $motivo, $status)
  {
    $sql = "UPDATE $this->table SET motivo = :motivo,
                                    status = :status
                                    WHERE id =:id";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('motivo', $motivo);
    $stmt->bindParam('status', $status);
    $stmt->bindParam('id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }

  public function somarCargaHorariaPorTipo($atividadeId, $alunoId)
  {

    $sql = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( aa.carga_horaria ) ) ),'%H:%i') as soma
            FROM $this->table aa
            where atividade_id = :atividadeId
            AND aluno_id = :alunoId
            AND status = 1";
    $stmt = DB::prepare($sql);
    $stmt->bindParam(':atividadeId', $atividadeId, PDO::PARAM_INT);
    $stmt->bindParam(':alunoId', $alunoId, PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return ($resultado[0]->soma == null) ? '00:00' : $resultado[0]->soma;
  }

  public function somarCargaHorariaPorTipoAtividade($alunoId, $idDimensao)
  {

    $sql = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( aa.carga_horaria ) ) ),'%H:%i') AS soma FROM aluno_atividade aa
            INNER JOIN atividade a ON a.id = aa.atividade_id 
            INNER JOIN dimensao d ON a.dimensao_id = d.id
            INNER JOIN aluno a2 ON a2.id = aa.aluno_id 
            WHERE aa.aluno_id = :alunoId
            AND aa.atividade_id IN (SELECT a.id FROM atividade a WHERE a.dimensao_id = :idDimensao)
            AND aa.status = 1";
    $stmt = DB::prepare($sql);
    $stmt->bindParam(':idDimensao', $idDimensao, PDO::PARAM_INT);
    $stmt->bindParam(':alunoId', $alunoId, PDO::PARAM_INT);
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    return ($resultado[0]->soma == null) ? '00:00' : $resultado[0]->soma;
  }

  public function delete($id)
  {
    $sql = "DELETE FROM $this->table WHERE id = :id";
    $stmt = DB::prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
}
