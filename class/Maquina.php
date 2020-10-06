<?php
require_once 'MaquinaDao.php';

class Maquina extends MaquinaDao
{
  protected $table = "maquina";
  private $id;
  private $nome;
  private $militar;
  private $ip;
  private $mac;
  private $numPatrimonio;
  private $soLicenciado;
  private $observacao;
  private $funcao;
  private $secao;
  private $sistemaOperacional;
  private $usuario;
  private $PostoGraduacao;

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

  public function getNome()
  {
    return $this->nome;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }

  public function getMilitar()
  {
    return $this->militar;
  }

  public function setMilitar($militar)
  {
    $this->militar = $militar;
  }

  public function getIp()
  {
    return $this->ip;
  }

  public function setIp($ip)
  {
    $this->ip = $ip;
  }

  public function getMac()
  {
    return $this->mac;
  }

  public function setMac($mac)
  {
    $this->mac = $mac;
  }

  public function getNumPatrimonio()
  {
    return $this->numPatrimonio;
  }

  public function setNumPatrimonio($numPatrimonio)
  {
    $this->numPatrimonio = $numPatrimonio;
  }

  public function getSoLicenciado()
  {
    return $this->soLicenciado;
  }

  public function setSoLicenciado($soLicenciado)
  {
    $this->soLicenciado = $soLicenciado;
  }

  public function getObservacao()
  {
    return $this->observacao;
  }

  public function setObservacao($observacao)
  {
    $this->observacao = $observacao;
  }

  public function getFuncao()
  {
    return $this->funcao;
  }

  public function setFuncao($funcao)
  {
    $this->funcao = $funcao;
  }

  public function getSecao()
  {
    return $this->secao;
  }

  public function setSecao($secao)
  {
    $this->secao = $secao;
  }

  public function getSistemaOperacional()
  {
    return $this->sistemaOperacional;
  }

  public function setSistemaOperacional($sistemaOperacional)
  {
    $this->sistemaOperacional = $sistemaOperacional;
  }

  public function getUsuario()
  {
    return $this->usuario;
  }

  public function setUsuario($usuario)
  {
    $this->usuario = $usuario;
  }

  public function getPostoGraduacao()
  {
    return $this->PostoGraduacao;
  }

  public function setPostoGraduacao($PostoGraduacao)
  {
    $this->PostoGraduacao = $PostoGraduacao;
  }

  public function insert()
  {
    $sql = "INSERT INTO $this->table (
            nome, militar, ip, mac, num_patrimonio, so_licenciado, observacao, funcao, secao, sistema_operacional, usuario, posto_graduacao)
            VALUES (
              :nome, :militar, :ip, :mac, :numPatrimonio, :soLicenciado, :observacao, :funcao, :secao, :sistemaOperacional, :usuario, :postoGraduacao
            )";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('militar', $this->militar);
    $stmt->bindParam('ip', $this->ip);
    $stmt->bindParam('mac', $this->mac);
    $stmt->bindParam('numPatrimonio', $this->numPatrimonio);
    $stmt->bindParam('soLicenciado', $this->soLicenciado);
    $stmt->bindParam('observacao', $this->observacao);
    $stmt->bindParam('funcao', $this->funcao);
    $stmt->bindParam('secao', $this->secao);
    $stmt->bindParam('sistemaOperacional', $this->sistemaOperacional);
    $stmt->bindParam('usuario', $this->usuario);
    $stmt->bindParam('postoGraduacao', $this->PostoGraduacao);
    return $stmt->execute();
  }

  public function update()
  {
    $sql = "UPDATE $this->table SET nome = :nome,
                                    militar = :militar,
                                    ip = :ip,
                                    mac = :mac,
                                    num_patrimonio = :numPatrimonio,
                                    so_licenciado = :soLicenciado,
                                    observacao = :observacao,
                                    funcao = :funcao,
                                    secao = :secao,
                                    sistema_operacional = :sistemaOperacional,
                                    usuario = :usuario,
                                    posto_graduacao = :postoGraduacao
                                    WHERE id =:id";
    $stmt = DB::prepare($sql);
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('militar', $this->militar);
    $stmt->bindParam('ip', $this->ip);
    $stmt->bindParam('mac', $this->mac);
    $stmt->bindParam('numPatrimonio', $this->numPatrimonio);
    $stmt->bindParam('soLicenciado', $this->soLicenciado);
    $stmt->bindParam('observacao', $this->observacao);
    $stmt->bindParam('funcao', $this->funcao);
    $stmt->bindParam('secao', $this->secao);
    $stmt->bindParam('sistemaOperacional', $this->sistemaOperacional);
    $stmt->bindParam('usuario', $this->usuario);
    $stmt->bindParam('postoGraduacao', $this->PostoGraduacao);
    $stmt->bindParam('id', $this->id);
    return $stmt->execute();
  }
}
