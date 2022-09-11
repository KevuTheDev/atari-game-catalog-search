<?php
require_once "../src/Header.php";

my_session_start();
?>

<nav class="padding-1" style="background-color:#4A4E69;">
    <div id="nav_bar" class="flex-wrap d-flex">
        <ul class="nav nav-right-auto">
            <li><a class="nav-link" href="index.php">
                    <h3 style="color: #F2E9E4">Home</h3>
                </a></li>
            <li><a class="nav-link" href="search.php">
                    <h3 style="color: #F2E9E4">Search Catalog</h3>
                </a></li>
        </ul>
        <ul class="nav">
            <?php
if (isset($_SESSION["username"]) == true) {
    print "<li><a class=\"nav-link\" href=\"developers.php\"><h3 style=\"color: #F2E9E4\">Developer Dashboard</h3></a></li>";
} else {
    print "<li><a class=\"nav-link\" href=\"login.php\"><h3 style=\"color: #F2E9E4\">Login</h3></a></li>";
}
?>
        </ul>
    </div>
</nav>
<hr>