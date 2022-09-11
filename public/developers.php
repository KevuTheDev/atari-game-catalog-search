<?php
require_once "../src/Header.php";

function dashboard()
{
    if (isset($_SESSION["username"]) == true) {
        ?>
<?php print "<h1 class=\"developer\">Welcome back, " . $_SESSION["username"] . "</h1>";?>
<div id="developer_header">
    <h2>Developer Dashboard</h2>
</div>
<div id="add_game">
    <a href="add_game.php">
        <h3>Add Game</h3>
    </a>
</div>

<div id="view_game">
    <a href="view_games.php">
        <h3>View Game</h3>
    </a>
</div>

<div id="logout">
    <form action="logout.php" method="post">
        <input type="submit" name="submit" value="Logout">
    </form>
</div>
<?php
} else {
        error_invalid_page("Must be logged in to visit dashboard!");
    }
}

my_session_start();

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Developer Dashboard | Atari Game Search</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css" />
    <style>
    .developer {
        color: #4A4E69;
    }
    </style>
</head>

<body>
    <?php include_once "../src/components/nav_bar.php";?>
    <?php include_once "../src/Debug.php";?>

    <div id="body">
        <?php
dashboard();
?>
    </div>

</body>

</html>