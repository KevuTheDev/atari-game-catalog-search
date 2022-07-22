<?php

function genre_menu_key($genre_name)
{
    $output = strtolower($genre_name);
    $output = str_replace(" ", "-", $output);

    return $output;
}

function genre_menu_array($genresArray)
{
    $newGenresArray = array();
    foreach ($genresArray as $value) {
        $newGenresArray[genre_menu_key($value)] = $value;
    }

    return $newGenresArray;
}

function generate_genre_menu($genre_choice, $enabled)
{
    if ($enabled == true) {
        print "Genre<span class=\"error\">*</span>:<br><select name=\"genre\">";
    } else {
        print "Genre<span class=\"error\">*</span>:<br><select disabled=\"disabled\" name=\"genre\">";
    }

    print "<option value=\"\"></option>";

    foreach ($GLOBALS["genresAssociativeArray"] as $key => $value) {
        if ($genre_choice == $key) {
            print "<option selected=\"selected\" value=\"" . $key . "\">" . $value . "</option>\n";
        } else {
            print "<option value=\"" . $key . "\">" . $value . "</option>\n";
        }
    }
    print "</select>";
}

$genres = array("Action", "Adventure", "Educational",
    "Fixed Shooter", "JRPG", "Pinball", "Racing", "RPG", "Side-scroller",
    "Simulation", "Sports", "Strategy", "System Repair", "Traditional");

$genresAssociativeArray = genre_menu_array($GLOBALS["genres"]);