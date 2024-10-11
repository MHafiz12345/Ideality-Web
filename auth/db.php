<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ideality_db');

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$con)
{
    echo "Error: Unable to connect to MySQL." . mysqli_connect_error();
}
//echo "Connected successfully";