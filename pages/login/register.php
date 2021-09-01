<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="charset=UTF-8">
    <link rel="stylesheet" href="../include/include.css">
    <title>Sign Up</title>
</head>
<body>
    <div class="container" id = "container">
        <div class="content">
            <p>
                <?php
                    require('mysqli_connect.php');
                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                        $errors = array();
                        if(empty($_POST['fname']))
                        {
                            $errors [] = "Your first name field is empty";
                        }
                        else
                        {
                            $fn = mysqli_real_escape_string($con, trim($_POST['fname']));
                        }
                        if(empty($_POST['lname']))
                        {
                            $errors [] = "Your last name field is empty";
                        }
                        else
                        {
                            $ln = mysqli_real_escape_string($con, trim($_POST['lname']));
                        }
                        if(empty($_POST['email']))
                        {
                            $errors [] ="Your email field is empty";
                        }
                        else
                        {
                            $email = mysqli_real_escape_string($con, trim($_POST['email'])); 
                        }
                        if(!empty($_POST['pass1']))
                        {
                            if($_POST['pass1']!= $_POST['pass2'])
                            {
                                $errors [] = "Your passwords do not match";
                            }
                            else
                            {
                                $p = mysqli_real_escape_string($con, trim($_POST['pass1']));
                            }
                        }
                        else
                        {
                            $errors [] = "Your password field is empty";
                        }
                    
                        if(empty($errors))
                        {
                            $query = "INSERT INTO users(user_Id, fname, lname, email, pssword, registration_date)
                            VALUES ('', '$fn', '$ln', '$email', SHA1('$p'), NOW())";
                            $result = @mysqli_query($con, $query);
                            if($result)
                            {
                                header("location: register-thanks.php");
                                exit();
                            }
                            else
                            {
                                echo'<h2>System Error!</h2>
                                <p class = ""error>You could not be registered due to system error. We appologize
                                for any incovenience</p>';
                                echo'<p>'.mysqli_error($con).'</p>';

                            }
                            mysqli_close($con);
                            include('footer.php');
                            exit();
                        }
                        else
                        {
                            echo'<h2>Error!</h2>
                            <p class = "error">The following errors were encoutered:<br/>';
                                foreach($errors as $msg)
                                {
                                    echo"-$msg<br/>";
                                }
                            echo'</p><p>Please try again ...</p>';
                        }
                    }
                ?>
            </p>
        </div>
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <p>
                <label for="fname" class="label" id="label">First Name:</label>
                <input type="text" id="fname" name="fname" size = "30" maxlength="30"
                value="<?php if(isset($_POST['fname'])) echo $_POST['fname']?>">
            </p>
            <p>
                <label for="lname" class="label">Last Name</label>
                <input type="text" name="lname" id="lname" size = "30" maxlength="40"
                value="<?php if(isset($_POST['lname'])) echo $_POST['lname']?>">
            </p>
            <p>
                <label for="email" class="label">Email:</label>
                <input type="email" name="email" id="email" size = "30" maxlength="60"
                value="<?php if(isset($_POST['email'])) echo $_POST['email']?>">
            </p>
            <p>
                <label for="pass1" class="label">Password</label>
                <input type="password" id="pass1" name="pass1" size="12" maxlength = "12"
                value="<?php if(isset($_POST['pass1'])) echo $_POST['pass1']?>">
            </p>
            <p>
                <label for="pass2" class="label">Confirm password</label>
                <input type="password" id ="pass2" name="pass2" size="12" maxlength = "12"
                value="<?php if(isset($_POST['pass2'])) echo $_POST['pass2']?>" >
            </p>
            <p><input type="submit" id="submit" name="submit" value="Register"></p>
        </form>
    </div>
</body>
</html>