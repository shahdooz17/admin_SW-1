<?php

class DatabaseConnection {

  private $host = "localhost";
  private $dbname = "Vezeeta";
  private $username = "root";
  private $password = "";

  private $dataSource;
  private $connection;

  // Initializes the connection and throws an exception if it fails
  public function __construct() {
    try {
      $this->dataSource = "mysql:host=$this->host;dbname=$this->dbname";
      $this->connection = new PDO($this->dataSource, $this->username, $this->password);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Connection succeeded";
    } catch (PDOException $e) {
      throw new Exception("Connection failed: " . $e->getMessage());
    }
  }

  // Allows access to the PDO connection object
  public function getConnection() {
    return $this->connection;
  }

  // Closes the connection (error handling optional)
  public function __destruct() {
    $this->connection = null;
  }

function check($sql)
    {
        if ($result = $this->connection->query($sql)) {
            $num = $result->rowCount();
            return $num;
        }
    }

    // return records (in array)
    function display($sql)
    {
        if ($result = $this->connection->query($sql)) {
            $num = $result->rowCount();
            if ($num > 0) {
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
        } else {
            throw new Exception("Problem in query:" . $sql);
        }
    }

    // return one record only
    function select($sql)
    {
        if ($result = $this->connection->query($sql)) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $result->closeCursor();
            return $row;
        } else {
            throw new Exception("Can not make query : " . $sql);
            // return false;
        }
    }

    // update a record in a table
    function update($sql)
    {
        if ($this->connection->query($sql) === TRUE) {
            return true;
        } else {
            throw new Exception("Error:can not execute the query");
        }
    }

    // insert in a table
    function insert($sql)
    {
        if ($this->connection->query($sql) === true) {
            return true;
        } else {
            throw new Exception("Error :SQL:" . $sql);
            // return false;
        }
    }

    // delete from table
    function delete($sql)
    {
        if ($this->connection->query($sql) === TRUE) {
            return true;
        } else {
            throw new Exception("Error: not deleted");
            // return false;
        }
    }

    function getLastRecordData($tablename , $column)
    {
        $query = "SELECT * FROM $tablename ORDER BY $column DESC LIMIT 1";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    
    public function close() {
        $this->connection = null;
    }
    
//to establish connection
//require_once('../Models/databaseConnection.php'); //connection file path
//$db = new databaseConnection();
//$connection = $db->getConnection();

  }