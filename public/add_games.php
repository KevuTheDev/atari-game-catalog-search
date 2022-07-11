<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Atari Game Catalog | CP 476 Project</title>
</head>

<body>
    <div id="nav_bar">
        <a href="index.php">Home</a>
    </div>

    <div id="body">
        <div id="game_form">
            <h2>Add Games</h2>
            <form action="process.php" method="post">
                Atari Title*: <br><input type="text" name="atari_title"><br><br>
                Sears Title: <br><input type="text" name="sears_title"><br><br>
                Code*: <br><input type="text" name="code"><br><br>
                Lead Programmer: <br><input type="text" name="programmer"><br><br>
                Year Released*: <br><input type="text" name="year"><br><br>
                Genre*: <br><input type="text" name="genre"><br><br>
                Notes: <br><textarea type="text" name="notes"></textarea><br><br>
                <input type="submit" name="submit" value="Add">
            </form>
        </div>
    </div>


</body>

</html>