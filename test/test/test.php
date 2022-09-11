<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Atari Game Search | CP 476 Project</title>
</head>

<body>
    <a href="#">Home</a>
    <h1>This is a header. :)</h1>
    <?php
include_once "../../src/utils.php";

$fnameErr = $lnameErr = $usernameErr = $passwordErr = "";
$fname = $lname = $username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstname"]) == true) {
        $fnameErr = "First name is required";
    } else {
        $fname = test_input($_POST["firstname"]);
    }

    if (empty($_POST["lastname"]) == true) {
        $lnameErr = "Last name is required";
    } else {
        $lname = test_input($_POST["lastname"]);
    }

    if (empty($_POST["username"]) == true) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
    }

    if (empty($_POST["password"]) == true) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }
}

?>
    <?php
$valid = true;
if ($valid == true) {
    print "<form action=\"test.php\" method=\"post\">"
        . "First Name*: <br><input type=\"text\" name=\"firstname\"><br><br>"
        . "Last Name*: <br><input type=\"text\" name=\"lastname\"><br><br>"
        . "Username*: <br><input type=\"text\" name=\"username\"><br><br>"
        . "Password*: <br><input type=\"text\" name=\"password\"><br><br>"
        . "<input type=\"submit\" name=\"submit\" value=\"Add\">"
        . "</form>";
}
?>
</body>


</html>