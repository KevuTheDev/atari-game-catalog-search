<?php
require_once "../config/config.php";
require_once "utils.php";

function DEBUG_SESSION()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if ($GLOBALS["DEBUGMODE"] == true) {
        print "<hr>";
        print "<div id=\"DEBUG\">";
        print "<h3>DEBUG INFORMATION</h3>";
        //print "<p>GLOBALS</p>";
        //pre_r($GLOBALS);
        print "<p>SESSION</p>";
        pre_r($_SESSION);
        print "</div>";
        print "<hr>";
    }
}