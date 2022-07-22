<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Developer Dashboard | Atari Game Catalog</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css" />
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
        <div id="developer_header">
            <h2>Developer Dashboard</h2>
        </div>
        <div id="add_game">
            <a href="add_games.php">
                <h2>Add Game</h2>
            </a>
        </div>

        <div id="edit_game">
            <a href="edit_game.php">
                <h2>Edit Game</h2>
            </a>
        </div>

        <div id="logout">
            <form action="logout.php" method="post">
                <input type="submit" name="submit" value="Logout">
            </form>
        </div>
    </div>

</body>

</html>