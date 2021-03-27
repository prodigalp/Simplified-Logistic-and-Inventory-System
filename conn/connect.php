<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PSWD', '');
define('DB_BASE', 'dblogic');

$CON = @mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_BASE);
if (!$CON) {
    die('Could not connect to the server' . mysqli_connect_error());
}
