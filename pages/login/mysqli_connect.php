<?php
    DEFINE('DB_USER','root');
    DEFINE('DB_PASSWORD','');
    DEFINE('DB_HOST','localhost');
    // DEFINE('DB_NAME','admintable');
    DEFINE('DB_NAME', 'logindb');

    $con = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die("Cannot connect to the database due to:".mysqli_error());
    mysqli_set_charset($con, 'utf8');

?>