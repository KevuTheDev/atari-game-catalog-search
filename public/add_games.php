<?php
require_once "../src/Header.php";
require_once "../src/Genres.php";
require_once "../src/Query.php";

my_session_start();

$errors = array("atariTitle" => "",
    "code" => "",
    "yearReleased" => "",
    "genre" => "");

$atari_title_err = $code_err = $year_err = $genre_err = "";
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

    # CHECK TITLE IS NOT EMPTY
    if (empty($dataStorage["atariTitle"]) == true) {
        $verify = false;
        $atari_title_err = "Atari Title is required";
        $errors["atariTitle"] = "Atari Title is required";
    }

    #CHECK CODE IS NOT EMPTY
    if (empty($dataStorage["code"]) == true) {
        $verify = false;
        $code_err = "Code is required";
        $errors["code"] = "Code is required";
    } else {
        # ALSO CHECK FOR DUPLICATE CODE IN DATABASE
        # MUST DO A DATABASE QUERY FOR CHECK

        $q = new Query();
        $result = $q->check_code($dataStorage["code"]);

        if ($result == 0) {
            $verify = false;
            $code_err = "Code is already in use";
            $errors["code"] = "Code is already in use";
        }
    }

    # CHECK YEAR IS NOT EMPTY, IS NUMERIC, AND WITHIN RANGE
    if (empty($dataStorage["yearReleased"]) == true) {
        $verify = false;
        $year_err = "Year Released is required";
        $errors["yearReleased"] = "Year Released is required";
    } else {
        if (is_numeric($dataStorage["yearReleased"]) == false) {
            $verify = false;
            $year_err = "Year Released must be numeric value";
            $errors["yearReleased"] = "Year Released must be numeric value";
        } else {
            $temp_year = date("Y");
            $temp_year = (int) $temp_year;

            if (!($dataStorage["yearReleased"] > 0 && $dataStorage["yearReleased"] <= $temp_year)) {
                $verify = false;
                $year_err = "Year Released must be 1 - " . $temp_year;
                $errors["yearReleased"] = "Year Released must be 1 - " . $temp_year;
            }
        }
    }

    # CHECK GENRE IS NOT EMPTY
    if (empty($dataStorage["genre"]) == true) {
        $verify = false;
        $genre_err = "Genre is required";
        $errors["genre"] = "Genre is required";
    }

    # CHECK FOR ALL
    if ($verify == true) {
        $dataStorage["genre"] = $GLOBALS["genresAssociativeArray"][$dataStorage["genre"]];
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
    <title>Atari Game Catalog | CP 476 Project</title>
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
function game_form($p_dataStorage, $p_errors)
{
    ?>
        <div id="game_form">
            <h2>Add Games</h2>
            <form action="add_games.php" method="post">
                <input type="hidden" name="form_type" value="add_game">
                Atari Title<span class="error">*</span>: <br><input type="text" name="atariTitle"
                    placeholder="Adventures of John"
                    value="<?php print value_output($p_dataStorage, "atariTitle");?>"><?php print_error($p_errors["atariTitle"]);?><br><br>

                Sears Title: <br><input type="text" name="searsTitle"
                    value="<?php print value_output($p_dataStorage, "searsTitle");?>"><br><br>

                Code<span class="error">*</span>: <br><input type="text" name="code"
                    value="<?php print value_output($p_dataStorage, "code");?>"><?php print_error($p_errors["code"]);?><br><br>

                Lead Programmer: <br><input type="text" name="leadProgrammer"
                    value="<?php print value_output($p_dataStorage, "leadProgrammer");?>"><br><br>

                Year Released<span class="error">*</span>: <br><input type="text" name="yearReleased"
                    value="<?php print value_output($p_dataStorage, "yearReleased");?>"><?php print_error($p_errors["yearReleased"]);?><br><br>

                <?php generate_genre_menu(value_output($p_dataStorage, "genre"), true);?>
                <?php print_error($p_errors["genre"]);?><br><br>
                Notes: <br><textarea type="text"
                    name="notes"><?php print value_output($p_dataStorage, "notes");?></textarea><br><br>

                <input type="submit" name="submit" value="Add">
            </form>
        </div>
        <?php
}
game_form($dataStorage, $errors);
?>
    </div>

</body>

</html>