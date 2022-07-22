<?php
require_once "../src/Query.php";
require_once "../src/Header.php";

function developer_form($p_dataStorage, $p_errors)
{
    ?>
<div id="developer_form">
    <h2>Create Developer Account</h2>
    <form action="add_developer.php" method="post">
        <input type="hidden" name="form_type" value="add_developer">
        <label for="firstname">First Name</label><span class="error">*</span>: <br>
        <input type="text" name="firstname" id="firstname"
            value="<?php print value_output($p_dataStorage, "firstname");?>"><?php print_error($p_errors["firstname"]);?><br><br>

        <label for="lastname">Last Name</label><span class="error">*</span>: <br>
        <input type="text" name="lastname" id="lastname"
            value="<?php print value_output($p_dataStorage, "lastname");?>"><?php print_error($p_errors["lastname"]);?><br><br>

        <label for="username">Username</label><span class="error">*</span>: <br>
        <input type="text" name="username" id="username"
            value="<?php print value_output($p_dataStorage, "username");?>"><?php print_error($p_errors["username"]);?><br><br>

        <label for="password">Password</label><span class="error">*</span>: <br>
        <input type="password" id="password" name="password"><?php print_error($p_errors["password"]);?><br><br>

        <label for="confpassword">Confirm Password</label><span class="error">*</span>: <br>
        <input type="password" id="confpassword"
            name="confpassword"><?php print_error($p_errors["confpassword"]);?><br><br>

        <input type="submit" name="submit" value="Create Account">
    </form>
</div>
<?php
}

my_session_start();

$errors = array("firstname" => "",
    "lastname" => "",
    "username" => "",
    "password" => "",
    "confpassword" => "");

$dataStorage = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $verify = true;
    $passverify = false;

    $dataStorage["firstname"] = test_input($_POST["firstname"]);
    $dataStorage["lastname"] = test_input($_POST["lastname"]);
    $dataStorage["username"] = strtolower(test_input($_POST["username"]));
    $dataStorage["password"] = test_input($_POST["password"]);
    $dataStorage["confpassword"] = test_input($_POST["confpassword"]);

    # CHECK FIRST NAME
    if (empty($dataStorage["firstname"]) == true) {
        $verify = false;
        $errors["firstname"] = "First Name is required";
    }

    # CHECK LAST NAME
    if (empty($dataStorage["lastname"]) == true) {
        $verify = false;
        $errors["lastname"] = "Last Name is required";
    }

    # CHECK USERNAME
    if (empty($dataStorage["username"]) == true) {
        $verify = false;
        $errors["username"] = "Username is required";
    } else {
        # Check if username exists in the database;
        $q = new Query();
        $result = $q->check_username($dataStorage["username"]);

        if ($result == 0) {
            $verify = false;
            $errors["username"] = "Username is already in use";
        }
    }

    # CHECK PASSWORD
    if (empty($dataStorage["password"]) == true) {
        $verify = false;
        $errors["password"] = "Password is required";
    } else {
        $passverify = true;
    }

    # CHECK CONFIRM PASSwORD
    if (empty($dataStorage["confpassword"]) == true) {
        $verify = false;
        $errors["confpassword"] = "Confirm Password is required";
    } else {
        # CHECK IF PASSWORD IS NOT EMPTY
        if ($passverify == true) {
            # CHECK IF PASSWORD AND CONFIRM PASSWORD THE SAME
            if (strcmp($dataStorage["password"], $dataStorage["confpassword"]) != 0) {
                $verify = false;
                $errors["confpassword"] = "Confirm Password does not match Password";
            }
        }
    }

    # CHECK FOR ALL
    if ($verify == true) {
        unset($dataStorage["confpassword"]);
        $_SESSION["add_developer"] = $dataStorage;
        require_once "../src/Process.php";
    }
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Create Developer Account | Atari Game Catalog</title>
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
        <?php
if (isset($_SESSION["username"]) == false) {
    developer_form($dataStorage, $errors);
} else {
    error_invalid_page("Aren't you logged in?");
}
?>
    </div>
</body>

</html>