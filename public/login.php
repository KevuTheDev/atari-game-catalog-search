<?php
require_once "../src/Query.php";
require_once "../src/Header.php";

function login_form($username_err, $password_err)
{
    ?>
<div id="create_developer_account">
    <a href="add_developer.php">
        <h2>Create Developer Account</h2>
    </a>
</div>
<div id="login_form">
    <h2>Login</h2>
    <form action="<?php print htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="username"> Username:</label><br>
        <input id="username" type="text" name="username">
        <?php print_error($username_err);?><br><br>

        <label for="password">Password:</label><br>
        <input id="password" type="password" name="password">
        <?php print_error($password_err);?><br><br>

        <input type="submit" name="submit" value="Login">
    </form>
</div>
<?php
}

my_session_start();

$username_err = $password_err = "";

if (isset($_SESSION["username"]) == false) {
    $columns = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $verify = true;

        $columns["username"] = test_input($_POST["username"]);
        $columns["password"] = test_input($_POST["password"]);

        if (empty($columns["username"]) == true) {
            $verify = false;
            $username_err = "Enter a username";
        }

        if (empty($columns["password"]) == true) {
            $verify = false;
            $password_err = "Enter a password";
        }

        if ($verify == true) {
            $q = new Query();
            $result = $q->validate_login($columns["username"], $columns["password"]);
        }
    }
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Atari Game Catalog | CP 476 Project</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css" />
</head>

<body>
    <div id="nav_bar">
        <a href="/">Home</a>
    </div>
    <?php
require_once "../src/Debug.php";

DEBUG_SESSION();
?>

    <div id="body">
        <?php
# Check if developer is logged in
if (isset($_SESSION["username"]) == false) {
    # Check if request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        # This refers higher. Login was successful if $result true.
        if (isset($result) == true) {
            if ($result == true) {
                ###TODO
                #Better page design.
                print "Logging in!!!<br><br>";
                $_SESSION["username"] = $columns["username"];

                # Move to developers.php page
                header("Refresh:1; url=developers.php");
            } else {
                ###TODO
                #Better page design.
                print "INVALID LOGIN!!<br><br>";
            }
        } else {
            login_form($username_err, $password_err);
        }
    } else {
        login_form($username_err, $password_err);
    }
} else {
    error_invalid_page("Aren't you logged in?");
}
?>
    </div>
</body>

</html>