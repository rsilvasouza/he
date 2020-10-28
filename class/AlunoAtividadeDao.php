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

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
