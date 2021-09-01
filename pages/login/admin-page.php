<?php
    session_start();
    if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] !=1))
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
    <title>Administrator page</title>
    <style type="text/css">
        p{
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include('admin-header.php')?>
    <div id="content">
        <?php
            echo'<h2>Welcome to the Administrator page ';
                if(isset($_SESSION['fname']))
                {
                    echo"{$_SESSION['fname']}";
                }
            echo'</h2>';
        ?>
        <div id="midcol">
            <h3>You have the permissions to:</h3>
            <p>&#9632; Use the view members' button to see a table of registered members.</p><p> &nbsp;</p>
            <p>&#9632; Edit and delete the records.</p><p> &nbsp;</p>
            <p>&#9632; Use the search button to locate a particular member.</p><p> &nbsp;</p>
            <p>&#9632; Use the addresses buttin to locate a particular member's address and phone line.</p><p> &nbsp;</p>
        </div>
    </div>
    <div id="footer">
        <?php include('_footer.php')?>
    </div>
</body>
</html>