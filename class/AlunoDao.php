<?php
require_once 'DB.php';

abstract class AlunoDao extends DB
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

    public function findPreCadastrado()
    {
        $sql = "SELECT a.id, a.matricula, a.nome, a.email, a.turno, c.sigla, c.nome AS curso FROM $this->table a INNER JOIN curso c ON a.curso_id = c.id where a.status IS NULL";
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

    public function verificaStatus($email)
    {

        $sql = "select * from $this->table WHERE email = ? AND status IS NULL";

        $params = array("$email");
        $stmt = DB::prepare($sql);
        $stmt->execute($params);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($resultado) <= 0) {
            return false;
        } else {
            return true;
        }
    }

    public function findEmail($email)
    {

        $sql = "select * from $this->table WHERE email LIKE ?";

        $params = array("$email");
        $stmt = DB::prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function atualizaStatus($id, $status)
  {
    $sql = "UPDATE $this->table SET status = :status WHERE id = :id";                                    
    $stmt = DB::prepare($sql);
    $stmt->bindParam('status', $status);
    $stmt->bindParam('id', $id);
    return $stmt->execute();
  }

  public function horasCadastradas(){
      
  }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
