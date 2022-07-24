<?php
require_once "../src/Header.php";
require_once "../src/Genres.php";
require_once "../src/Query.php";

function edit_game_form($p_dataStorage, $p_errors)
{
    ?>
<div id="edit_game_form">
    <h2>Edit Game</h2>
    <form action="<?php print htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="hidden" name="form_type" value="edit_game">
        <label for="atariTitle">Atari Title<span class="error">*</span>: </label><br>
        <input type="hidden" name="code" value="<?php print value_output($p_dataStorage, "code");?>">
        <input type="text" name="atariTitle" id="atariTitle" placeholder="Adventures of John"
            value="<?php print value_output($p_dataStorage, "atariTitle");?>" maxlength="50" minlength="2"
            required="required" readonly="readonly">
        <?php print_error($p_errors["atariTitle"]);?><br><br>

        <label for="searsTitle">Sears Title: </label><br><input type="text" name="searsTitle" id="searsTitle"
            value="<?php print value_output($p_dataStorage, "searsTitle");?>" maxlength="50" minlength="2"><br><br>

        <label for="code">Code<span class="error">*</span>: </label><br><input type="text" name="code" id="code"
            value="<?php print value_output($p_dataStorage, "code");?>" maxlength="20" minlength="4"
            required="required"><br><br>

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
    "yearReleased" => "",
    "genre" => "");

$dataStorage = array();

if (isset($_SESSION["username"]) == true) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["form_type"]) == false) {

            $q = new Query();
            $results = $q->query_games_by_code($_POST["code"]);

            $results = $results[0];

            $dataStorage["atariTitle"] = test_input($results["atariTitle"]);
            $dataStorage["searsTitle"] = test_input($results["searsTitle"]);
            $dataStorage["code"] = strtoupper(test_input($results["code"]));
            $dataStorage["leadProgrammer"] = test_input($results["leadProgrammer"]);
            $dataStorage["yearReleased"] = test_input($results["yearReleased"]);
            $dataStorage["genre"] = genre_menu_key(test_input($results["genre"]));
            $dataStorage["notes"] = test_input($results["notes"]);
        } else {
            $verify = true;

            $dataStorage["code"] = strtoupper(test_input($_POST["code"]));
            $dataStorage["notes"] = test_input($_POST["notes"]);

            # CHECK FOR ALL
            if ($verify == true) {
                $_SESSION["edit_game"] = $dataStorage;
                require_once "../src/Process.php";
            }
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
    <title>Edit Game | Atari Game Catalog</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css" />
    <style>
    .error {
        color: #FF0000;
    }
    </style>
</head>

<body>
    <?php include_once "../src/components/nav_bar.php";?>
    <?php include_once "../src/Debug.php";?>

    <div id="body">
        <?php
if (isset($_SESSION["username"]) == true) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        edit_game_form($dataStorage, $errors);
    } else {
        error_invalid_page("Please select a game to edit!");
        ?>
        <a href="developers.php">
            <h4>Dashboard</h4>
        </a>
        <?php
}
} else {
    error_invalid_page("Account required!");
}
?>
    </div>
</body>

</html>