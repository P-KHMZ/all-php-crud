<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete form</title>
    <style style="text/css"> 
        p
        {
            text-align:center;
            
        }
        form{text-align:center}
        input, fl-left{float:left}
        #submit-yes{float:left; margin-left: 220px}
        #submit-no{float:left; margin-left:20px}
    </style>
</head>
<body>
    <div id="container">
        <h2>Delete Records</h2>
        <?php
            if((isset($_GET['id'])) && (is_numeric($_GET['id'])) )
            {
                $id = $_GET['id'];
            }
            elseif( (isset($_POST['id'])) && (is_numeric($_POST['id'])))
            {
                $id= $_POST['id'];
            }
            else
            {
                echo'<p class="error">This page has been accessed with error</p>';
                include('../login/_footer.php');
                exit();
            }
            require('mysqli_connect.php');
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                if($_POST['sure'] == 'Yes')
                {
                    $query = "DELETE FROM users WHERE user_Id = $id LIMIT 1";
                    $result = mysqli_query($con, $query);
                    if(mysqli_affected_rows($con) == 1)//if there is no problem
                    {
                        echo'<h3>The record has been deleted</h3>';
                    }
                    else
                    {
                        echo'<p class="error">The record could not be deleted.<br/>Probably because it 
                        does not exit or due to the system failure</p>';
                        echo'<p>'.mysqli_error($con).'<br/>Query:'.$query.'</p>';
                    }
                }
                else
                {
                    echo'<h3>The user has not been deleted</h3>';
                }
                
            }
            else
            {
                $query = "SELECT CONCAT(fname, ' ', lname) FROM users WHERE user_Id = $id";
                $result = mysqli_query($con, $query);
                if(mysqli_num_rows($result) == 1)//valid user ID show the form
                {
                    //get the member's data
                    $row = mysqli_fetch_array($result, MYSQLI_NUM);
                    //display the name of the member being deleted
                    echo"<h3>Are you sure you want to permenantly delete $row[0]?</h3>";
                    //Display the delete page
                    echo'<form action="delete.php" method="POST">
                        <input id="submit-yes" type="submit" name="sure" value="Yes">
                        <input id="submit-no" type="submit" name="sure" value="No">
                        <input type="hidden" name="id" value="'.$id.'">
                    </form>';
                }
                else//Not a valid member's ID
                {
                    echo'<p class="error">The page has been accessed with error</p>';
                    echo'<p>&nbsp;</p>';
                }
            }
            mysqli_close($con);
            echo'<p>&nbsp;</p>';
            include('../login/_footer.php');
            
        ?>
    </div>
</body>
</html>