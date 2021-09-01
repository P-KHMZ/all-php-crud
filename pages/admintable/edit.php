<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit the record</title>
    <meta charset=UTF-8>
    <style type="text/css">
        p{
            text-align: center;
        }
        input .flt-left{
            float: left;
        }
        #submit{
            float:left;
        }
    </style>
</head>
<body>
    <div id="content">
        <h2>Edit the record</h2>
        <?php
            if( (isset($_GET['id'])) && (is_numeric($_GET['id'])) )//from view-users.php
            {
                $id = $_GET['id'];
            }
            elseif( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) // form submission
            {
                $id = $_POST['id'];
            }
            else //if no valid id, stop the scripts
            {
                echo'<p class="error">This page has been accessed in error</p>';
                include('../login/_footer.php');
                exit();
            }
            require('mysqli_connect.php');
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $errors = array();
                //look for the first name
                if(empty($_POST['fname']))
                {
                    $errors [] = 'Your first name field is empty';
                }
                else
                {
                    $fn = mysqli_real_escape_string($con, trim($_POST['fname']));
                }
                //look for the last name
                if(empty($_POST['lname']))
                {
                    $errors [] = 'Your last name field is empty';
                }
                else
                {
                    $ln = mysqli_real_escape_string($con, trim($_POST['lname']));
                }
                if(empty($_POST['email']))//look for the email
                {
                    $errors [] = 'Your email field is empty';
                }
                else
                {
                    $e = mysqli_real_escape_string($con, trim($_POST['email']));
                }
                if(empty($errors))
                {
                    $query = "UPDATE users SET fname = '$fn', lname = '$ln', email = '$e' WHERE user_Id = $id LIMIT 1";
                    $result = @mysqli_query($con, $query);
                    if(mysqli_affected_rows($con) == 1) //if it ran OK
                    {
                        echo'<h3>The user has been edited</h3>';
                    }
                    else
                    {
                        echo'<p class = "error">The user could not be edited to due the system error</p>';
                        echo'<p>'.mysqli_error($con).'<br>Query:'.$query.'</p>';
                    }
                }
                else
                {
                    echo'<p class="error">The folloeing error(s) were encouted:</br></p>';
                    foreach($errors as $msg)
                    {
                        echo"-$msg";
                    }
                    echo'<p class="error">Please try again ...</p>';
                }
            }
            $query = "SELECT fname, lname, email FROM users WHERE user_Id = $id";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_array($result, MYSQLI_NUM);
                echo'<form action = "edit.php" method = "POST">
                    <p>
                        <label class="label" for="fname">First Name</label>
                        <input type="text" name="fname" id="fname" size = "30" maxlength = "30"
                        value="'.$row[0].'">
                    </p>
                    <p>
                        <label class="label" for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" size = "30" maxlength = "30"
                        value="'.$row[1].'">
                    </p>
                    <p>
                        <label class ="label" for="email">Email</label>
                        <input type="email" id="email" name="email" size="40" maxlength = "60"
                        value="'.$row[2].'">
                    </p><br/>
                    <p><input type="submit" id="submit" value="Edit"></p>
                    <br><input type="hidden" name="id" value="' . $id . '"/>
                </form>';
            }
        ?>
    </div>
</body>
</html>