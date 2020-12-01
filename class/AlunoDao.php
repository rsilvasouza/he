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

    public function buscaAluno($id)
    {

        $sql = "select * from $this->table WHERE id =:id";

        $stmt = DB::prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function verificaStatus($email, $senha) {
        
        $sql = "select * from $this->table WHERE email = :email AND senha = :senha AND status IS NULL";
        $stmt = DB::prepare($sql);
        $stmt->bindParam('email', $email);
        $stmt->bindParam('senha', $senha);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($resultado) <= 0) {
            return false;
        } else {
            return true;
        }
    }

    public function verificaRejeitado($email, $senha, $status) {
        
        $sql = "select * from $this->table WHERE email = :email AND senha = :senha AND status = :status";
        $stmt = DB::prepare($sql);
        $stmt->bindParam('email', $email);
        $stmt->bindParam('senha', $senha);
        $stmt->bindParam('status', $senha);
        $stmt->execute();
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

    public function horasCadastradas($id)
    {
        $sql = "SELECT count(*) AS total FROM $this->table a INNER JOIN aluno_atividade atv ON
            atv.aluno_id = a.id WHERE a.id = :id AND atv.status IS NULL";
        $stmt = DB::prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function contasCadastradas()
    {
        $sql = "SELECT COUNT(*) AS total FROM $this->table WHERE status IS NULL";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function listarAlunosComAtividade()
    {
        $sql = "SELECT aa.descricao, a.matricula, a.nome AS aluno, c.sigla AS curso, a.turno, at.nome AS atividade, aa.carga_horaria, aa.status, aa.arquivo FROM $this->table a 
                INNER JOIN curso c ON c.id = a.curso_id 
                INNER JOIN aluno_atividade aa ON aa.aluno_id = a.id
                INNER JOIN atividade at ON at.id = aa.atividade_id";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function listarAlunosComHorasAverbadas()
    {
        $sql = "SELECT a.matricula, a.nome AS aluno, c.sigla AS curso, a.turno, SEC_TO_TIME( SUM( TIME_TO_SEC( aa.carga_horaria ) ) ) AS horas FROM $this->table a 
                INNER JOIN curso c ON c.id = a.curso_id 
                INNER JOIN aluno_atividade aa ON aa.aluno_id = a.id
                INNER JOIN atividade at ON at.id = aa.atividade_id 
                WHERE aa.status = 1
                GROUP BY  a.nome, c.sigla";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function rejeitar($id, $motivo, $status) {
    $sql = "UPDATE $this->table SET info_cadastro = :motivo,
                                    status = :status
                                    WHERE id = :id";
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
