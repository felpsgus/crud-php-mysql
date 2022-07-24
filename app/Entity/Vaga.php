<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga{

  /**
   * identificador da vaga
   * @var integer
   */
  public $id;

  /**
   * Título da vaga
   * @var string
   */
  public $titulo;

  /**
   * Descrição da vaga
   * @var string
   */
  public $descricao;

  /**
   * Status da vaga
   * @var string(s/n)
   */
  public $ativo;

  /**
   * Data de cadastro da vaga
   * @var string
   */
  public $data;

  /**
   * Método responsável por cadastrar a vaga no banco de dados
   * @return boolean
   */
  public function cadastrar(){
    //DEFINIR DATA DE CADASTRO
    $this->data = date('Y-m-d H:i:s');

    //INSERIR VAGA NO BANCO DE DADOS
    $obDataBase = new Database('vagas');
    $this->id = $obDataBase->insert([
                                    'titulo' => $this->titulo,
                                    'descricao' => $this->descricao,
                                    'ativo' => $this->ativo,
                                    'data' => $this->data
    ]);

    //RETORNAR TRUE OU FALSE
    return true;
  }

  /**
   * Método responsável por atualizar a vaga no banco de dados
   * @return boolean
   */
  public function atualizar(){
    return (new Database('vagas'))->update('id = '.$this->id, [
                                                              'titulo' => $this->titulo,
                                                              'descricao' => $this->descricao,
                                                              'ativo' => $this->ativo,
                                                              'data' => $this->data
    ]);
  }

  /**
   * Método responsável por excluir a vaga no banco de dados
   * @return boolean
   */
  public function excluir(){
    return (new Database('vagas'))->delete('id = '.$this->id);
  }

  /**
   * Método responsável por listar as vagas do banco de dados
   * @param string $where
   * @param string $order
   * @param string $limit
   * @return array
   */
  public static function getVagas($where = null, $order = null, $limit = null){
    return (new Database('vagas'))->select($where, $order, $limit)
                                  ->fetchAll(\PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por buscar uma vaga no banco de dados com base no seu ID
   * @param integer $id
   * @return Vaga
   */
  public static function getVaga($id){
    return (new Database('vagas'))->select('id = '.$id)
                                  ->fetchObject(self::class);
  }
}