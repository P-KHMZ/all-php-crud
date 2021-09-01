<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset=UTF-8>
    <link rel="stylesheet" href="../include/include.css">
    <title>Login page</title>
</head>
<body>
    <div class="container">
        <?php include("_header.php")?>
        <?php include("_info-col.php")?>
        <div class="content">
            <?php
                if($_SERVER['REQUEST_METHOD'] =='POST')
                {
                    require('mysqli_connect.php');
                    if(!empty($_POST['email']))
                    {
                        $un = mysqli_real_escape_string($con, trim($_POST['email']));
                    }
                    else
                    {
                        $un = FALSE;
                        echo'<p class="error">Fill in the username field</p>';
                    }
                    if(!empty($_POST['pass']))
                    {
                        $p = mysqli_real_escape_string($con, trim($_POST['pass']));
                    }
                    else
                    {
                        $p = FALSE;
                        echo'<p class = "error">Fill in the password field</p>';
                    }
                    if($un && $p)
                    {
                        $query = "SELECT user_Id, fname, user_level FROM users WHERE(email='$un' and pssword=SHA1('$p'))";
                        $result= mysqli_query($con, $query);

                        if(@mysqli_num_rows($result) == 1)//if one database row(record) matches the input:
                            //-Start the session, fetch the record and insert isert the 3 values in an array
                        {
                            session_start();
                            $_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            $_SESSION['user_level'] = (int) $_SESSION['user_level'];// Ensure that the user_level is an integer
                            $url = ($_SESSION['user_level'] === 1) ? 'admin.php':'member.php';
                            header('Location: '.$url);//Make the browser load either the members' or admin page
                            exit();//Cancel the rest of the script
                            mysqli_free_result($result);
                            mysqli_close($con);
                        }
                        else //if no match was made
                        {
                            echo'<p class="error">The username and the password entered do not match our record
                            <br>Perhaps you need to register, just click the Register button on the header menu</p>';
                        }

                    }
                    else// if there was a problem
                    {
                        echo'<p class ="error">Please try again</p>';
                    }
                    mysqli_close($con);

                }
            ?>
            <!-- include the login form -->
            <div id="loginfields"> 
                <?php include('login_page.inc.php');?>
            </div><br>
            <?php include('_footer.php');?>
        </div>
    </div>
</body>
</html>