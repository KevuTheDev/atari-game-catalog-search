<?php

function error_invalid_page($message)
{
    print "<h2>Invalid Page Request</h2>";
    print "<p>" . (string) $message . "</p>";
}