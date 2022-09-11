<?php
session_start();
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Home | Atari Game Search</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css" />
    <style>
    img {
        width: 25%;
        height: 25%;
    }
    </style>
</head>

<body>
    <?php include_once "../src/components/nav_bar.php";?>
    <?php include_once "../src/Debug.php";?>

    <div id="body">
        <h2 class="text-center">Welcome to Atari Game Search</h2>
        <p class="text-center">Search for your favourite game or become a developer to add a game.</p>
        <center><img src="resources/images/Atari2600_Console.jpg" alt="Atari 2600 Console"></center>
    </div>
</body>

</html>