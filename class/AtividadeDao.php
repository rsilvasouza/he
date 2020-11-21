<?php
require_once 'DB.php';

abstract class AtividadeDao extends DB
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

    public function listarTipoAtividade()
    {
        $sql = "SELECT a.id, a.nome, a.modo_comprovacao, a.max_horas, d.nome AS dimensao FROM $this->table a INNER JOIN dimensao d WHERE a.dimensao_id = d.id";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function listarAtividade($id) {
        $sql = "SELECT max_horas FROM $this->table WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $resultado[0]->max_horas;
    }

    public function buscaIdDimensao($id) {
        $sql = "SELECT dimensao_id FROM $this->table WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $resultado[0]->dimensao_id;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
