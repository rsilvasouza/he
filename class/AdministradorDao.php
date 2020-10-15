<?php
require_once 'DB.php';

abstract class AdministradorDao extends DB
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

    public function findMatricula($matricula)
    {

        $sql = "select * from $this->table WHERE matricula LIKE ?";

        $params = array("$matricula");
        $stmt = DB::prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function findEmail2($email)
    {

        $sql = "select * from $this->table WHERE email LIKE ?";

        $params = array("$email");
        $stmt = DB::prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function findEmail($email)
    {

        $sql = "select * from $this->table WHERE email LIKE ?";

        $params = array("$email");
        $stmt = DB::prepare($sql);
        $stmt->execute($params);
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
