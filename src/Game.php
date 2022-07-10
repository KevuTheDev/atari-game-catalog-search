<?php

class Game
{
    private $atari_title; #*
    private $sears_title;
    private $code; #*
    private $programmer;
    private $year; #*
    private $genre; #*
    private $notes;

    public function __construct($p_atari_title, $p_code, $p_year, $p_genre)
    {
        $this->$atari_title = $p_atari_title;
        $this->$code = $p_code;
        $this->$year = $p_year;
        $this->$genre = $p_genre;
    }

    public function set_sears_title($p_sears_title)
    {
        if (empty($p_sears_title) == False) {
            $this->$sears_title = $p_sears_title;
        }
    }

    public function set_programmer($p_programmer)
    {
        $this->$programmer = $p_programmer;
    }

    public function set_notes($p_notes)
    {
        $this->$notes = $p_notes;
    }
}