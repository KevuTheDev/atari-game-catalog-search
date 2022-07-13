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

$genres = array("Action", "Adventure", "Educational",
    "Fixed Shooter", "JRPG", "Pinball", "Racing", "RPG", "Side-scroller",
    "Simulation", "Sports", "Strategy", "System Repair", "Traditional");

$genresAssociativeArray = genre_menu_array($GLOBALS["genres"]);