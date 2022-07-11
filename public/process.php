<?php
include_once "../src/Query.php";
include_once "../src/utils.php";

function process()
{

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $verify = true;
        $columns = array();
        $atari_title_err = $code_err = $year_err = $genre_err = "";

        $columns["atariTitle"] = test_input($_POST["atari_title"]);
        $columns["searsTitle"] = test_input($_POST["sears_title"]);
        $columns["code"] = test_input($_POST["code"]);
        $columns["leadProgrammer"] = test_input($_POST["programmer"]);
        $columns["yearReleased"] = test_input($_POST["year"]);
        $columns["genre"] = test_input($_POST["genre"]);
        $columns["notes"] = test_input($_POST["notes"]);

        if (empty($columns["atariTitle"]) == true) {
            $verify = false;
            $atari_title_err = "Atari Title is required";
            print "Error Atari Title";
            print "<br><br>";
        }

        if (empty($columns["code"]) == true) {
            $verify = false;
            $code_err = "Code is required";
            print "Error Code";
            print "<br><br>";
        }

        if (empty($columns["yearReleased"]) == true || is_numeric($columns["yearReleased"]) == false) {
            $verify = false;
            $year_err = "Year Released is required";
            print "Error Year Released";
            print "<br><br>";
        }

        if (empty($columns["genre"]) == true) {
            $verify = false;
            $genre_err = "Genre is required";
            print "Error Genre";
            print "<br><br>";
        }

        if ($verify == true) {
            $q = new Query();
            print "Processing<br><br>";
            $results = $q->add_game($columns);

            if ($results == true) {
                print "Game added.<br><br>";
                header("Refresh:3; url=confirmation.php");
                #header('Location: confirmation.php');
            } else {
                print "Game was not added.<br><br>";
                header("Refresh:3; url=confirmation_error.php");
                #header('Location: confirmation_error.php');
            }

        } else {
            print "DO NOT QUERY";
        }
    } else {
        print "confirmation_error.php";
    }
}
process();