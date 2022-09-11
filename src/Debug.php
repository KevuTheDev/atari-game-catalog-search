<?php
require_once "../config/config.php";
require_once "Header.php";

my_session_start();

if ($GLOBALS["DEBUGMODE"] == true) {
    print "<hr>";
    print "<a href=\"reset.php\">Reset Button</a>";
    print "<div id=\"DEBUG\">";
    print "<h3>DEBUG INFORMATION</h3>";
    //print "<p>GLOBALS</p>";
    //pre_r($GLOBALS);
    print "<p>SESSION</p>";
    pre_r($_SESSION);
    print "</div>";
    print "<hr>";
}