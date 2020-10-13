<?php
require_once 'AlunoDao.php';

class Aluno extends AlunoDao
{
  protected $table = "aluno";
  private $id;
  private $matricula;
  private $nome;
  private $email;
  private $senha;
  private $turno;
  private $status;
  private $infoCadastro;
  private $curso;
  private $administrador;
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

  public function getMatricula()
  {
    return $this->matricula;
  }

  public function setMatricula($matricula)
  {
    $this->matricula = $matricula;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getSenha()
  {
    return $this->senha;
  }

  public function setSenha($senha)
  {
    $this->senha = hash('MD5', $senha);
  }

  public function getTurno()
  {
    return $this->turno;
  }

  public function setTurno($turno)
  {
    $this->turno = $turno;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }

  public function getInfoCadastro()
  {
    return $this->infoCadastro;
  }

  public function setInfoCadastro($infoCadastro)
  {
    $this->infoCadastro = $infoCadastro;
  }

  public function getCurso()
  {
    return $this->curso;
  }

  public function setCurso($curso)
  {
    $this->curso = $curso;
  }

  public function getAdministrador()
  {
    return $this->administrador;
  }

  public function setAdministrador($administrador)
  {
    $this->administrador = $administrador;
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
    $sql = "INSERT INTO $this->table (matricula,
                                      nome,
                                      email,
                                      senha,
                                      turno,
                                      status,
                                      info_cadastro,
                                      data_registro,
                                      curso_id,
                                      administrador_id)
                                      VALUES (:matricula,
                                              :nome,
                                              :email,
                                              :senha,
                                              :turno,
                                              :status,
                                              :infoCadastro,
                                              :dataRegistro,
                                              :curso,
                                              :administrador)";
    $stmt = DB::prepare($sql);    
    $stmt->bindParam('matricula', $this->matricula);
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('email', $this->email);
    $stmt->bindParam('senha', $this->senha);
    $stmt->bindParam('turno', $this->turno);
    $stmt->bindParam('status', $this->status);
    $stmt->bindParam('info_cadastro', $this->infoCadastro);
    $stmt->bindParam('data_registro', $this->dataRegistro);
    $stmt->bindParam('curso_id', $this->curso);
    $stmt->bindParam('administrador_id', $this->administrador);
    return $stmt->execute();
  }

  public function update()
  {
    $sql = "UPDATE $this->table SET matricula = :matricula,
                                    nome = :nome,
                                    email = :email,
                                    senha = :senha,
                                    turno = :turno,
                                    status = :status,
                                    info_cadastro = :infoCadastro,
                                    data_registro = :dataRegistro,
                                    curso_id = :curso,
                                    administrador_id = :administrador
                                    WHERE id :id";                                    
    $stmt = DB::prepare($sql);
    $stmt->bindParam('matricula', $this->matricula);
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('email', $this->email);
    $stmt->bindParam('senha', $this->senha);
    $stmt->bindParam('turno', $this->turno);
    $stmt->bindParam('status', $this->status);
    $stmt->bindParam('info_cadastro', $this->infoCadastro);
    $stmt->bindParam('data_registro', $this->dataRegistro);
    $stmt->bindParam('curso_id', $this->curso);
    $stmt->bindParam('administrador_id', $this->administrador);
    $stmt->bindParam('id', $this->id);
    return $stmt->execute();
  }
}
