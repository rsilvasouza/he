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

    public function findAtividadesCadastradas($id)
    {
        $sql = "SELECT at.nome, a.descricao, a.horas_registradas, a.arquivo, a.data_registro, a.status, a.id
                FROM $this->table a INNER JOIN atividade at
                ON a.atividade_id = a.id where a.aluno_id = :id";
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
