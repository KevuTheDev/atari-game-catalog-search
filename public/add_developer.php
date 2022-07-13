<?php
include_once "../src/Query.php";
include_once "../src/utils.php";

session_start();

$firstname_err = $lastname_err = $username_err = $password_err = $confpassword_err = "";
$columns = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $verify = true;
    $passverify = false;

    $columns["firstname"] = test_input($_POST["firstname"]);
    $columns["lastname"] = test_input($_POST["lastname"]);
    $columns["username"] = test_input($_POST["username"]);
    $columns["password"] = test_input($_POST["password"]);
    $columns["confpassword"] = test_input($_POST["confpassword"]);

    # CHECK FIRST NAME
    if (empty($columns["firstname"]) == true) {
        $verify = false;
        $firstname_err = "First Name is required";
    }

    # CHECK LAST NAME
    if (empty($columns["lastname"]) == true) {
        $verify = false;
        $lastname_err = "Last Name is required";
    }

    # CHECK USERNAME
    if (empty($columns["username"]) == true) {
        $verify = false;
        $username_err = "Username is required";
    } else {
        # Check if username exists in the database;

        $q = new Query();
        $result = $q->check_username($columns["username"]);

        if ($result == 0) {
            $verify = false;
            $username_err = "Username is already in use";
        }
    }

    # CHECK PASSWORD
    if (empty($columns["password"]) == true) {
        $verify = false;
        $password_err = "Password is required";
    } else {
        $passverify = true;
    }

    # CHECK CONFIRM PASSwORD
    if (empty($columns["confpassword"]) == true) {
        $verify = false;
        $confpassword_err = "Confirm Password is required";
    } else {
        # CHECK IF PASSWORD IS NOT EMPTY
        if ($passverify == true) {
            # CHECK IF PASSWORD AND CONFIRM PASSWORD THE SAME
            if (strcmp($columns["password"], $columns["confpassword"]) != 0) {
                $verify = false;
                $confpassword_err = "Confirm Password does not match Password";
            }
        }
    }

    # CHECK FOR ALL
    if ($verify == true) {
        unset($columns["confpassword"]);
        $_SESSION["add_developer"] = $columns;
        require_once "process.php";
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
    <style>
    .error {
        color: #FF0000;
    }
    </style>
</head>

<body>
    <div id="nav_bar">
        <a href="index.php">Home</a>
    </div>

    <div id="body">
        <div id="developer_form">
            <h2>Create Developer Account</h2>
            <form action="add_developer.php" method="post">
                <input type="hidden" name="form_type" value="add_developer">
                First Name<span class="error">*</span>: <br><input type="text" name="firstname"
                    value="<?php print value_output($columns, "firstname");?>"><?php print_error($firstname_err);?><br><br>

                Last Name<span class="error">*</span>: <br><input type="text" name="lastname"
                    value="<?php print value_output($columns, "lastname");?>"><?php print_error($lastname_err);?><br><br>

                Username<span class="error">*</span>: <br><input type="text" name="username"
                    value="<?php print value_output($columns, "username");?>"><?php print_error($username_err);?><br><br>

                Password<span class="error">*</span>: <br><input type="password"
                    name="password"><?php print_error($password_err);?><br><br>

                Confirm Password<span class="error">*</span>: <br><input type="password"
                    name="confpassword"><?php print_error($confpassword_err);?><br><br>

                <input type="submit" name="submit" value="Add">
            </form>
        </div>
    </div>

</body>

</html>