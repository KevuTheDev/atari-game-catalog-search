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
    <?php include_once "../src/components/nav_bar.php";?>
    <?php include_once "../src/Debug.php";?>

    <div id="body">
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
    </div>

</body>

</html>