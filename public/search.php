<?php
include_once "../src/utils.php";

function search()
{
    return "search.php";
}

function get_query()
{
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $search = $_GET["search"];
        return $search;
    }
    return "my query";
}
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
    <div id="nav_bar">
        <a href="index.php">Home</a>
    </div>
    <div id="body">

        <div id="search_bar">
            <h2>Search Bar</h2>
            <form action="<?php print search();?>" method="get">
                <input type="text" name="search" value="<?php print get_query();?>">
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
        <div id="query">
            <?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $search = $_GET["search"];
    if (empty($search) === false) {
        include "../src/Query.php";
        $search = test_input($search);

        echo "<h2>Your Query:</h2>";

        echo "Results for \"" . $search . "\"";
        echo "<br><br>";
        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>Atari Title</th><th>Sears Title</th><th>Code</th><th>Lead Programmer</th><th>Year Released</th><th>Genre</th><th>Notes</th></tr>";
        $q = new Query();
        $q->query_general_search($search);
        echo "</table>";
    } else {
        // Error when no results
        //print "Please make a search query at localhost";
        print "<h1 style=\"color:red\">THIS IS TEST FEATURE</h1>";
        print "<h1 style=\"color:red\">THIS WILL NOT OUTPUT FULL TABLE</h1>";

        include "../src/Query.php";
        $search = test_input($search);

        echo "<h2>Your Query:</h2>";

        echo "Querying all games";
        echo "<br><br>";
        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>Atari Title</th><th>Sears Title</th><th>Code</th><th>Lead Programmer</th><th>Year Released</th><th>Genre</th><th>Notes</th></tr>";
        $q = new Query();
        $q->query_all();
        echo "</table>";
    }
} else {
    print "Please make a search query at localhost";
}
?>
        </div>
    </div>
</body>

<footer>
</footer>

</html>