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

<style>
body {
    display: flex;
    flex-direction: column;

}

.nav_bar {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
}

.welcome {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
}

.search-bar {
    width: 600px;
    height: 20px;
}

.search-button {
    border-radius: 10px;
    background: white;
}
</style>
<?php
if (isset($_SESSION["username"]) == true) {
    ?>

<?php
} else {
    print "<a href=\"login.php\"><h4>Login</h4></a>";
}

include $_SERVER['DOCUMENT_ROOT'] . '/header/header.php';
?>

<body>

    <?php
require_once "../src/Debug.php";

DEBUG_SESSION();
?>

    <div id="body">
        <br><br>
        <div id="developers">
            <h2>Developers</h2>
            <?php
?>
        </div>
    </div>
</body>

</html>