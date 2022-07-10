<?php
    function search() {
        return "search.php";
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

    <div id="body">
        <div id="search_bar">
            <h2>Search Bar</h2>
            <form action="<?php print search(); ?>" method="get">
                <input type="text" name="search">
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
        <br><br>
        <div id="developers">
            <h2>Developers</h2>
            <form action="developers.php" method="get">
                <input type="submit" name="submit" value="Login">
            </form>
        </div>
    </div>
</body>

</html>