<?php
include "../config/config.php";

$servername = $GLOBALS["SERVERNAME"];
$username = $GLOBALS["USER"];
$password = $GLOBALS["PASSWORD"];
$dbname = $GLOBALS["DBNAME"];
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
    try {
        $conn = new PDO($dsn, $username, $password);
        echo "Connected successfully \n";
    } catch (PDOException $e) {
        error_log($e->getMessage());
        exit('Something weird happened'); //something a user can understand
    }
    try{
        $stmt = $conn->prepare("SELECT * FROM videogames");

        $stmt->execute();

        $result = $stmt->fetchAll();
        print_r($result);
    } catch(PDOException $e) {
          echo $sql .'\r\n'. $e->getMessage();
    }
    
    print "done";
?>