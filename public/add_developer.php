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
        <div id="developer_form">
            <h2>Create Developer Account</h2>
            <form action="confirmation.php" method="post">
                <input type="hidden" name="form_type" value="add_developer">
                First Name*: <br><input type="text" name="firstname"><br><br>
                Last Name*: <br><input type="text" name="lastname"><br><br>
                Username*: <br><input type="text" name="username"><br><br>
                Password*: <br><input type="text" name="password"><br><br>
                <input type="submit" name="submit" value="Add">
            </form>
        </div>
    </div>

</body>

</html>