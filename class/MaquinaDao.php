<?php
require_once 'DB.php';

abstract class MaquinaDao extends DB
{
    protected $table;

    abstract public function insert();
    abstract public function update();

    public function find($id)
    {

        $sql = "select * from $this->table WHERE id LIKE ?";

        $params = array("%$id%");
        $stmt = DB::prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function findAll()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findAllAll()
    {
        $sql = "SELECT m.id as id_maquina,
                       m.nome,
                       m.militar,
                       m.ip,
                       m.mac,
                       m.num_patrimonio,
                       m.so_licenciado,
                       m.observacao,
                       m.funcao,
                       m.secao,
                       m.sistema_operacional,
                       m.usuario,
                       m.posto_graduacao,
                       f.id as id_funcao,
                       f.descricao as desc_funcao,
                       s.id as id_secao,
                       s.descricao as desc_secao,
                       s.andar,
                       so.id as id_so,
                       so.descricao as desc_so,
                       pg.id as id_pg,
                       pg.descricao as desc_pg,
                       pg.hierarquia,
                       pg.sigla,
                       u.id as id_usuario
         		FROM maquina m
                INNER JOIN funcao f on m.funcao = f.id
                INNER JOIN secao s on m.secao = s.id
                INNER JOIN sistema_operacional so on m.sistema_operacional = so.id
                INNER JOIN posto_graduacao pg on m.posto_graduacao = pg.id
                INNER JOIN usuario u on m.usuario = u.id ORDER BY m.nome
                ";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findIt($id)
    {

        $sql = "select * from $this->table WHERE id LIKE ?";

        $params = array("$id");
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
