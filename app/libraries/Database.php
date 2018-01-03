<?php

  // PDO Database Class
  // 1. Connect to database
  // 2. Create prepared statements
  // 3. Return rows as well as single results
  // 4. Bind values

class Database
{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;

  // The database handler
  private $dbh;
  //The statement that is created from the desired query
  private $stmt;
  private $error;

  public function __construct()
  {
    // Set Data Source Name
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
    $options = array(
      // Request a persistent connection, rather than creating a new connection.
      PDO::ATTR_PERSISTENT => true,
      // Throw a PDOException if an error occurs. Will contain a message with specific error.
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    // Create PDO instance
    try {
      $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }

  // Prepare statement with query
  public function query($sql)
  {
    $this->stmt = $this->dbh->prepare($sql);
  }

  // Binds a value to a corresponding name in the SQL statement
  // which prepared the statement.
  public function bind($param, $value, $type = null)
  {
    // If type is not supplied, select type based on the value.
    if (is_null($type)) {
      switch (true) {
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
      }
    }

    $this->stmt->bindValue($param, $value, $type);
  }

  // Execute the prepared statement
  public function execute()
  {
    return $this->stmt->execute();
  }

  // Get result set as array of objects
  public function resultSet()
  {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // Get single record as an object
  public function single()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }

  // Get row count
  public function rowCount()
  {
    return $this->stmt->rowCount();
  }
}