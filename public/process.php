<?php
include_once "../src/Genres.php";
include_once "../src/Query.php";
include_once "../src/utils.php";

function add_game()
{
    $q = new Query();
    $result = $q->add_game($_SESSION["add_game"]);

    session_unset();
    $_SESSION["form_type"] = "add_game";

    if ($result == true) {
        $_SESSION["confirmation"] = "valid";
    } else {
        $_SESSION["confirmation"] = "invalid";
    }
    header("Refresh:3; url=confirmation.php");
}

function add_developer()
{
    $q = new Query();
    $result = $q->add_developer($_SESSION["add_developer"]);

    session_unset();
    $_SESSION["form_type"] = "add_developer";
    $result = true;

    if ($result == true) {
        $_SESSION["confirmation"] = "valid";
    } else {
        $_SESSION["confirmation"] = "invalid";
    }
    header("Refresh:3; url=confirmation.php");
}

function process()
{
    if (isset($_SESSION["add_game"]) == true) {
        if (empty($_SESSION["add_game"]) == false) {
            add_game();
        }
    } else if (isset($_SESSION["add_developer"]) == true) {
        if (empty($_SESSION["add_developer"]) == false) {
            add_developer();
        }
    } else {
        print "OH NO";
    }
}

process();