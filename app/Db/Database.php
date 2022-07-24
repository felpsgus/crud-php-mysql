<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database{
  
  /**
   * Host do banco de dados
   * @var string
   */
  const HOST = 'localhost';

  /**
   * Nome do banco de dados
   * @var string
   */
  const NAME = 'wdev_vagas';

  /**
   * Usuário do banco de dados
   * @var string
   */
  const USER = 'root';

  /**
   * Nome da tabela a ser manipulada
   * @var {type}
   */
  private $table;

  /**
   * Instancia de conexão com o banco de dados
   * @var PDO
   */
  private $connection;


  /**
   * Define a tabela e instancia a conexão
   * @param string $table
   */
  public function __construct($table){
    $this->table = $table;
    $this->setConection();
  }

  /**
   * Método responsável por criar a conexão com o banco de dados
   */
  private function setConection(){
    try{
      $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
      die('ERROR: ' . $e->getMessage());
    }
  }

  /**
   * Método responsável por executar queries no banco de dados
   * @param string $query
   * @param array $params
   * @return PDOStatement
   */
  public function execute($query, $params = []){
    try{
      $statement = $this->connection->prepare($query);
      $statement->execute($params);
      return $statement;
    }catch(PDOException $e){
      die('ERROR: ' . $e->getMessage());
    }
  }

  /**
   * Método responsável por inserir dados no banco de dados
   * @param array $value [ fields => values ]
   * @return integer
   */
  
  public function insert($values){
    //DADOS DA QUERY
    $fields = array_keys($values);
    $binds  = array_pad([], count($fields), '?');

    //MONTA A QUERY
    $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

    //EXECUTA O INSERT
    $this->execute($query, array_values($values));

    //RETORNA O ID DA VAGA
    return $this->connection->lastInsertId();
  }

  /**
   * Método responsável por executar uma consulta no banco de dados
   * @param string $where
   * @param string $order
   * @param string $limit
   * @return PDOStatement
   */
  public function select($where = null, $order = null, $limit = null, $fields = '*'){
    //DADOS DA QUERY
    $where = strlen($where) ? ' WHERE '.$where : '';
    $order = strlen($order) ? ' ORDER BY '.$order : '';
    $limit = strlen($limit) ? ' LIMIT '.$limit : '';
    
    //MONTA A QUERY
    $query = 'SELECT '.$fields.' FROM '.$this->table. ' '.$where.' '.$order.' '.$limit;

    return $this->execute($query);
  }

  /**
   * Método responsável por excutar atualizações no banco de dados
   * @param string $where
   * @param array $values [ fields => value ]
   * @return boolean
   */
  public function update($where, $values){

    //DADOS DA QUERY
    $fields = array_keys($values);

    //MONTA A QUERY
    $query = 'UPDATE '.$this->table.' SET '.implode('=?,', $fields).'=? WHERE '.$where;
    
    //EXECUTA A QUERY
    $this->execute($query, array_values($values));

    //RETORNA TRUE
    return true;
  }

  /**
   * Método responsável por excluir dados do banco de dados
   * @param string $where
   * @return boolean
   */
  public function delete($where){
    //MONTA A QUERY
    $query = 'DELETE FROM '.$this->table.' WHERE '.$where;
    
    //EXECUTA A QUERY
    $this->execute($query);
    
    //RETORNA TRUE
    return true;
  }
}