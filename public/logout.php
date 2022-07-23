<?php
require_once "../src/Header.php";

function logout_message_success()
{
    ?>
<div id="logout">
    <h2>Log out</h2>
    <p>You have logged out</p>
</div>
<?php
}

$logout_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    my_session_start();

    unset($_SESSION["username"]);
    $logout_success = true;
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Logout | Atari Game Catalog</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css" />
</head>

<body>
    <?php include_once "../src/components/nav_bar.php";?>
    <?php include_once "../src/Debug.php";?>

    <div id="body">
        <?php
if ($logout_success == true) {
    logout_message_success();
} else {
    error_invalid_page("Cannot log out if not logged in to begin with.");
}
?>
    </div>
</body>

</html>