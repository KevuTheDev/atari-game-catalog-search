<?php
require_once "../src/Header.php";

my_session_start();
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Confirmation | Atari Game Catalog</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css" />
</head>

<body>
    <?php include_once "../src/components/nav_bar.php";?>
    <?php include_once "../src/Debug.php";?>

    <div id="body">
        <?php
// Checks if developer is logged in
if (isset($_SESSION["username"]) == true) {

    // Checks if the request was from a form and has confirmation
    if (empty($_SESSION["form_type"]) == false && empty($_SESSION["confirmation"]) == false) {
        print "<div id=\"confirmation\">";
        print "<h1>Confirmation Page</h1>";

        // Evaluates the scenario of "confirmation" and "form_type"
        // And proceed to the correct scenario.
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
        error_invalid_page("");
    }
} else {
    error_invalid_page("");
}

// Removes the SESSION values
unset($_SESSION["form_type"]);
unset($_SESSION["confirmation"]);
?>
    </div>
</body>

</html>