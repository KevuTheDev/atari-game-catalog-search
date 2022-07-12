<?php
session_start();
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
        <a href="index.php">Home</a>
    </div>

    <div id="body">
        <div id="confirmation">
            <h1>Confirmation Page</h1>
            <?php
if ($_SESSION["confirmation"] == "valid") {
    if ($_SESSION["form_type"] == "add_game") {
        print "<p>Your game has been successfully added into the catalog!!</p>";
    } else if ($_SESSION["form_type"] == "add_developer") {
        print "<p>Welcome x y, you can now add games into the catalog!!</p>";
    }
} else if ($_SESSION["confirmation"] == "invalid") {
    if ($_SESSION["form_type"] == "add_game") {
        print "<p>Your game could not be inserted into the catalog.<br><br>Please try again later.</p>";
    } else if ($_SESSION["form_type"] == "add_developer") {
        print "<p>The developer account was not able to be created.<br><br>Please try again later.</p>";
    }
}

?>
        </div>
    </div>
</body>


</html>