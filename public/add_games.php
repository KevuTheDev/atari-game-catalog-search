<?php
require_once "../src/Genres.php";
require_once "../src/Query.php";
require_once "../src/utils.php";

session_start();

$atari_title_err = $code_err = $year_err = $genre_err = "";
$columns = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $verify = true;

    $columns["atariTitle"] = test_input($_POST["atariTitle"]);
    $columns["searsTitle"] = test_input($_POST["searsTitle"]);
    $columns["code"] = strtoupper(test_input($_POST["code"]));
    $columns["leadProgrammer"] = test_input($_POST["leadProgrammer"]);
    $columns["yearReleased"] = test_input($_POST["yearReleased"]);
    $columns["genre"] = test_input($_POST["genre"]);
    $columns["notes"] = test_input($_POST["notes"]);

    # CHECK TITLE IS NOT EMPTY
    if (empty($columns["atariTitle"]) == true) {
        $verify = false;
        $atari_title_err = "Atari Title is required";
    }

    #CHECK CODE IS NOT EMPTY
    if (empty($columns["code"]) == true) {
        $verify = false;
        $code_err = "Code is required";
    } else {
        # ALSO CHECK FOR DUPLICATE CODE IN DATABASE
        # MUST DO A DATABASE QUERY FOR CHECK

        $q = new Query();
        $result = $q->check_code($columns["code"]);

        if ($result == 0) {
            $verify = false;
            $code_err = "Code is already in use";
        }
    }

    # CHECK YEAR IS NOT EMPTY, IS NUMERIC, AND WITHIN RANGE
    if (empty($columns["yearReleased"]) == true) {
        $verify = false;
        $year_err = "Year Released is required";
    } else {
        if (is_numeric($columns["yearReleased"]) == false) {
            $verify = false;
            $year_err = "Year Released must be numeric value";
        } else {
            $temp_year = date("Y");
            $temp_year = (int) $temp_year;

            if (!($columns["yearReleased"] > 0 && $columns["yearReleased"] <= $temp_year)) {
                $verify = false;
                $year_err = "Year Released must be 1 - " . $temp_year;
            }
        }
    }

    # CHECK GENRE IS NOT EMPTY
    if (empty($columns["genre"]) == true) {
        $verify = false;
        $genre_err = "Genre is required";
    }

    # CHECK FOR ALL
    if ($verify == true) {
        $columns["genre"] = $GLOBALS["genresAssociativeArray"][$columns["genre"]];
        $_SESSION["add_game"] = $columns;
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
    <?php
require_once "../src/Debug.php";

DEBUG_SESSION();
?>

    <div id="body">
        <div id="game_form">
            <h2>Add Games</h2>
            <form action="add_games.php" method="post">
                <input type="hidden" name="form_type" value="add_game">
                Atari Title<span class="error">*</span>: <br><input type="text" name="atariTitle"
                    placeholder="Adventures of John"
                    value="<?php print value_output($columns, "atariTitle");?>"><?php print_error($atari_title_err);?><br><br>

                Sears Title: <br><input type="text" name="searsTitle"
                    value="<?php print value_output($columns, "searsTitle");?>"><br><br>

                Code<span class="error">*</span>: <br><input type="text" name="code"
                    value="<?php print value_output($columns, "code");?>"><?php print_error($code_err);?><br><br>

                Lead Programmer: <br><input type="text" name="leadProgrammer"
                    value="<?php print value_output($columns, "leadProgrammer");?>"><br><br>

                Year Released<span class="error">*</span>: <br><input type="text" name="yearReleased"
                    value="<?php print value_output($columns, "yearReleased");?>"><?php print_error($year_err);?><br><br>

                <?php generate_genre_menu(value_output($columns, "genre"), true);?>
                <?php print_error($genre_err);?><br><br>
                Notes: <br><textarea type="text"
                    name="notes"><?php print value_output($columns, "notes");?></textarea><br><br>

                <input type="submit" name="submit" value="Add">
            </form>
        </div>
    </div>

</body>

</html>