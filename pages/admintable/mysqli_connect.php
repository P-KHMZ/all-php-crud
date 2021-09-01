<?php
    DEFINE('DB_USER','root');
    DEFINE('DB_HOST', 'localhost');
    DEFINE('DB_PASSWORD', '');
    DEFINE('DB_NAME', 'admintable');

    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not be connected to the database:'.mysqli_error());
    mysqli_set_charset($con, 'utf8');
?>