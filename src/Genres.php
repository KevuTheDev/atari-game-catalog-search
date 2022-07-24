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
        ?>
<label for="genre">Genre<span class="error">*</span>: </label><br><select name="genre" id="genre" required="required">;
    <?php
} else {
        ?>
    <label for="genre">Genre<span class="error">*</span>: </label><br><select disabled="disabled" name="genre"
        id="genre" required="required"> <?php
}

    print "<option value=\"\">-Select an option-</option>";

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