<?php
require_once "../src/Header.php";
require_once "../src/Genres.php";
require_once "../src/Query.php";

function game_form($p_dataStorage, $p_errors)
{
    ?>
<div id="game_form">
    <h2>Add Game</h2>
    <form action="<?php print htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="hidden" name="form_type" value="add_game">
        <label for="atariTitle">Atari Title<span class="error">*</span>: </label><br>
        <input type="text" name="atariTitle" id="atariTitle" placeholder="Adventures of John"
            value="<?php print value_output($p_dataStorage, "atariTitle");?>" maxlength="50" minlength="2"
            required="required">
        <?php print_error($p_errors["atariTitle"]);?><br><br>

        <label for="searsTitle">Sears Title: </label><br><input type="text" name="searsTitle" id="searsTitle"
            value="<?php print value_output($p_dataStorage, "searsTitle");?>" maxlength="50" minlength="2"><br><br>

        <label for="code">Code<span class="error">*</span>: </label><br><input type="text" name="code" id="code"
            value="<?php print value_output($p_dataStorage, "code");?>" maxlength="20" minlength="4"
            required="required">
        <?php print_error($p_errors["code"]);?><br><br>

        <label for="leadProgrammer">Lead Programmer: </label><br><input type="text" name="leadProgrammer"
            id="leadProgrammer" value="<?php print value_output($p_dataStorage, "leadProgrammer");?>" maxlength="50"
            minlength="2"><br><br>

        <label for="yearReleased">Year Released<span class="error">*</span>: </label><br><input type="number"
            name="yearReleased" id="yearReleased" value="<?php print value_output($p_dataStorage, "yearReleased");?>"
            max="2022" min="1" required="required">
        <?php print_error($p_errors["yearReleased"]);?><br><br>

        <?php generate_genre_menu(value_output($p_dataStorage, "genre"), true);?>
        <?php print_error($p_errors["genre"]);?><br><br>

        <label for="notes">Notes: </label><br><textarea type="text"
            name="notes"><?php print value_output($p_dataStorage, "notes");?></textarea><br><br>

        <input type="submit" name="submit" value="Add Game">
    </form>
</div>
<?php
}

my_session_start();

$errors = array("atariTitle" => "",
    "code" => "",
    "yearReleased" => "",
    "genre" => "");
$dataStorage = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $verify = true;

    $dataStorage["atariTitle"] = test_input($_POST["atariTitle"]);
    $dataStorage["searsTitle"] = test_input($_POST["searsTitle"]);
    $dataStorage["code"] = strtoupper(test_input($_POST["code"]));
    $dataStorage["leadProgrammer"] = test_input($_POST["leadProgrammer"]);
    $dataStorage["yearReleased"] = test_input($_POST["yearReleased"]);
    $dataStorage["genre"] = test_input($_POST["genre"]);
    $dataStorage["notes"] = test_input($_POST["notes"]);
    $dataStorage["username"] = $_SESSION["username"];

    # CHECK TITLE IS NOT EMPTY
    if (empty($dataStorage["atariTitle"]) == true) {
        $verify = false;
        $errors["atariTitle"] = "Atari Title is required";
    }

    #CHECK CODE IS NOT EMPTY
    if (empty($dataStorage["code"]) == true) {
        $verify = false;
        $errors["code"] = "Code is required";
    } else {
        # ALSO CHECK FOR DUPLICATE CODE IN DATABASE
        # MUST DO A DATABASE QUERY FOR CHECK

        $q = new Query();
        $result = $q->check_code_exists($dataStorage["code"]);

        if ($result == 0) {
            $verify = false;
            $errors["code"] = "Code is already in use";
        }
    }

    # CHECK YEAR IS NOT EMPTY, IS NUMERIC, AND WITHIN RANGE
    if (empty($dataStorage["yearReleased"]) == true) {
        $verify = false;
        $errors["yearReleased"] = "Year Released is required";
    } else {
        if (is_numeric($dataStorage["yearReleased"]) == false) {
            $verify = false;
            $errors["yearReleased"] = "Year Released must be numeric value";
        } else {
            $temp_year = date("Y");
            $temp_year = (int) $temp_year;

            if (!($dataStorage["yearReleased"] > 0 && $dataStorage["yearReleased"] <= $temp_year)) {
                $verify = false;
                $errors["yearReleased"] = "Year Released must be 1 - " . $temp_year;
            }
        }
    }

    # CHECK GENRE IS NOT EMPTY
    if (empty($dataStorage["genre"]) == true) {
        $verify = false;
        $errors["genre"] = "Genre is required";
    }

    # CHECK FOR ALL
    if ($verify == true) {
        $dataStorage["genre"] = $GLOBALS["genresAssociativeArray"][$dataStorage["genre"]];
        $dataStorage["username"] = $_SESSION["username"];
        $_SESSION["add_game"] = $dataStorage;
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
    <title>Add Game | Atari Game Search</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css" />
</head>

<body>
    <?php include_once "../src/components/nav_bar.php";?>
    <?php include_once "../src/Debug.php";?>

    <div id="body">
        <?php
if (isset($_SESSION["username"]) == true) {
    game_form($dataStorage, $errors);
} else {
    error_invalid_page("Must be logged in to add games.");
}
?>
    </div>

</body>

</html>