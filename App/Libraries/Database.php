<?php

namespace app\libraries;
use \PDO as PDO;
/**
 *
 */
class Database
{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $name = DB_NAME;
  // private $name = DB_NAME;

  private $dbh;
  private $stmt;
  private $error;


  function __construct()
  {
    // SET THE DSN
    $dsn = 'mysql:=' . $this->host . ';dbname=' . $this->name;

    // SET THE OPTIONS
    $options = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];

    // CREATES NEW PDO INSTANCE
    try
    {
        $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    } catch (PDOException $e)
    {
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }

  public function Query($query)
  {
    $this->stmt = $this->dbh->prepare($query);
  }

  public function Bind($param, $value, $type = null)
  {
    if (is_null($type))
    {
      switch (true)
      {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;

        default:
        $type = PDO::PARAM_STR;
          break;
      }
    }

    $this->stmt->bindValue($param, $value, $type);
  }

  public function Execute()
  {
    return $this->stmt->execute();
  }

  public function ReadAll()
  {
    $this->Execute();
    return $this->stmt->fetchAll();
  }

  public function ReadSingle()
  {
    $this->Execute();
    return $this->stmt->fetch();
  }

  public function RowCount()
  {
    $this->Execute();
    return $this->stmt->rowCount();
  }

  public function LastInsert()
  {
    return $this->dbh->lastInsertId();
  }

}
