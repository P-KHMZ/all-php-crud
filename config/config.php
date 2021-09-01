<?php
    DEFINE('db_user', 'root');
    DEFINE('db_password', '');
    DEFINE('db_host', 'localhost');
    DEFINE('db_name', 'all-crud-php');

    $dbcon = @mysqli_connect(db_host, db_user, db_password, db_name) OR die('Could not connect to the DB:'.mysqli_connect_error());

    mysqli_set_charset($dbcon, 'utf8');
?>