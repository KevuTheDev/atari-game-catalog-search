<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Kevin He">
    <title>Atari Game Catalog | CP 476 Project</title>
</head>

<body>
    <header>
    </header>


    <h2>Add Games</h2>
    <form action="confirmation.php" method="post">
        Atari Title*: <br><input type="text" name="atari_title"><br><br>
        Sears Title: <br><input type="text" name="sears_title"><br><br>
        Code*: <br><input type="text" name="code"><br><br>
        Lead Programmer*: <br><input type="text" name="programmer"><br><br>
        Year Released*: <br><input type="text" name="year"><br><br>
        Genre*: <br><input type="text" name="genre"><br><br>
        Notes: <br><textarea type="text" name="notes"></textarea><br>
        <input type="submit" name="submit" value="Add">
    </form>


    <footer>
    </footer>
</body>

</html>