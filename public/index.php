<?php
session_start();
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Home | Atari Game Catalog</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css" />
</head>

<body>
    <?php include_once "../src/components/nav_bar.php";?>
    <?php include_once "../src/Debug.php";?>

    <div id="body">
        <div id="search_bar">
            <h2>Search Bar</h2>
            <form action="search.php" method="get">
                <input type="text" name="search">
                <input type="submit" name="submit" value="Search">
            </form>
        </div>
        <br><br>
        <div id="developers">
            <h2>Developers</h2>
            <?php
if (isset($_SESSION["username"]) == true) {
    print "<p>Welcome back, " . $_SESSION["username"] . "</p>";
    print "<a href=\"developers.php\"><h3>Dashboard</h3></a>";
} else {
    print "<a href=\"login.php\"><h3>Login</h3></a>";
}
?>
        </div>
    </div>
</body>

</html>