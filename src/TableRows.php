<?php
require_once "utils.php";

class TableRows extends RecursiveIteratorIterator
{
    public function __construct($it)
    {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    public function current(): string
    {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current() . "</td>";
    }

    public function beginChildren(): void
    {
        echo "<tr>";
    }

    public function endChildren(): void
    {
        echo "</tr>" . "\n";
    }
}

class TableRowsEdit extends RecursiveIteratorIterator
{
    public function __construct($it)
    {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    public function current(): string
    {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current() . "</td>";
    }

    public function beginChildren(): void
    {
        echo "<tr>";
    }

    public function endChildren(): void
    {
        echo "</tr>" . "\n";
    }
}

class NewRow
{
    public function __construct($array)
    {
        $results = $this->print_array($array);
    }

    private function print_array($array)
    {
        #pre_r($array);

        $tdStyle = "<td style='width:150px;border:1px solid black;'>";

        foreach ($array as $value) {
            print $tdStyle . $value . "</td>" . "\n";
        }

        print "<td>";
        print "<form action=\"edit_game.php\" method=\"post\">";
        print "<input type=\"hidden\" name=\"code\" value=\"" . $array["code"] . "\">";
        print "<input type=\"submit\" name=\"submit\" value=\"Edit\">";
        print "</form>";
        print "</td>";
    }
}