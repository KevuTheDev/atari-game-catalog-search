<!DOCTYPE HTML>
<html>

<head>
    <style>
    .error {
        color: #FF0000;
    }
    </style>
</head>

<body>
    <?php
        // define variables and set to empty values
        $nameErr = "";
        $name = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Atari Game is required";
            } else {
                $name = test_input($_POST["name"]);
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

    <h2>Query: Atari Game Search</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <span class="error">*</span>Atari Game: <input type="text" name="name">
        <span class="error"><?php echo $nameErr;?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
        echo "<h2>Your Query:</h2>";
        if (empty($name) == false) {
            include "Query.php";
            echo "Results for \"" . $name . "\"";
            echo "<br><br>";
            echo "<table style='border: solid 1px black;'>";
            echo "<tr><th>Atari Title</th><th>Sears Title</th><th>Code</th><th>Lead Programmer</th><th>Year Released</th><th>Genre</th><th>Notes</th></tr>";
            $q = new Query();
            $q->query_atari_title($name);
            echo "</table>";
        }
    ?>
</body>

</html>