<?php
require_once "../config/config.php";
require_once "TableRows.php";
require_once "utils.php";

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
            print "Error: " . $e->getMessage();
        }
    }

    public function query_general_search($query)
    {
        try {
            $stmt = $this->conn->prepare("SELECT  `atariTitle`, `searsTitle`, `code`,
            `leadProgrammer`,
            `yearReleased`,
            `genre`,
            `notes` FROM `videogames` WHERE `atariTitle` LIKE :name
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

            foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
                print $v;
            }
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();
        }
    }

    public function query_games()
    {
        try {
            $stmt = $this->conn->prepare("SELECT `atariTitle`, `searsTitle`, `code`,
            `leadProgrammer`,
            `yearReleased`,
            `genre`,
            `notes`
            FROM `videogames`");
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
                print $v;
            }
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();
        }
    }

    public function query_games_by_username($username)
    {
        try {
            $stmt = $this->conn->prepare("SELECT `atariTitle`, `searsTitle`, `code`,
            `leadProgrammer`,
            `yearReleased`,
            `genre`,
            `notes`
            FROM  `videogames`
            WHERE `username`=:username");
            $stmt->bindValue(":username", $username);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();

            return null;
        }
    }

    public function query_games_by_code($code)
    {
        try {
            $stmt = $this->conn->prepare("SELECT `atariTitle`, `searsTitle`, `code`,
            `leadProgrammer`,
            `yearReleased`,
            `genre`,
            `notes`
            FROM `videogames`
            WHERE `code`=:code");
            $stmt->bindValue(":code", $code);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();

            return null;
        }
    }

    public function query_games_by_code_username($code, $username)
    {
        try {
            $stmt = $this->conn->prepare("SELECT  `atariTitle`, `searsTitle`, `code`,
            `leadProgrammer`,
            `yearReleased`,
            `genre`,
            `notes`
            FROM `videogames`
            WHERE `code`=:code and `username`=:username");
            $stmt->bindValue(":code", $code);
            $stmt->bindValue(":username", $username);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();

            return null;
        }
    }

    public function insert_game($columns)
    {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO `videogames`
                (`atariTitle`, `searsTitle`, `code`,
                `leadProgrammer`, `yearReleased`, `genre`,
                `notes`, `username`)
                VALUES (:atariTitle, :searsTitle, :code,
                :leadProgrammer, :yearReleased, :genre,
                :notes, :username)");

            $stmt->bindValue(":atariTitle", $columns["atariTitle"]);
            $stmt->bindValue(":searsTitle", $columns["searsTitle"]);
            $stmt->bindValue(":code", $columns["code"]);
            $stmt->bindValue(":leadProgrammer", $columns["leadProgrammer"]);
            $stmt->bindValue(":yearReleased", $columns["yearReleased"]);
            $stmt->bindValue(":genre", $columns["genre"]);
            $stmt->bindValue(":notes", $columns["notes"]);
            $stmt->bindValue(":username", $columns["username"]);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();
            return false;
        }
        return true;
    }

    public function insert_developer($columns)
    {
        try {
            $columns["salt"] = "123";
            $stmt = $this->conn->prepare(
                "INSERT INTO `developers`
                (`firstname`, `lastname`, `username`, `password`
                VALUES (:firstname, :lastname, :username, :password, :salt");
            $stmt->bindValue(":firstname", $columns["firstname"]);
            $stmt->bindValue(":lastname", $columns["lastname"]);
            $stmt->bindValue(":username", $columns["username"]);
            $stmt->bindValue(":password", $columns["password"]);

            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();
            return false;
        }
        return true;
    }

    public function update_game_notes_by_code($columns)
    {
        try {
            $stmt = $this->conn->prepare(
                "UPDATE `videogames`
                SET `notes`=:notes
                WHERE `code`=:code");
            $stmt->bindValue(":notes", $columns["notes"]);
            $stmt->bindValue(":code", $columns["code"]);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();
            return false;
        }
        return true;
    }

    public function check_code_exists($query)
    {
        # 0 = False;
        # 1 = True;
        # 2 = Error;
        try {
            $stmt = $this->conn->prepare(
                "SELECT `code`
                FROM `videogames`
                WHERE `code`=:theCode");
            $stmt->bindValue(":theCode", $query);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return 1;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();
            return 2;
        }
    }

    public function check_username_exists($query)
    {
        # 0 = False;
        # 1 = True;
        # 2 = Error;
        try {
            $stmt = $this->conn->prepare(
                "SELECT `username`
                FROM `developers`
                WHERE `username`=:dev");
            $stmt->bindValue(":dev", $query);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 0) {
                return 1;
            } else {
                return 0;
            }
            print $result;
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();
            return 2;
        }
    }

    public function validate_login($username, $password)
    {
        # 0 = False;
        # 1 = True;
        # 2 = Error;
        try {
            $stmt = $this->conn->prepare(
                "SELECT `username`
                FROM `developers`
                WHERE `username`=:theUser and `password`=:thePass");
            $stmt->bindValue(":theUser", $username);
            $stmt->bindValue(":thePass", $password);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                return 0;
            }
            print $result;
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();
            return 2;
        }
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}