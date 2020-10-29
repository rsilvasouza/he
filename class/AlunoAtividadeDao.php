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

    public function horasCadastradas($id){
        $sql = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( a.carga_horaria ) ) ),'%H:%i') AS total
                FROM $this->table a INNER JOIN atividade at
                ON a.atividade_id = at.id where a.aluno_id = :id AND a.status = -1";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function horasAprovadas($id){
        $sql = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( a.carga_horaria ) ) ),'%H:%i') AS total
                FROM $this->table a INNER JOIN atividade at
                ON a.atividade_id = at.id where a.aluno_id = :id AND a.status = 1";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function atividadesEmAnalise(){
        $sql = "SELECT COUNT(*) AS total FROM $this->table WHERE status = -1";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findAtividadesCadastradas($id)
    {
        $sql = "SELECT at.nome, a.*
                FROM $this->table a INNER JOIN atividade at
                ON a.atividade_id = at.id where a.aluno_id = :id";
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

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
