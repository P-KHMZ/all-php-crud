<?php
    session_start();
    if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] !=0))
    {
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member's page</title>
    <style type="text/css">
        #mid-right-col
        {
            text-align: center;
            margin: auto;
        }
        #midcol h3
        {
            font-size: 130%;
            margin-top: 0;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <?php
                echo'<h2>Welcome to member\'s page</h2>';
            ?>
        </div>
    </div>
</body>
</html>