<?php
require_once "../src/Header.php";
require_once "../src/Query.php";

function login_form($p_errors)
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
        <label for="username">Username:</label><br>
        <input id="username" type="text" name="username" maxlength="100" minlength="1" required="required">
        <?php print_error($p_errors["username"]);?><br><br>

        <label for="password">Password:</label><br>
        <input id="password" type="password" name="password" maxlength="100" minlength="1" required="required">
        <?php print_error($p_errors["password"]);?><br><br>

        <input type="submit" name="submit" value="Login">
    </form>
</div>
<?php
}

my_session_start();

$errors = array("username" => "", "password" => "");

if (isset($_SESSION["username"]) == false) {
    $dataStorage = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $verify = true;

        $dataStorage["username"] = test_input($_POST["username"]);
        $dataStorage["password"] = test_input($_POST["password"]);

        # CHECK USERNAME
        if (empty($dataStorage["username"]) == true) {
            $verify = false;
            $errors["username"] = "Enter a username";
        }
        # CHECK PASSWORD
        if (empty($dataStorage["password"]) == true) {
            $verify = false;
            $errors["password"] = "Enter a password";
        }

        if ($verify == true) {
            $q = new Query();
            $result = $q->validate_login($dataStorage["username"], $dataStorage["password"]);
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
    <title>Login | Atari Game Search</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css" />
</head>

<body>
    <?php include_once "../src/components/nav_bar.php";?>
    <?php include_once "../src/Debug.php";?>

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
                $_SESSION["username"] = $dataStorage["username"];

                //$_SESSION["active_dev"] = 1;

                # Move to developers.php page
                header("Refresh:1; url=developers.php");
            } else {
                login_form($errors);
                ###TODO
                #Better page design.
                print "<h3 class=\"error\">INVALID LOGIN!!</h3><br><br>";
            }
        } else {
            login_form($errors);
        }
    } else {
        login_form($errors);
    }
} else {
    error_invalid_page("Aren't you logged in?");
}
?>
    </div>
</body>

</html>