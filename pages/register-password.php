<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change password</title>
    <style>
        p.error
        {
            color:red;
            font-size:150%;
            font-weight:bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <?php include('../_header.php');?>
        <?php include('../_nav.php');?>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                require('../config/config.php');
                $errors = array();
                if(empty($_POST['email']))
                {
                    $errors [] = 'Your email field is empty';
                }
                else
                {
                    $email = mysqli_real_escape_string($dbcon, trim($_POST['email']));
                }
                if(empty($_POST['pass']))
                {
                    $errors [] = 'Your current field is empty';
                }
                else
                {
                    $p = mysqli_real_escape_string($dbcon, trim($_POST['pass']));
                }
                if(!empty($_POST['newpass']))
                {
                   if($_POST['newpass'] !=$_POST['confirm_p'])
                   {
                        $errors [] = 'Your new passowrd do not match the confirm password';
                   }
                   else
                   {
                       $newp = mysqli_real_escape_string($dbcon, trim($_POST['newpass']));
                   }
                }
                else
                {
                    $errors [] = 'Your new passwor field is empty';
                }
                if(empty($_POST['confirm_p']))
                {
                    $errors [] = 'Your confirm password is empty';
                }
                else
                {
                    $confirm_pass = mysqli_real_escape_string($dbcon, trim($_POST['confirm_p']));
                }
                if(empty($errors))
                {
                    $query = "SELECT userId FROM users_table WHERE(email='$email' AND password =SHA1('$p'))";
                    $result = @mysqli_query($dbcon, $query);
                    $num = @mysqli_num_rows($result);
                    if($num ==1)
                    {
                        $row = mysqli_fetch_array($result, MYSQLI_NUM);
                        $q = "UPDATE users_table SET password = SHA1($newp) WHERE userId = $row[0]";
                        $result = mysqli_query($dbcon, $q);
                        if(mysqli_affected_rows($dbcon) == 1)// if the query run without problem
                        {
                            echo'<h2>Thank you</h2>
                            <h3>Your password has been successfully changed<h3>';
                        }
                        else
                        {
                            echo'<h2>System Error!</h2>
                            <p class="error">Your passoword was not changed due to:'.mysqli_error($dbcon).'<br/></p>';
                            echo'<p>Query: '.$q.'</p>';
                        }
                        mysqli_close($dbcon);
                        include ('../_footer.php');
                        exit();
                    }
                    else
                    {
                        echo'<p class="error">Your password and your email do not match<>';
                    }
                  
                }
                else // report the error
                {
                    echo'<h2>Error! <h2>
                    <p class="error">The following error were encoutered:<br/>';
                        foreach($errors as $msg)
                        {
                            echo "-$msg<br/>";
                        }
                    echo'</p><p>Please try again ...</p><p><br/></p>';
                }

            }
        ?>
        <form action="register-password.php" method="POST">
            <h2>Change your password</h2>
            <p>
                <label for="mail" class="label">Email:</label>
                <input type="email" placeholder="email address" size = "30" maxlength="40" id="email" name="email"
                value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>">
            </p>
            <p>
                <label for="pass" class="label">Current password:</label>
                <input type="password" placeholder="current password" size = "30" maxlength="40" id="pass" name="pass"
                value="<?php if(isset($_POST['pass'])) echo $_POST['pass'] ?>">
            </p>
            <p>
                <label for="np" class="label">New password:</label>
                <input type="password" placeholder="new password" size = "30" maxlength="40" id="np" name="newpass"
                value="<?php if(isset($_POST['newpass'])) echo $_POST['newpass'] ?>">
            </p>
            <p>
                <label for="confirm" class="label">Confirm Password:</label>
                <input type="password" placeholder="confirm password" size = "30" maxlength="40" id="confirm" name="confirm_p"
                value="<?php if(isset($_POST['confirm_p'])) echo $_POST['confirm_p'] ?>">
            </p>
            <p> <input type="submit" name="submit" id="submit" value="Submit"> </p>
        </form>
    </div>
    <?php include('../_footer.php')?>
</body>
</html>