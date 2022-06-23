<?php

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
      parent::__construct($it, self::LEAVES_ONLY);
    }
  
    function current() : string {
      return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }
  
    function beginChildren() : void {
      echo "<tr>";
    }
  
    function endChildren() : void {
      echo "</tr>" . "\n";
    }
  }

?>
