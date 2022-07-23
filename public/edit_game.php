<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Edit Game | Atari Game Catalog</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css" />
</head>

<body>
    <?php include_once "../src/components/nav_bar.php";?>
    <?php include_once "../src/Debug.php";?>

    <div id="body">
        <?php
require_once "../src/Header.php";
require_once "../src/Query.php";
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Atari Title</th><th>Sears Title</th><th>Code</th><th>Year Released</th><th>Genre</th><th>Notes</th></tr>";

$q = new Query();
$results = $q->query_games_by_username($_SESSION["username"]);

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