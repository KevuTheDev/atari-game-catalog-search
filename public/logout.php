<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    unset($_SESSION["username"]);
}

?>


<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Atari Game Catalog | CP 476 Project</title>
</head>

<body>
    <div id="nav_bar">
        <a href="/">Home</a>
    </div>
    <?php
require_once "../src/Debug.php";

DEBUG_SESSION();
?>

    <div id="body">
        <div id="logout">
            <h2>Log out</h2>
            <p>You have logged out</p>
        </div>
    </div>
</body>

</html>