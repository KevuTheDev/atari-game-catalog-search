<?php
include "../src/utils.php"
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Atari Game Catalog | CP 476 Project</title>
</head>

<header>
</header>

<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $search = $_GET["search"];
            if (empty($search) === False) {
                include "../src/Query.php";
                $search = test_input($search);
                
                echo "<h2>Your Query:</h2>";
                
                echo "Results for \"" . $search . "\"";
                echo "<br><br>";
                echo "<table style='border: solid 1px black;'>";
                echo "<tr><th>Atari Title</th><th>Sears Title</th><th>Code</th><th>Lead Programmer</th><th>Year Released</th><th>Genre</th><th>Notes</th></tr>";
                $q = new Query();
                $q->query_atari_title($search);
                echo "</table>";
            } else {
                // Error when no results
                print "Please make a search query at localhost";
            }
        } else {
            print "Please make a search query at localhost";
        }
    ?>
</body>

<footer>
</footer>

</html>