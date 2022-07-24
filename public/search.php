<?php
require_once "../src/Header.php";

function get_query()
{
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET["search"]) == true) {
            $search = test_input($_GET["search"]);
            return $search;
        }
        return "";
    }
    return "";
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Search | Atari Game Catalog</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css" />
</head>

<body>
    <?php include_once "../src/components/nav_bar.php";?>
    <?php include_once "../src/Debug.php";?>

    <div id="body">
        <div id="search_bar">
            <h2>Search Bar</h2>
            <form action="<?php print htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
                <input type="search" name="search" value="<?php print get_query();?>" required="required">
                <input type="submit" name="submit" value="Search">
            </form>
        </div>
        <div id="query">
            <?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["search"]) == true) {
        $search = $_GET["search"];
        require_once "../src/Query.php";
        if (empty($search) === false) {
            $search = test_input($search);

            echo "<h2>Your Query:</h2>";

            echo "Results for \"" . $search . "\".";
            echo "<br><br>";
            echo "<table style='border: solid 1px black;'>";
            echo "<tr><th>Atari Title</th><th>Sears Title</th><th>Code</th><th>Lead Programmer</th><th>Year Released</th><th>Genre</th><th>Notes</th></tr>";
            $q = new Query();
            $q->query_general_search($search);
            echo "</table>";
        }
    }
} else {
    print "Please make a search query at localhost";
}
?>
        </div>
    </div>
</body>

</html>