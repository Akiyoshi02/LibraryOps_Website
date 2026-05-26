<?php

try
{
    $conn = mysqli_connect("localhost", "root", "", "php_project");
}

catch(mysqli_sql_exception)
{
    echo "Couldn't connect to database";
}


?>
