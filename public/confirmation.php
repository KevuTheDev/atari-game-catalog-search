<?php
require_once "../src/utils.php";

session_start();

pre_r($_SESSION);
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Confirmation | Atari Game Catalog</title>
</head>

<body>
    <div id="nav_bar">
        <a href="index.php">Home</a>
    </div>
    <?php
require_once "../src/Debug.php";

DEBUG_SESSION();
?>

    <div id="body">
        <?php

if (empty($_SESSION["form_type"]) == false) {
    if (empty($_SESSION["confirmation"]) == false) {
        print "<div id=\"confirmation\">";
        print "<h1>Confirmation Page</h1>";

        if ($_SESSION["confirmation"] == "valid") {
            if ($_SESSION["form_type"] == "add_game") {
                print "<p>Your game has been successfully added into the catalog!!</p>";
            } else if ($_SESSION["form_type"] == "add_developer") {
                print "<p>Welcome x y, you can now add games into the catalog!!</p>";
            } else if ($_SESSION["form_type"] == "edit_game") {
                print "<p>Your game was successfully updated</p>";
            } else {
                print "<p>Something is not right here.</p>";
            }
        } else if ($_SESSION["confirmation"] == "invalid") {
            if ($_SESSION["form_type"] == "add_game") {
                print "<p>Your game could not be inserted into the catalog.<br><br>Please try again later.</p>";
            } else if ($_SESSION["form_type"] == "add_developer") {
                print "<p>The developer account was not able to be created.<br><br>Please try again later.</p>";
            } else if ($_SESSION["form_type"] == "edit_game") {
                print "<p>An error has occurred when updating your game.<br><br>Please try again later.</p>";
            } else {
                print "<p>Something is not right here.</p>";
            }
        } else {
            print "<p>Something is not right here.</p>";
        }

        print "</div>";
    } else {
        print "<h1>Invalid Page</h1>";
    }
} else {
    print "<h1>Invalid Page</h1>";
}

unset($_SESSION["form_type"]);
unset($_SESSION["confirmation"]);
?>
    </div>
</body>


</html>