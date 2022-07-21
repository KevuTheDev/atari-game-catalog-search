<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Edit Game | Atari Game Catalog</title>
</head>

<body>
    <div id="nav_bar">
        <a href="/">Home</a>
    </div>
    <?php
require_once "../src/Debug.php";

DEBUG_SESSION();
?>

    <div id="body">
        <?php
require_once "../src/Query.php";
require_once "../src/utils.php";
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Atari Title</th><th>Sears Title</th><th>Code</th><th>Year Released</th><th>Genre</th><th>Notes</th></tr>";

$q = new Query();
$results = $q->query_username_games($_SESSION["username"]);

foreach ($results as $k => $v) {
    print "<tr>";
    $item = new NewRow($v);
    print "</tr>";
}
echo "</table>";

?>

    </div>
</body>

</html>