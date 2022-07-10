<?php
include_once "../config/config.php";
include_once "TableRows.php";

class Query {
    public $conn;
    function __construct() {
        $servername = $GLOBALS["SERVERNAME"];
        $username = $GLOBALS["USER"];
        $password = $GLOBALS["PASSWORD"];
        $dbname = $GLOBALS["DBNAME"];

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function query_atari_title($query) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM videogames WHERE atariTitle LIKE :name");
            $query = $query."%";
            $stmt->bindValue(":name", $query);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            if (empty($result) == true) {
                print "hello";
            }

            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                print $v;
            }
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function query_general_search($query) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM videogames WHERE atariTitle LIKE :name
            OR searsTitle LIKE :name 
            OR yearReleased LIKE :name
            OR code LIKE :name
            OR leadProgrammer LIKE :name
            OR genre LIKE :name
            ORDER BY atariTitle, searsTitle, yearReleased");
            $query = "%".$query."%";
            $stmt->bindValue(":name", $query);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            if (empty($result) == true) {
                print "hello";
            }

            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                print $v;
            }
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function query_genre($genre) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM videogames WHERE genre LIKE :genre");
            $genre = $genre."%";
            $stmt->bindValue(":genre", $genre);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            if (empty($result) == true) {
                print "hello";
            }

            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                print $v;
            }
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function query_all() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM videogames");
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            if (empty($result) == true) {
                print "hello";
            }

            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                print $v;
            }
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }  
    }

    function __destruct() {
        $this->conn = NULL;
    }
}

?>