<?php
class Database extends PDO
{
  public $databaseName;
  public $hostname;
  public $charset;
  public $username;
  public $password;
  public $connect;
  public $configDatabase;

  public function __construct()
  {
    $this->configDatabase = Configurations::configurationsBackEnd()['database'];
    $this->databaseName = $this->configDatabase['databaseName'];
    $this->hostname = $this->configDatabase['hostname'];
    $this->charset = $this->configDatabase['charset'];
    $this->username = $this->configDatabase['username'];
    $this->password = $this->configDatabase['password'];
    $this->connect = "mysql:dbname=$this->databaseName; host=$this->hostname; charset=$this->charset";
    $this->connect();
  }

  /* Handle connect to Database */
  public function connect()
  {
    try {
      parent::__construct($this->connect, $this->username, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (PDOException $e) {
      die("Failed to connect Database: " . $e->getMessage());
    }
  }

  /* Select Query */
  public function select($field, $tablename, $condition = 1)
  {
    $sql = "SELECT $field FROM $tablename WHERE $condition";
    $statement = $this->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  /* Insert Query */
  public function insert($tablename, $options = [])
  {
    $key = '`' . implode('`,`', array_keys($options)) . '`';
    $values = ":" . implode(', :', array_keys($options));
    $sql = "INSERT INTO $tablename ($key) VALUES ($values)";
    $statement = $this->prepare($sql);
    foreach ($options as $k => $v) {
      $statement->bindValue(":$k", $v);
    }
    return $statement->execute();
  }

  /* Update Query */
  public function update($tableName, $options = array(), $condition)
  {
    $set = NULL;
    foreach ($options as $k => $v) {
      $set .= "`$k` = :$k,";
    }
    $set = rtrim($set, ',');
    $sql = "UPDATE $tableName SET $set WHERE $condition";
    $statement = $this->prepare($sql);
    foreach ($options as $k => $v) {
      $statement->bindValue(":$k", $v);
    }
    return $statement->execute();
  }

  /* Delete Query */
  public function delete($tableName, $condition = 0)
  {
    $sql = "DELETE FROM $tableName WHERE $condition";
    return $this->exec($sql);
  }
}
