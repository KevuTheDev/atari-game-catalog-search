<?php
include_once "../config/config.php";
include_once "TableRows.php";

class Query
{
    private $conn;
    public function __construct()
    {
        $servername = $GLOBALS["SERVERNAME"];
        $username = $GLOBALS["USER"];
        $password = $GLOBALS["PASSWORD"];
        $dbname = $GLOBALS["DBNAME"];

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function query_atari_title($query)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM videogames WHERE atariTitle LIKE :name");
            $query = $query . "%";
            $stmt->bindValue(":name", $query);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            if (empty($result) == true) {
                print "hello";
            }

            foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
                print $v;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function query_general_search($query)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM videogames WHERE atariTitle LIKE :name
            OR searsTitle LIKE :name
            OR yearReleased LIKE :name
            OR code LIKE :name
            OR leadProgrammer LIKE :name
            OR genre LIKE :name
            ORDER BY atariTitle, searsTitle, yearReleased");
            $query = "%" . $query . "%";
            $stmt->bindValue(":name", $query);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            if (empty($result) == true) {
                print "hello";
            }

            foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
                print $v;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function query_genre($genre)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM videogames WHERE genre LIKE :genre");
            $genre = $genre . "%";
            $stmt->bindValue(":genre", $genre);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            if (empty($result) == true) {
                print "hello";
            }

            foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
                print $v;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function query_all()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM videogames");
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            if (empty($result) == true) {
                print "hello";
            }

            foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
                print $v;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function add_game($columns)
    {
        try {
            $insertString = "";
            $insertValues = "";

            foreach ($columns as $x => $x_value) {
                $insertString = $insertString . $x . ", ";
                if (empty($x_value) == false) {
                    $insertValues = $insertValues . "\"" . $x_value . "\"" . ", ";
                } else {
                    $insertValues = $insertValues . "\"\"" . ", ";
                }
            }

            $insertString = rtrim($insertString, ", ");
            $insertValues = rtrim($insertValues, ", ");
            $insertString = "(" . $insertString . ")";
            $insertValues = "(" . $insertValues . ")";

            print $insertString;
            print "<br><br>";
            print $insertValues;

            $stmt = $this->conn->prepare("INSERT INTO videogames " . $insertString
                . " VALUES " . $insertValues);

            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            if (empty($result) == true) {
                print "hello";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}