<?php
require_once "../src/Header.php";
require_once "../src/Query.php";
require_once "../src/Genres.php";

session_start();

$atari_title_err = $year_err = $genre_err = "";
$columns = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["form_type"]) == false) {

        $q = new Query();
        $results = $q->query_code($_POST["code"]);

        $results = $results[0];

        $columns["atariTitle"] = test_input($results["atariTitle"]);
        $columns["searsTitle"] = test_input($results["searsTitle"]);
        $columns["code"] = strtoupper(test_input($results["code"]));
        $columns["leadProgrammer"] = test_input($results["leadProgrammer"]);
        $columns["yearReleased"] = test_input($results["yearReleased"]);
        $columns["genre"] = genre_menu_key(test_input($results["genre"]));
        $columns["notes"] = test_input($results["notes"]);
    } else {
        $verify = true;

        $columns["code"] = strtoupper(test_input($_POST["code"]));
        $columns["notes"] = test_input($_POST["notes"]);

        # CHECK FOR ALL
        if ($verify == true) {
            //$columns["genre"] = $GLOBALS["genresAssociativeArray"][$columns["genre"]];
            $_SESSION["edit_game"] = $columns;
            require_once "../src/Process.php";
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
    <title>Edit Game Note | Atari Game Catalog</title>
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
        <div id="edit_game_form">
            <form action="edit_note.php" method="post">
                <input type="hidden" name="form_type" value="edit_game">
                <input type="hidden" name="code" value="<?php print value_output($columns, "code");?>">
                <label for="">Atari Title<span class="error">*</span>: </label><br><input type="text" name="atariTitle"
                    value="<?php print value_output($columns, "atariTitle");?>"
                    disabled="disabled"><?php print_error($atari_title_err);?><br><br>

                Sears Title: <br><input type="text" name="searsTitle"
                    value="<?php print value_output($columns, "searsTitle");?>" disabled="disabled"><br><br>

                Code<span class="error">*</span>: <br><input type="text" name="code"
                    value="<?php print value_output($columns, "code");?>" disabled="disabled"><br><br>

                Lead Programmer: <br><input type="text" name="leadProgrammer"
                    value="<?php print value_output($columns, "leadProgrammer");?>" disabled="disabled"><br><br>

                Year Released<span class="error">*</span>: <br><input type="text" name="yearReleased"
                    value="<?php print value_output($columns, "yearReleased");?>"
                    disabled="disabled"><?php print_error($year_err);?><br><br>

                <?php generate_genre_menu(value_output($columns, "genre"), false);?><br><br>
                <?php print_error($genre_err);?><br><br>

                Notes: <br><textarea type="text"
                    name="notes"><?php print value_output($columns, "notes");?></textarea><br><br>

                <input type="submit" name="submit" value="Edit">
            </form>
        </div>
    </div>
</body>

</html>