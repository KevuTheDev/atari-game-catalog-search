<?php
include "../config/config.php";
include "TableRows.php";


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

    function query_atari_title($gameName) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM videogames WHERE atariTitle LIKE :name");
            $gameName = $gameName."%";
            $stmt->bindValue(":name", $gameName);
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

    function __destruct() {
        $this->conn = NULL;
    }
}

?>