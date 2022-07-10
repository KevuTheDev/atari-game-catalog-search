<?php
include_once "../src/Query.php";

function process()
{

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $verify = true;
        $columns = array();

        $columns["atariTitle"] = $_POST["atari_title"];
        $columns["searsTitle"] = $_POST["sears_title"];
        $columns["code"] = $_POST["code"];
        $columns["leadProgrammer"] = $_POST["programmer"];
        $columns["yearReleased"] = $_POST["year"];
        $columns["genre"] = $_POST["genre"];
        $columns["notes"] = $_POST["notes"];

        if (empty($columns["atariTitle"]) == true) {
            $verify = false;
            print "Error Atari Title";
            print "<br><br>";
        }

        if (empty($columns["code"]) == true) {
            $verify = false;
            print "Error Code";
            print "<br><br>";
        }

        if (empty($columns["yearReleased"]) == true || is_numeric($columns["yearReleased"]) == false) {
            $verify = false;
            print "Error Year Released";
            print "<br><br>";
        }

        if (empty($columns["genre"]) == true) {
            $verify = false;
            print "Error Genre";
            print "<br><br>";
        }

        if ($verify == true) {
            print "Query<br><br>";
            $q = new Query();
            $q->add_game($columns);

            print "Game Added";
        } else {
            print "DO NOT QUERY";
        }
    } else {
        print "confirmation_error.php";
    }
}
process();